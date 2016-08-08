#!/usr/bin/php
<?php
error_reporting(E_ALL);
ini_set("memory_limit", "1024M");

require_once 'config.inc.php';
require_once 'heatmap.class.php';

$heat = new Heatmap;
$heat->init();

$mapinfo = Env::get('mapinfo');
//var_dump($mapinfo);
foreach ($mapinfo as $game => $gameconf) {
	foreach ($gameconf as $map => $data) {
		$heat->generate($game, $map, "kill");
	}
}
//src/insurgency-data/mods/insurgency/2.2.7.3/resource/overviews/ministry_coop.txt
show::Event("CREATE", "Heatmap creation done.", 1);
?>
