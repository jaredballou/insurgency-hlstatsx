# HLStatsX Customized For Insurgency
Complete build of HLStatsX that includes Insurgency specific images, icons, map data, and a heatmap generator. It integrates tightly with the [Insurgency Logger and HLStatsX Sourcemod plugins](https://github.com/jaredballou/insurgency-sourcemod).
Once you install the HLStatsX application from my repo or upstream, the following two links will set up your database for Insurgency:
* [Complete data dump to add Insurgency as a game](http://ins.jballou.com/create-hlstatsdump.php): This tool creates the mod and game settings, adds defaults for new servers, and adds all weapons/maps and ribbons/awards needed. It
* [Add table for Per-Round logging support](sql/rounds.sql): One of the future goals of this project is to create "per match" visualizations of killers and victims, step throughs of captures, or any other use of the data framed by rounds instead of collected globally. This table is needed to track round activities, eventually I want to be able to have round unique identifiers assigned and the events modify the single round record rather than needing to get a bunch of events and parse them, but this is release 1.

[Insurgency Image Pack](http://stats.jballou.com/hlstatsimg/games/insurgency/images.tar.bz2): This is the latest bundle of weapon icons, includes award/ribbon images. Soon it will also include map images.

These are the older tools that dumped the HLStatsX SQL from game files. I still use these to keep my primary data tool above up to date. You should not need either of these, they are only included for informational purposes.

* [Map Data Dump](http://ins.jballou.com/maps.php?command=hlstats): Tool that reads all overview data from my Insurgency Data repository and exports needed data for Heatmap support.
* [Weapons Dump](http://ins.jballou.com/stats.php?command=hlstats): Tool that reads theaters and langage files (currently only supports Latin alphabet) to create data dump of all weapons, teams, and roles. Also creates the desired ribbons for weapons.
