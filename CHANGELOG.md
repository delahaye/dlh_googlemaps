# Changelog
All notable changes to this project will be documented in this file.

## [2.3.1] - 2017-07-18

### Fixed
- `gmap*_markers is not defined` js error

## [2.3.0] - 2017-07-18

### Fixed
- `contao 4.x` compatibility
 
### Changed

- `imgSize` now always uses `box` option. For full with add % or pcnt to with dimension
- make always usage of api key, global api key can now added to `tl_settings.dlh_googlemaps_apikey`, required for pageless context
- requires now `heimrichhannot/dlh_geocode` and created independent `composer` package within namespace `heimrichhannot/dlh_googlemaps`
