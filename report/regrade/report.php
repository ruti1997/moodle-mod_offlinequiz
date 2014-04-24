<?php
// This file is for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The regrading report for offlinequizzes
 *
 * @package       mod
 * @subpackage    offlinequiz
 * @author        Juergen Zimmer
 * @copyright     2014 Academic Moodle Cooperation {@link http://www.academic-moodle-cooperation.org}
 * @since         Moodle 2.2+
 * @license       http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 **/

require_once($CFG->libdir . '/tablelib.php');
require_once($CFG->libdir . '/weblib.php');
require_once("pdflib.php");

class offlinequiz_regrade_report extends offlinequiz_default_report {

    public function display($offlinequiz, $cm, $course) {
        global $CFG, $OUTPUT, $DB;

        $confirm = optional_param('confirm', 0, PARAM_INT);

        raise_memory_limit(MEMORY_EXTRA);
        
        // Print header
        $this->print_header_and_tabs($cm, $course, $offlinequiz, 'regrade');

        offlinequiz_load_useridentification();
        $offlinequizconfig = get_config('offlinequiz');
        $letterstr = 'ABCDEFGHIJKL';

        //      // create new correction forms
        //      for ($i=1; $i <= $offlinequiz->numgroups; $i++) {
        //          if (!$result = $DB->get_record('offlinequiz_results', array('offlinequizid' => $offlinequiz->id,
        //                  'groupid' => $i, 'sheet', 1)) {
        //              error("Missing data for group ".$letterstr[$i-1],"createquiz.php?q=$offlinequiz->id&amp;mode=preview&amp;sesskey=".sesskey());
        //          }
        //          offlinequiz_create_pdf_correction($result, $offlinequiz, $course->id);
        //      }

        // Print heading
        echo $OUTPUT->box_start('linkbox');
        echo $OUTPUT->heading(format_string($offlinequiz->name));
        echo $OUTPUT->heading(get_string('regradingquiz', 'offlinequiz'));
        echo $OUTPUT->box_end('linkbox');

        // Fetch all results.
        $ressql = "SELECT res.*, u.{$offlinequizconfig->ID_field}
                     FROM {offlinequiz_results} res
                     JOIN {user} u on u.id = res.userid
                    WHERE res.offlinequizid = :offlinequizid
                      AND res.status = 'complete'";
        $resparams =  array('offlinequizid' => $offlinequiz->id);

        if (!$results = $DB->get_records_sql($ressql, $resparams)) {
            $url = new moodle_url('/mod/offlinequiz/report.php', array('id' => $cm->id));
            $url->param('mode', 'overview');
            echo $OUTPUT->heading(get_string('noresults', 'offlinequiz'));
            echo $OUTPUT->box_start('linkbox');
            echo $OUTPUT->continue_button($url);
            echo $OUTPUT->box_end('linkbox');
            return true;
        }

        // If we don't have a confirmation we only display the confirm and cancel buttons.
        if (!$confirm) {

            echo $OUTPUT->box_start('linkbox');
            echo $OUTPUT->notification(get_string('regradedisplayexplanation', 'offlinequiz'), 'notifyproblem');

            echo '<br/>';
            $url = new moodle_url('/mod/offlinequiz/report.php', array('id' => $cm->id));
            $url->param('mode', 'regrade');
            $url->param('confirm', 1);
            echo $OUTPUT->single_button($url, get_string('reallyregrade', 'offlinequiz_regrade'));

            echo '<br/>';
            $url = new moodle_url('/mod/offlinequiz/report.php', array('id' => $cm->id));
            $url->param('mode', 'overview');
            echo $OUTPUT->single_button($url, get_string('cancel'));

            echo $OUTPUT->box_end('linkbox');

            return true;
        }

        // Fetch all questions
        $sql = "SELECT q.id, i.grade as maxgrade,
                       q.category, q.parent, q.name, q.defaultmark,
                       q.penalty, q.qtype, q.stamp, q.version, q.hidden
                  FROM {offlinequiz_q_instances} i,
                       {question} q
                 WHERE i.offlinequizid = :offlinequizid
                   AND i.questionid = q.id";

        $params = array('offlinequizid' => $offlinequiz->id);

        if (! $questions = $DB->get_records_sql($sql, $params)) {
            print_error("Failed to get questions for regrading!");
        }

        if ($groups = $DB->get_records('offlinequiz_groups', array('offlinequizid' => $offlinequiz->id), 'number', '*', 0, $offlinequiz->numgroups)) {
            foreach ($groups as $group) {
                $sumgrade = offlinequiz_update_sumgrades($offlinequiz, $group->id);
                $groupletter = $letterstr[$group->number - 1];
                $a = new StdClass();
                $a->letter = $groupletter;
                $a->grade = round($sumgrade, $offlinequiz->decimalpoints);
                echo $OUTPUT->notification(get_string('updatedsumgrades', 'offlinequiz', $a), 'notifysuccess');
            }
        }

        // options for the popup_action
        $options = array();
        $options['height'] = 1024; // optional
        $options['width'] = 860; // optional
        $options['resizable'] = false;

        $saveresult = false;

        // Loop through all results and regrade while printing progress info
        foreach ($results as $result) {
            set_time_limit(120);

            $user = $DB->get_record('user', array('id' => $result->userid));
            echo '<strong>' . get_string('regradingresult', 'offlinequiz', $user->{$offlinequizconfig->ID_field}) .
            '</strong> ';
            $changed = $this->regrade_result($result, $questions);
            //  offlinequiz_update_sumgrades($offlinequiz, $result->offlinegroupid);

            if ($changed) {
                $quba = question_engine::load_questions_usage_by_activity($result->usageid);
                $DB->set_field('offlinequiz_results', 'sumgrades',  $quba->get_total_mark(),
                        array('id' => $result->id));

                $url = new moodle_url($CFG->wwwroot . '/mod/offlinequiz/review.php',
                        array('resultid' => $result->id));
                $title = get_string('changed', 'offlinequiz');

                echo $OUTPUT->action_link($url, $title, new popup_action('click', $url, 'review' . $result->id, $options));
            } else {
                echo get_string('done', 'offlinequiz');
            }
            echo '<br />';
            // the following makes sure that the output is sent immediately.
            @flush();@ob_flush();
        }

        // Loop through all questions and recalculate $result->sumgrade
        //      $resultschanged = 0;
        //      foreach ($results as $result) {
        //          $sumgrades = 0;
        //          $questionids = explode(',', offlinequiz_questions_in_offlinequiz($result->layout));
        //          foreach($questionids as $questionid) {
        //              $lastgradedid = get_field('question_sessions', 'newgraded', 'resultid', $result->uniqueid, 'questionid', $questionid);
        //              $sumgrades += get_field('question_states', 'grade', 'id', $lastgradedid);
        //          }
        //          if ($saveresult) {
        //              $resultschanged++;
        //              set_field('offlinequiz_results', 'sumgrades', $sumgrades, 'id', $result->id);
        //          }
        //      }

        $url = new moodle_url($CFG->wwwroot . '/mod/offlinequiz/report.php', array('q' => $offlinequiz->id, 'mode' => 'overview'));

        // offlinequiz_grade_item_update($offlinequiz, 'reset');
        offlinequiz_update_grades($offlinequiz);

        echo $OUTPUT->box_start('linkbox');
        echo $OUTPUT->single_button($url, get_string('continue'), 'get');
        echo $OUTPUT->box_end('linkbox');

        return true;
    }

    /**
     * Regrade a particular offlinequiz result. Either for real ($dryrun = false), or
     * as a pretend regrade to see which fractions would change. The outcome is
     * stored in the offlinequiz_overview_regrades table.
     *
     * Note, $result is not upgraded in the database. The caller needs to do that.
     * However, $result->sumgrades is updated, if this is not a dry run.
     *
     * @param object $result the offlinequiz result to regrade.
     * @param bool $dryrun if true, do a pretend regrade, otherwise do it for real.
     * @param array $slots if null, regrade all questions, otherwise, just regrade
     *      the quetsions with those slots.
     */
    protected function regrade_result($result, $questions, $dryrun = false, $slots = null) {
        global $DB;

        $transaction = $DB->start_delegated_transaction();

        $quba = question_engine::load_questions_usage_by_activity($result->usageid);

        if (is_null($slots)) {
            $slots = $quba->get_slots();
        }

        $changed = false;

        $finished = true;
        foreach ($slots as $slot) {
            $qqr = new stdClass();
            $qqr->oldfraction = $quba->get_question_fraction($slot);
            $slotquestion = $quba->get_question($slot);
            $newmaxmark = $questions[$slotquestion->id]->maxgrade;
            $quba->regrade_question($slot, $finished, $newmaxmark);

            $qqr->newfraction = $quba->get_question_fraction($slot);
            if (abs($qqr->oldfraction - $qqr->newfraction) > 1e-7) {
                $changed = true;
            }
        }

        if (!$dryrun) {
            question_engine::save_questions_usage_by_activity($quba);
        }

        $transaction->allow_commit();

        return $changed;
    }
}
