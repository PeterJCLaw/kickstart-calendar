<style type="text/css">
	p { margin-bottom: 0; }
	ul { list-style-type: none; float: left; margin-top: 10px; }
	li > span { float: left; width: 10ex; margin-top: 15px; text-align: right; padding-right: 2ex; }
</style>
<?php

$i = 0;
$debug_info	= "";

function display($image_start, $i, $image) {
	echo "<li><span>$image_start &mdash; ".($i-1)."</span><a href=\"$image\"><img src=\"".$image.'" height="60" /></a></li>', PHP_EOL;
}

require_once('Common.inc.php');

function image_for_day_full($i) {
	$date = date_for_day($i);

	$image = image_for_day($i);

	list($special_image, $addon) = special($date);
	if ($special_image != null) {
		$image = $special_image;
	}

	return $image;
}

$col = 1;
$max_cols = 2;
$image_start = 0;
$last_image = image_for_day_full($image_start);

echo "<p>Total days: $days_left</p>";
echo '<ul>';
for ($i = 0; $i < $days_left; $i++) {
	$image = image_for_day_full($i);
	if ($image != $last_image) {
		if ( ( $col * $days_left / $max_cols ) <= $i ) {
			$col++;
			echo '</ul><ul>';
		}
		display($image_start, $i, $last_image);
		$last_image = $image;
		$image_start = $i;
	}
}
display($image_start, $i, $image);
echo '</ul>';
