<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/4/2017
 * Time: 8:09 AM
 */
/*mysql -u cjohnsonsql -p -h mysqldev.caseyjohnson1989.com -db phpdev_caseyjohnson1989_com
You can also go to http://mysqldev.caseyjohnson1989.com/ to manage your MySQL database from the web.*/
/**
 * @param $optionsArray
 * @param $selectedOption
 */

//---------------------- SELECT BOX FUNCTION -----------------------
function CreateSelectBox($optionsArray, $selectedOption, $selectBoxName)
{
  echo "<select name='$selectBoxName'>";
  $count = 0;
  while ($count < count($optionsArray)) {
    echo "<option ";
    if ($selectedOption == $optionsArray[$count]) {
      echo "selected ='selected'";
    }
    echo ">";
    echo "$optionsArray[$count]";
    "</option>";
    $count = $count + 1;
  }
  echo '</select>';
}

//------------------------ MINI CALENDAR FUNCTION-------------------
function mini_calendar($month, $year)
{
  $month = $_GET["month"];
  if (empty($month)) {
    $month = date("n");
  }
  $year = $_GET["year"];
  if (empty($year)) {
    $year = date("Y");
  }
  $cal_title = date("F Y", mktime(0, 0, 0, $month, 1, $year));
  $headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
  $firstOfTheMonth = mktime(0, 0, 0, $month, 1, $year);
  $days_in_the_month = date('t', $firstOfTheMonth);
  $firstDay = date('w', $firstOfTheMonth);
  $days_counter = 0;
  $days_this_week = 1;
  $prev_month = $month - 1;
  $prev_year = $year;
  if ($prev_month == 0) {
    $prev_month = 12;
    $prev_year = $year - 1;
  }
  $next_year = $year;
  $next_month = $month + 1;
  if ($next_month == 13) {
    $next_month = 1;
    $next_year = $year + 1;
  }
  $ret_str = "";
  $ret_str .= '<table style="border: 2px solid black">';
  $ret_str .= '<tr style="border: 2px solid black">';
  $ret_str .= '<td style="background: #ccc">';
  $ret_str .= '<a href="?month=' . $prev_month . '&year=' . $prev_year . '">Previous</a>';
  $ret_str .= '</td>';
  $ret_str .= '<td colspan="5" align="center" style="background: #ccc; border: 2px solid black; font-weight: bold; padding: 5px">' . $cal_title . ' </td>';
  $ret_str .= '<td style="background: #ccc">';
  $ret_str .= '<a href="?month=' . $next_month . '&year=' . $next_year . '">Next</a>';
  $ret_str .= '</td>';
  $ret_str .= '</tr>';
  $ret_str .= '<tr>';
  for ($i = 0; $i < count($headings); $i++) {
    $ret_str .= '<td style="background: #999; border: 2px solid black; font-weight: bold; padding: 5px">' . $headings[$i] . '</td>';
  }
  $ret_str .= '</tr>';
  $ret_str .= '<tr style="border: 2px solid black">';
  for ($x = 0; $x < $firstDay; $x++) {
    $ret_str .= '<td style="background: #ccc; border: 2px solid black; text-align: right">&nbsp;</td>';
    $days_counter += 1;
  }
  for ($list_day = 1; $list_day <= $days_in_the_month; $list_day++) {
    $ret_str .= '<td style="background: #ccc; border: 2px solid black; text-align: right">' . $list_day . '</td>';
    $days_counter += 1;
    $days_this_week += 1;
    if ($days_counter % 7 == 0) {
      $ret_str .= '<tr>';
      $days_this_week = 0;
    }
  }
  while ($days_this_week < 7) {
    $ret_str .= '<td style="background: #ccc; border: 2px solid black; text-align: right">&nbsp;</td>';
    $days_this_week += 1;
  }
  $ret_str .= '</tr>';
  $ret_str .= '</table>';
  return $ret_str;
}

//----------------------- DATABASE CONNECTION FUNCTION -------------------------
function db_connect()
{
  $db = new mysqli("mysqldev.caseyjohnson1989.com", "cjohnsonsql", "yoMomma6969", "phpdev_caseyjohnson1989_com");
  if ($db->connect_errno) {
    echo "Failed to connect to Database: (" . $db->connect_errno . ") " . $db->connect_error;
  }
  return $db;
}

//------------------------------ Set SESSIONS Cookie ------------------------------

/**
 * @param $email
 * @param $name
 */
function set_login($email, $name)
{
  $_SESSION['email'] = $email;
  $_SESSION['name'] = $name;
}

//------------------------------- TIME AGO FUNCTION --------------------------------

function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>