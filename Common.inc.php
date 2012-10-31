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

$then	= strtotime("$Kick_DATE, +$i days");	//the 'current' date: the one that the page is showing
$now	= strtotime("now");
$time_left	= strtotime($Kick_DATE) - $now;
if($time_left <= 0)
	$then = $Comp_time;

$long_date_format	= "Y-m-d; l j F Y H:i:s (a)";
$debug_info	.= "\$then=$then (".date($long_date_format, $then)."),<br />
	\$now=$now (".date($long_date_format, $now)."),<br />
	\$Comp_days=$Comp_days,<br />
	\$days_left=$days_left\n<br />\n";

$print_date = date("l j F", $then);

$date	= date("m-d", $then);

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
	$autumn_images,
	$winter_images,
	array($xmas_image),
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
