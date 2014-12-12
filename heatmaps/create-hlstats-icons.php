<?php
//Connect to database
require "config.inc.php";
mysql_connect(DB_HOST,DB_USER,DB_PASS);
mysql_select_db(DB_NAME);

//Source for weapon images
$srcpath = 'src/materials/vgui/inventory';
//Destination for processed results
$dstpath = '../web/hlstatsimg/games/insurgency';
//TODO: Merge this all together
//Array of directories and the size of the icon
$directories = array(
	'dawards' => array(
		'res' => '112x64',
		'caption' => true
	),
	'gawards' => array(
		'res' => '112x64',
		'caption' => false
	),
	'maps' => array(
		'res' => '174x174',
		'caption' => false
	),
	'ribbons' => array(
		'res' => '112x64',
		'caption' => false
	),
	'weapons' => array(
		'res' => '110x30',
		'caption' => false
	),
);
//Array of ribbons
$ribbons = array(
	'rb_' => 'bronze_ribbons_nohand.png',
	'rs_' => 'silver_ribbons_nohand.png',
	'rg_' => 'gold_ribbons_nohand.png'
);
//Daily Award background
$daward = 'dawards_nohand.png';
//Global award background
$gaward = 'gawards_nohand.png';
//Get weapons from MySQL
$result = mysql_query("SELECT * FROM hlstats_Weapons WHERE game='insurgency' ORDER BY code ASC");
//Create directories if needed
foreach ($directories as $dir => $data) {
	$path = "{$dstpath}/{$dir}";
	if (!is_dir($path)) {
		mkdir($path,0755,true);
	}
}
//Display list of commands to create images
while ($row = mysql_fetch_array($result)) {
	$shortname = explode('_',$row['code'],2);
	$shortname = $shortname[1];

	$caption = "-gravity south -stroke '#000C' -strokewidth 2 -annotate 0 '{$row['name']}' -stroke none -fill white -annotate 0 '{$row['name']}'";

	//Weapon icon
	$resize = "-gravity center -trim +repage -background none -resize {$directories['weapons']['res']} -extent {$directories['weapons']['res']}";
	exec("convert {$srcpath}/{$row['code']}.png {$resize} {$caption} {$dstpath}/weapons/{$row['code']}.png");
	$caption = '';
	//Daily award
	$resize = "-gravity center -trim +repage -background none -resize {$directories['dawards']['res']} -extent {$directories['dawards']['res']}";
	exec("convert src/{$daward} {$srcpath}/{$row['code']}.png {$resize} {$caption} -compose over -composite {$dstpath}/dawards/w_{$row['code']}.png");
	//Global award
	$resize = "-gravity center -trim +repage -background none -resize {$directories['gawards']['res']} -extent {$directories['gawards']['res']}";
	exec("convert src/{$gaward} {$srcpath}/{$row['code']}.png {$resize} {$caption} -compose over -composite {$dstpath}/gawards/w_{$row['code']}.png");
	//Ribbons
	$resize = "-gravity center -trim +repage -background none -resize {$directories['ribbons']['res']} -extent {$directories['ribbons']['res']}";
	foreach ($ribbons as $prefix => $srcimg) {
		exec("convert src/{$srcimg} {$srcpath}/{$row['code']}.png {$resize} {$caption} -compose over -composite {$dstpath}/ribbons/{$prefix}{$shortname}.png");
	}
}
exit;
?>
