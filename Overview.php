<style type="text/css">
	p { margin-bottom: 0; }
	ul { list-style-type: none; float: left; margin-top: 10px; }
	li > span { float: left; width: 20ex; margin-top: 15px; text-align: right; padding-right: 2ex; }
</style>
<?php

$i = 0;
$debug_info	= "";

function display($image_start, $i, $image, $addon) {
	if (empty($addon)) {
		$when = $image_start.' &mdash; '.($i);
	} else {
		$when = print_date_for_day($i).$addon;
	}
	echo "<li><span>$when</span><a href=\"$image\"><img src=\"".$image.'" height="60" /></a></li>', PHP_EOL;
}

require_once('Common.inc.php');

function image_for_day_full($i) {
	$date = date_for_day($i);

	$image = image_for_day($i);

	list($special_image, $addon) = special($date);
	if ($special_image != null) {
		$image = $special_image;
	}

	return array($image, $addon);
}

$col = 1;
$max_cols = 2;
$image_start = 0;
$image = $addon = '';
list($last_image, $last_addon) = image_for_day_full($image_start);

echo "<p>Total days: $days_left</p>";
echo '<ul>';
for ($i = 0; $i <= $days_left; $i++) {
	list($image, $addon) = image_for_day_full($i);
	//echo $i, $addon, PHP_EOL;
	if ($image != $last_image || $last_addon != $addon) {
		if ( ( $col * ($days_left+1) / $max_cols ) <= $i ) {
			$col++;
			echo '</ul><ul>';
		}
		display($image_start, $i-1, $last_image, $last_addon);
		$last_image = $image;
		$last_addon = $addon;
		$image_start = $i;
	}
}
display($image_start, $i-1, $image, $addon);
echo '</ul>';
