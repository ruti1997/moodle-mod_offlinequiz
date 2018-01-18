<?php
// This file is part of mod_offlinequiz for Moodle - http://moodle.org/
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
 * Strings for component 'offlinequiz_statistics', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package   offlinequiz_statistics
 * @author    Juergen Zimmer
 * @copyright     2015 Academic Moodle Cooperation {@link http://www.academic-moodle-cooperation.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['actualresponse'] = 'תגובה בפועל';
$string['allattempts'] = 'כל הניסיונות מענה';
$string['allattemptsavg'] = 'ציון ממוצע של כל התוצאות';
$string['allattemptscount'] = 'סך כל מספר תוצאות ניסיונות המענה';
$string['allgroups'] = 'סטטיסטיקה עבור כל קבוצות בבוחן המחובר';
$string['analysisofresponses'] = 'ניתוח התשובות';
$string['analysisofresponsesfor'] = 'ניתוח התשובות עבור {$a}.';
$string['attempts'] = 'ניסיונות מענה';
$string['attemptsall'] = 'כל הניסיונות מענה';
$string['attemptsfirst'] = 'נסיון ראשון';
$string['backtoquestionsandanswers'] = 'חזרה לדף דו"ח הסטטיסטיקה הראשי.';
$string['bestgrade'] = 'הציון הגבוה ביותר שהושג';
$string['calculatefrom'] = 'חישוב נתונים סטטיסטיים מ';
$string['cic'] = 'מקדם עקביות פנימית';
$string['completestatsfilename'] = 'סטטיסטיקה מלאה';
$string['correct'] = 'תשובה נכונה';
$string['count'] = 'מספר ניסיונות מענה לתשובה זו';
$string['coursename'] = 'שם קורס';
$string['detailedanalysis'] = 'ניתוח מפורט יותר של התשובות לשאלה זו';
$string['differentquestions'] = 'קבוצות הבוחן הלא מקוונות שלך מכילות קבוצות שונות של שאלות.';
$string['differentsumgrades'] = 'לקבוצות הבוחן הלא מקוון שלך יש סכומים שונים של ציונים ({$a}). ולכן, הציון הממוצע, את החציון, ואת סטיית התקן לא ניתן לחשב.';
$string['discrimination_index'] = 'מדד אפליה';
$string['discriminative_efficiency'] = 'יעילות מפלה';
$string['downloadeverything'] = 'הורד דו"ח מלא';
$string['duration'] = 'פתח עבור';
$string['effective_weight'] = 'משקל אפקטיבי';
$string['errordeleting'] = 'שגיאה במחיקת הישן {$a} רשומות.';
$string['erroritemappearsmorethanoncewithdifferentweight'] = 'השאלה ({$a}) מופיע יותר מפעם אחת עם משקולות שונות במיקומים שונים של הבדיקה. בשלב זה דו"ח זה אינו נתמך על ידי דו"ח סטטיסטי, ועשוי להפוך את הנתונים הסטטיסטיים לשאלה זו לבלתי אמינה.';
$string['errormedian'] = 'שגיאה באחזור חציון';
$string['errorpowerquestions'] = 'שגיאה באחזור נתונים לחישוב שונות עבור ציוני השאלה';
$string['errorpowers'] = 'שגיאה באחזור נתונים לחישוב שונות עבור ציוני מבחנים לא מקוונים';
$string['errorrandom'] = 'שגיאה בקבלת נתוני פריט משנה';
$string['errorratio'] = 'יחס שגיאה';
$string['errorstatisticsquestions'] = 'שגיאה באחזור נתונים לחישוב נתונים סטטיסטיים עבור ציוני השאלה';
$string['facility'] = 'מתקן מדדים';
$string['firstattempts'] = 'ניסיונות ראשונים';
$string['firstattemptsavg'] = 'ציון ממוצע של ניסיונות ראשונים';
$string['firstattemptscount'] = 'מספר הניסיונות הראשונים המדורגים';
$string['frequency'] = 'תדירות';
$string['intended_weight'] = 'משקל מומלץ';
$string['kurtosis'] = 'סטטיסיטקת התפלגות הציון';
$string['lastcalculated'] = 'מחושב לאחרונה {$a->lastcalculated} לפני כן {$a->count} מאז הניסיונות.';
$string['maxgrade'] = 'ציון מקסימלי אפשרי';
$string['median'] = 'ציון חיצוני';
$string['modelresponse'] = 'תגובת מודל';
$string['negcovar'] = 'סטטיסיטקה שלילית של הציון הכולל בניסיון מענה';
$string['negcovar_help'] = 'שאלה של ציון עבור קבוצה זו, של ניסיונות המענה על חידון לא מקוון המשתנה בדרך הפוכה שהציון הכולל ניסיון מענה. משמעות הדבר היא כי הציון הכולל של הניסוי נוטה להיות מתחת לממוצע כאשר הציון עבור שאלה זו הוא מעל הממוצע ולהיפך.

המשוואה שלנו למשקל שאלה יעיל לא ניתן לחשב במקרה זה. החישובים עבור משקל השאלה יעיל לשאלות אחרות במבחן לא מקוון זה,הם משקל השאלה יעיל לשאלות אלו אם השאלות מודגשות עם שונות שלילית מקבלים ציון מקסימלי של אפס.

אם אתה עורך מבחן לא מקוון ונותן את השאלות האלה בשותפות שלילית, הציון המקסימלי של אפס ואז משקל השאלה האפקטיבי של השאלות האלה יהיה אפס, ומשקל השאלה האמיתי של שאלות אחרות יהיה כפי שחושב עכשיו.';
$string['nostudentsingroup'] = 'עדיין אין תלמידים בקבוצה זו';
$string['optiongrade'] = 'קרדיט חלקי';
$string['partially'] = 'תשובה נכונה חלקית';
$string['partofquestion'] = '#תשובה';
$string['pluginname'] = 'סטטיסטיקה בבוחן הלא מקוון';
$string['position'] = 'מצב';
$string['positions'] = 'מצב(s)';
$string['preferencespage'] = 'העדפות רק עבור דף זה';
$string['preferencessave'] = 'הצג דו"ח';
$string['questionandanswerstats'] = 'שאלות + תשובות';
$string['questionandanswerstatsheader'] = 'סטטיסטיקה - ניתוח שאלות ותשובות';
$string['questioninformation'] = 'פרטי שאלה';
$string['questionname'] = 'שם שאלה';
$string['questionnumber'] = '#';
$string['questionstatistics'] = 'סטטיסטיקת שאלה';
$string['questionstats'] = 'ניתוח שאלה';
$string['questionstatsheader'] = 'סטטיסטיקה - ניתוח שאלה';
$string['questionstatsfilename'] = 'נתונים סטטיסטיים';
$string['questiontype'] = 'סוג שאלה';
$string['offlinequizinformation'] = 'מידע לבוחן לא מקוון';
$string['offlinequizname'] = 'שם הבוחן הלא מקוון';
$string['offlinequizoverallstatistics'] = 'סטטיסטיקה כללית של בוחן לא מקוון';
$string['offlinequizstructureanalysis'] = 'הבנת הסטטיסטיקה של הבוחן הלא מקוון';
$string['random_guess_score'] = 'ציון ניחוש אקראי';
$string['recalculatenow'] = 'לחשב מחדש עכשיו';
$string['remarks'] = 'הערה';
$string['response'] = 'תשובות';
$string['skewness'] = 'ניקוד הפצה';
$string['standarddeviation'] = 'סטיית תקן';
$string['standarddeviationq'] = 'סטיית תקן';
$string['standarderror'] = 'שגיאת תקן';
$string['statistics'] = 'סטטיסטיקה';
$string['statistics:componentname'] = 'דו"ח סטטיסטיקת במצב לא מקוון';
$string['statisticsforgroup'] = 'סטטיסטיקה לקבוצה';
$string['statisticshelp'] = 'עזרה עבור סטטיסטיקה לבוחן לא מקוון';
$string['statsoverview'] = 'סקירה כללית';
$string['statsoverviewheader'] = 'סקירה כללית';
$string['statisticsreport'] = 'דו"ח סטטיסטי';
$string['statisticsreportgraph'] = 'סטטיסטיקה עבור מצב שאלה';
$string['statistics:view'] = 'הצג דו"ח נתונים סטטיסטיים';
$string['statsfor'] = 'סטטיסטיקת בוחן לא מקוון (עבור {$a})';
$string['worstgrade'] = 'הציון הנמוך ביותר שהושג';
$string['wrong'] = 'תשובה שגויה';
