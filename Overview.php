<style type="text/css">
	ul { list-style-type: none; float: left; margin-top: 10px; }
	li > span { float: left; width: 10ex; margin-top: 15px; text-align: right; padding-right: 2ex; }
</style>
<?php

$i = 0;
$debug_info	= "";

require_once('Common.inc.php');

$col = 1;
$max_cols = 2;

echo '<ul>';
for (; $i < $days_left; $i += 7) {
	if ( ( $col * $days_left / $max_cols ) <= $i ) {
		$col++;
		echo '</ul><ul>';
	}
	$image = image_for_day($i);
	echo "<li><span>$i &mdash; ".($i+6) ."</span><a href=\"$image\"><img src=\"".$image.'" height="60" /></a></li>', PHP_EOL;
}
echo '</ul>';
