<?php
//prep the vars
$i = $no = $debug = $fast = 0;
$yes = 1;
$debug_info	= "";

if (!empty($_GET))
	extract($_GET, EXTR_OVERWRITE);

include "Date.inc.php";

$Kick_time	= strtotime(date('Y-m-d', strtotime($Kick_DATE)));
$Comp_time	= strtotime($Comp_DATE);

$Comp_days	= round(($Comp_time - $Kick_time)/(24 * 60 * 60));	//the number of days between kickstart and competition
$days_left	= $Comp_days - $i;	//the number of days not yet shown

$KickStart_Date	= date("m-d", $Kick_time);
$Competition_Date	= date("m-d", $Comp_time);
$Easter_Day_Date	= date("m-d", strtotime($Easter_DATE));
$Pancake_Day_Date	= date("m-d", strtotime($Easter_DATE." -47 days"));

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

$time_per_slide = round($time_left / ($days_left+1) );

$print_date = date("l j F", $then);

$date	= date("m-d", $then);

if($no)
	$yes = 0;

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

$image = $image_array[floor($i/7)];

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

list($width, $height, $type, $attr) = getimagesize($image);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?	$i++;
if(!$no && $i <= $Comp_days)
{ ?>
<meta http-equiv="REFRESH" content="<?php echo ($fast ? (1/$fast) : $time_per_slide); ?>; URL=?i=<?php echo $i.($fast ? "&fast=$fast" : "").($debug ? "&debug=$debug" : ""); ?>" />
<? }//	One Day is 21 seconds	?>
<title>Six Months in 1 Hour: <?php echo $date.$addon; ?></title>
<link rel="stylesheet" type="text/css" href="6style.css"/>
<script type="text/javascript">
function make_it_fit_js(width, height)
{
	Brw_width	= document.documentElement.clientWidth - 10;	//just in case
	Brw_height	= document.documentElement.clientHeight - 180;	//not forgetting the header bit
	Brw_ratio	= Brw_width / Brw_height;
	ratio = width / height;
	if(Brw_ratio > ratio)	//then the window is wider and we make the height fit
	{
		Img_height	= Brw_height;
		Img_width	= ratio * Img_height;
	}
	else	// the image is wider and we make the height fit
	{
		Img_width	= Brw_width;
		Img_height	= Img_width / ratio;
	}
	//Img_style	= "width: " + Img_width + "px; height: " + Img_height + "px;\"";
	document.getElementById('main_img').style.width	= Img_width + "px";
	document.getElementById('main_img').style.height	= Img_height + "px";
}
</script>
</head>
<?php $debug_info	.= "\$time_left=$time_left,	\$time_per_slide=$time_per_slide,	[floor(\$i/7)]=".floor($i/7);?>
<body onload="make_it_fit_js(<? echo "$width, $height"; ?>);">
<div id="wrapper">
	<div id="page_title">
		<table class="head1">
			<tr>
				<td class="left" style="width: 170px; text-align: center;">
					<img src="SRobo_Logo.png" alt="SR Logo" style="margin: 5px 0;" />
				</td>
				<td class="center">
				<h3 class="center"><?php echo $print_date.$addon; ?></h3>
				<br />
				<? if($no) {?><a href="?<? echo htmlspecialchars("no=1&i=".($i-2).($fast ? "&fast=1" : "")) ?>" title="">Previous</a>&nbsp;&nbsp;&nbsp;<? } ?>
				<a href="?<? echo htmlspecialchars("no=$yes&i=".(!$no ? ($i-1) : $i).($fast ? "&fast=1" : "")) ?>" title=""><? echo ($no ? "Continue" : "Pause") ?></a>
				<? if($no) {?>&nbsp;&nbsp;&nbsp;<a href="?<? echo htmlspecialchars("no=1&i=$i".($fast ? "&fast=1" : "")) ?>" title="">Next</a><? } ?>
				</td>
				<td class="right" style="width: 210px;">
				<img src="SRobo1.png" title="" style="width: 203px; height: 73px; margin-right: 7px;" alt="" />
				</td>
			</tr>
		</table>
	</div>
	<div id="page_main">
		<img id="main_img" src="<?php echo $image; ?>" style="" title="" alt="" />
	</div>
</div>
<?php if($debug)	echo $debug_info; ?>
</body>
</html>
