-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_dlh_googlemaps`
-- 

CREATE TABLE `tl_dlh_googlemaps` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `center` varchar(64) NOT NULL default '',
  `mapSize` varchar(255) NOT NULL default '',
  `zoom` int(10) unsigned NOT NULL default '0',
  `sensor` char(1) NOT NULL default '1',
  `geocoderAddress` varchar(255) NOT NULL default '',
  `geocoderCountry` varchar(2) NOT NULL default '1',
  `staticMapNoscript` char(1) NOT NULL default '1',
  `mapTypeId` varchar(16) NOT NULL default '',
  `mapTypesAvailable` varchar(255) NOT NULL default '',
  `useMapTypeControl` char(1) NOT NULL default '1',
  `mapTypeControlStyle` varchar(16) NOT NULL default '',
  `mapTypeControlPos` varchar(16) NOT NULL default '',
  `useNavigationControl` char(1) NOT NULL default '1',
  `navigationControlStyle` varchar(16) NOT NULL default '',
  `navigationControlPos` varchar(16) NOT NULL default '',
  `streetViewControl` char(1) NOT NULL default '1',
  `disableDoubleClickZoom` char(1) NOT NULL default '1',
  `scrollwheel` char(1) NOT NULL default '1',
  `draggable` char(1) NOT NULL default '1',
  `useScaleControl` char(1) NOT NULL default '1',
  `scaleControlPos` varchar(16) NOT NULL default '',
  `parameter` text NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_dlh_googlemaps_elements`
-- 

CREATE TABLE `tl_dlh_googlemaps_elements` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `published` char(1) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `type` varchar(32) NOT NULL default '',
  `markerType` varchar(32) NOT NULL default '',
  `singleCoords` varchar(64) NOT NULL default '',
  `multiCoords` blob NULL,
  `markerShowTitle` char(1) NOT NULL default '',
  `overlaySRC` varchar(255) NOT NULL default '',
  `iconSRC` varchar(255) NOT NULL default '',
  `iconSize` varchar(255) NOT NULL default '',
  `iconAnchor` varchar(255) NOT NULL default '',
  `hasShadow` char(1) NOT NULL default '',
  `shadowSRC` varchar(255) NOT NULL default '',
  `shadowSize` varchar(255) NOT NULL default '',
  `strokeColor` varchar(6) NOT NULL default '',
  `strokeOpacity` varchar(255) NOT NULL default '',
  `strokeWeight` varchar(64) NOT NULL default '',
  `fillColor` varchar(6) NOT NULL default '',
  `fillOpacity` varchar(255) NOT NULL default '',
  `radius` varchar(64) NOT NULL default '',
  `bounds` varchar(255) NOT NULL default '',
  `zIndex` int(10) unsigned NOT NULL default '0',
  `markerAction` varchar(255) NOT NULL default '',
  `popupInfoWindow` char(1) NOT NULL default '',
  `useRouting` char(1) NOT NULL default '',
  `routingAddress` varchar(255) NOT NULL default '',
  `infoWindow` text NULL,
  `infoWindowAnchor` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `target` char(1) NOT NULL default '',
  `linkTitle` varchar(255) NOT NULL default '',
  `parameter` text NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `dlh_googlemap` int(10) unsigned NOT NULL default '0',
  `dlh_googlemap_size` varchar(255) NOT NULL default '',
  `dlh_googlemap_zoom` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `dlh_googlemap` int(10) unsigned NOT NULL default '0',
  `dlh_googlemap_size` varchar(255) NOT NULL default '',
  `dlh_googlemap_zoom` int(10) unsigned NOT NULL default '0',
  `dlh_googlemap_static` char(1) NOT NULL default '',
  `dlh_googlemap_url` varchar(255) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;