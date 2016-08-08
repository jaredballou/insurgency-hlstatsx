#!/usr/bin/php
<?php
//Connect to database
<<<<<<< HEAD
$debug = 0;
=======
>>>>>>> e89373b0719a2b6af36c3eb8810221a6282e68a2
require "config.inc.php";
mysql_connect(DB_HOST,DB_USER,DB_PASS);
mysql_select_db(DB_NAME);

//Source for weapon images
<<<<<<< HEAD
$game = "insurgency";

$mod = "insurgency";
$version = "2.2.7.3";

$mod = "doi";
$version = "2.4.5.5";

$srcpath = "src/insurgency-data/mods/{$mod}/{$version}/materials";

//Destination for processed results
$dstpath = "../web/hlstatsimg/games/{$game}";

=======
$srcpath = 'src/insurgency-data/materials';
//Destination for processed results
$dstpath = '../web/hlstatsimg/games/insurgency';
>>>>>>> e89373b0719a2b6af36c3eb8810221a6282e68a2
//TODO: Merge this all together
//Array of directories and the size of the icon

$directories = array(
	'dawards' => array(
		'res' => '112x64',
		'caption' => true,
		'background' => 'src/dawards_nohand.png'
	),
	'gawards' => array(
		'res' => '112x64',
		'caption' => false,
		'background' => 'src/gawards_nohand.png'
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
	'rb_' => 'src/bronze_ribbons_nohand.png',
	'rs_' => 'src/silver_ribbons_nohand.png',
	'rg_' => 'src/gold_ribbons_nohand.png'
);
//Daily Award background
//Global award background
$gaward = 'gawards_nohand.png';
//Get weapons from MySQL
<<<<<<< HEAD
$mod = 'insurgency';
$result = mysql_query("SELECT * FROM hlstats_Weapons WHERE game='{$mod}' ORDER BY code ASC");
=======
$result = mysql_query("SELECT * FROM hlstats_Weapons WHERE game='insurgency' ORDER BY code ASC");
>>>>>>> e89373b0719a2b6af36c3eb8810221a6282e68a2
//Create directories if needed
/*
foreach ($directories as $dir => $data) {
	$path = "{$dstpath}/{$dir}";
	if (!is_dir($path)) {
		mkdir($path,0755,true);
	}
}
*/
//Create weapon images
while ($row = mysql_fetch_array($result)) {
//	var_dump($row['code'],getvgui($row['code']));
//exit;
<<<<<<< HEAD
	echo "Processing {$row['code']} ({$row['name']})\n";
	$srcimg = getvgui($row['code'],'vgui/inventory');
	debugprint("srcimg = {$srcimg}");
	if (!$srcimg) {
		echo "ERROR: Cannot find source image for {$row['code']} ({$row['name']})\n";
		continue;
	}
	$shortname = explode('_',$row['code'],2);
	$shortname = $shortname[1];
	debugprint("shortname = {$shortname}");
=======
	$srcimg = getvgui($row['code'],'vgui/inventory');
	echo "Processing {$row['code']} ({$row['name']})\n";
	$shortname = explode('_',$row['code'],2);
	$shortname = $shortname[1];
>>>>>>> e89373b0719a2b6af36c3eb8810221a6282e68a2

	$caption = "-gravity south -stroke '#000C' -strokewidth 2 -annotate 0 '{$row['name']}' -stroke none -fill '#aaaaaa' -annotate 0 '{$row['name']}'";

	//Weapon icon
	$resize = "-gravity center -trim +repage -background none -resize {$directories['weapons']['res']} -extent {$directories['weapons']['res']}";
	doexec("convert {$srcimg} {$resize} {$caption} {$dstpath}/weapons/{$row['code']}.png");
	$caption = '';
	//Daily award
	$resize = "-gravity center -trim +repage -background none -resize {$directories['dawards']['res']} -extent {$directories['dawards']['res']}";
	doexec("convert {$directories['dawards']['background']} {$srcimg} {$resize} {$caption} -compose over -composite {$dstpath}/dawards/w_{$row['code']}.png");
	//Global award
	$resize = "-gravity center -trim +repage -background none -resize {$directories['gawards']['res']} -extent {$directories['gawards']['res']}";
	doexec("convert {$directories['gawards']['background']} {$srcimg} {$resize} {$caption} -compose over -composite {$dstpath}/gawards/w_{$row['code']}.png");
	//Ribbons
	$resize = "-gravity center -trim +repage -background none -resize {$directories['ribbons']['res']} -extent {$directories['ribbons']['res']}";
	foreach ($ribbons as $prefix => $ribimg) {
		doexec("convert {$ribimg} {$srcimg} {$resize} {$caption} -compose over -composite {$dstpath}/ribbons/{$prefix}{$shortname}.png");
	}
}

//Create map images
$maps = array();
ParseMapDir("overviews");
ParseMapDir("vgui/endroundlobby/maps");

function ParseMapDir($mappath) {
	global $maps,$srcpath;
	$mapfiles = glob("{$srcpath}/{$mappath}/*.*");
	foreach ($mapfiles as $map) {
		$basename = remove_ext(basename($map));
		$noext = remove_ext($map);
		if (isset($maps[$basename]))
			continue;
		if (file_exists("{$noext}.png")) {
			$maps[$basename] = "{$noext}.png";
			continue;
		}
		$srcimg = getvgui($basename,$mappath);
		if ($srcimg)
			$maps[$basename] = $srcimg;
	}
}

foreach ($maps as $mapname => $mapimg) {
	echo "Processing {$mapname}\n";
	$resize = "-gravity center -trim +repage -background none -resize {$directories['maps']['res']} -extent {$directories['maps']['res']}";
	doexec("convert {$mapimg} {$resize} {$dstpath}/maps/{$mapname}.png");
}

foreach ($directories as $dir => $data) {
	$path = "{$dstpath}/{$dir}";
	echo "Adding new files to {$dir}\n";
	doexec("git add {$path}/*");
}
//Create archive of images
$dirs = implode('|',array_keys($directories));
$arc = "${dstpath}/images.zip";
if (file_exists($arc))
	unlink($arc);
$p = new PharData($arc);
$p->buildFromDirectory($dstpath,"/\/({$dirs})\//");
exit;


function remove_ext($str) {
	$noext = preg_replace('/(.+)\..*$/', '$1', $str);
//	print "input: $str\n";
//	print "output: $noext\n\n";
	return $noext;
}

function doexec($cmd) {
<<<<<<< HEAD
	debugprint("Running {$cmd}");
	exec($cmd);
}
function debugprint($msg) {
	if ($GLOBALS['debug']) {
		echo "DEBUG: {$msg}\n";
	}
}
function getvgui($name,$path='vgui/inventory') {
	debugprint("name \"{$name}\" path \"{$path}\"");
	$rp = "{$GLOBALS['srcpath']}/{$path}/{$name}";
	debugprint("rp is \"{$rp}\"");
=======
//	echo "DEBUG: Running {$cmd}\n";
	exec($cmd);
}
function getvgui($name,$path='vgui/inventory') {
	$rp = "{$GLOBALS['srcpath']}/{$path}/{$name}";
>>>>>>> e89373b0719a2b6af36c3eb8810221a6282e68a2
//var_dump($rp);
	if (file_exists("{$rp}.vmt")) {
		$vmf = file_get_contents("{$rp}.vmt");
		preg_match_all('/basetexture[" ]+([^"\s]*)/',$vmf,$matches);
		$rp = "{$GLOBALS['srcpath']}/".$matches[1][0];
<<<<<<< HEAD
		debugprint("vmt set rp to \"{$rp}\"");
	}
	if (file_exists("{$rp}.png")) {
		debugprint("\"{$rp}\" exists");
		return "{$rp}.png";
	}
	debugprint("\"{$rp}\" does not exist");
=======
	}
	if (file_exists("{$rp}.png")) {
		return "{$rp}.png";
	}
>>>>>>> e89373b0719a2b6af36c3eb8810221a6282e68a2
	return NULL;
}

exit;
?>
