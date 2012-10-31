<?php
//prep the vars
$i = $no = $debug = $fast = 0;
$yes = 1;
$debug_info	= "";

if (!empty($_GET))
	extract($_GET, EXTR_OVERWRITE);

require_once('Common.inc.php');

$image = image_for_day($i);
$time_per_slide = round($time_left / ($days_left+1) );

if($no)
	$yes = 0;

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
