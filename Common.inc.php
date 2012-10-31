<?php

include "Date.inc.php";

$Kick_time	= strtotime(date('Y-m-d', strtotime($Kick_DATE)));
$Comp_time	= strtotime($Comp_DATE);

$Comp_days	= round(($Comp_time - $Kick_time)/(24 * 60 * 60));	//the number of days between kickstart and competition
$KickStart_Date	= date("m-d", $Kick_time);
$Competition_Date	= date("m-d", $Comp_time);
$Easter_Day_Date	= date("m-d", strtotime($Easter_DATE));
$Pancake_Day_Date	= date("m-d", strtotime($Easter_DATE." -47 days"));

$days_left	= $Comp_days - $i;	//the number of days not yet shown
$now = time();

/**
 * Returns the 'current' date for a given offset.
 */
function stamp_for_day($i) {
	global $Kick_DATE, $Comp_time, $now;
	$then = strtotime("$Kick_DATE, +$i days");
	$time_left	= strtotime($Kick_DATE) - $now;
	if($time_left <= 0)
		$then = $Comp_time;
	return $then;
}

$then = stamp_for_day($i);	//the 'current' date: the one that the page is showing
$long_date_format	= "Y-m-d; l j F Y H:i:s (a)";
$debug_info	.= "\$then=$then (".date($long_date_format, $then)."),<br />
	\$now=$now (".date($long_date_format, $now)."),<br />
	\$Comp_days=$Comp_days,<br />
	\$days_left=$days_left\n<br />\n";

/**
 * Returns the 'current' date for a given offset in a printable form.
 */
function print_date_for_day($i) {
	$then = stamp_for_day($i);
	$date = date("l j F", $then);
	return $date;
}

/**
 * Returns the 'current' date for a given offset.
 */
function date_for_day($i) {
	$then = stamp_for_day($i);
	$date = date("m-d", $then);
	return $date;
}

$autumn_images = array("Autumn0.jpg","Autumn1.jpg","Autumn2.jpg","Autumn3.jpg","Autumn4.jpg",
			"Autumn5.jpg","Autumn6.jpg","Autumn7.jpg","Autumn8.jpg","Autumn9.jpg","Autumn10.jpg");

$winter_images = array("Winter0.jpg","Winter1.jpg","Winter2.jpg",);

$spring_images = array("Spring0.jpg","Spring1.jpg","Spring2.jpg","Spring3.jpg",
			"Spring4.jpg","Spring5.jpg","Spring6.jpg","Easter.jpg","Spring7.jpg","Spring8.jpg","Spring9.jpg");

$xmas_image = "Xmas1.gif";
$exam_images = array("Exam0.jpg","Find_X.jpg","Exam1.jpg");
$half_term_image = "Half_Term.jpg";
$exam_results_image = "Exam_Results.gif";

$image_array = array_merge(
	array_slice($autumn_images, 0, 6),
	array_slice($winter_images, 0, 1),
	array($xmas_image),
	array_slice($winter_images, 1),
	$exam_images,
	array_slice($spring_images, 0, 2),
	array($half_term_image, $exam_results_image),
	array_slice($spring_images, 2)
);

function image_for_day($day)
{
	global $image_array;
	$image = $image_array[floor($day/7)];
	return $image;
}

function special($date)
{
	global $KickStart_Date, $Competition_Date, $Easter_Day_Date, $Pancake_Day_Date;

	$image = null;

	switch ($date)
	{
		case $KickStart_Date:
			$addon	= " (Today)";
			break;
		case "10-31":
			$addon	= " (Halloween)";
			$image = "Halloween.jpg";
			break;
		case "11-05":
			$addon	= " (Bonfire Night)";
			$image = "Bonfire.jpg";
			break;
		case "12-24":
			$addon	= " (Christmas Eve)";
			$image = "Xmas_Eve.jpg";
			break;
		case "12-25":
			$addon	= " (Christmas Day)";
			$image = "Xmas_Day.gif";
			break;
		case "12-26":
			$addon	= " (Boxing Day)";
			$image = "Xmas_Day.gif";
			break;
		case "12-31":
			$addon	= " (New Year's Eve)";
			$image = "NY_Eve.jpg";
			break;
		case "01-01":
			$addon	= " (New Year's Day)";
			$image = "NY_Day.jpg";
			break;
		case $Pancake_Day_Date:
			$addon	= " (Pancake Day)";
			$image = "Pancake.jpg";
			break;
		case $Easter_Day_Date:
			$addon	= " (Easter Day)";
			$image = "Easter_Day.jpg";
			break;
		case $Competition_Date:
			$addon	= " (Competition Day)";
			$image = "Competition.jpg";
			break;
		default:
			$addon	= "";
			break;
	}

	return array($image, $addon);
}
