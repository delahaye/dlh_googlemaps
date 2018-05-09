# Changelog
All notable changes to this project will be documented in this file.

## [2.4.1] - 2018-05-09

### Fixed
- composer fixed license

### Changed
- set data-protection default off


## [2.4.0] - 2018-05-02

### Fixed
- composer-plugin wrong versions
- minor bugfixes, see github issues

### Changed
- added a data-protection confirmation to prevent data transfer to google w/o permission (optional)


## [2.3.2] - 2017-09-19

### Fixed
- `contao 4.x` compatibility
- minor fixes in pull request conflicts
- minor dca fixes
- version compare for BE maps
- added api key in CE and MOD
- fixed clusterer img path
 
### Changed
- map size uses `box` or `proportional` now. `box` works with dimension like `100px`, `20em`, `50%` etc., `proportional` defines an aspect ratio like `16:9` and full width of the container
- https for api calls
- smaller static map
- adjust composer.json
- modified upgrade handler
- added svg as icon image
- changed map styles in templates for new map sizes, enhane overwriting of styles
- skipped versions for compatibility with fork heimrichhannot (thanks for pull requests)

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
