2014-02-04, 2.0.0 stable
----------

The version 2.0.0 is designed to work with Contao 3.2.x. Older versions of Contao are not supported!

Update:
- delete old files from /system/modules/dlh_googlemaps
- up new files
- update the database
- re-save all maps and elements

Changes:
- for Contao 3.2-fit, all recoded
- translations via Transifex
- geo-coding separated in an own extension
- coordinates for a marker are pre-set to the map center
- coordinates for a marker can be calculated from the address
- redesign coordinate import
- maps are linked directly in backend CE-view
- seperate templates per CE-/module use
- seperate templates per element type
- integrated into the Contao rights management
- markers are also possible in ststic maps (even >5)
- fixed pan-/zoom control
- added rotate control
- added overview control
- StreetView control positionable
- de-/activation of CSS
- pack CSS
- JS and CSS are only loaded when needed
- additional parameters outside the options
- custom colors for the standard markers
- maps in accordions and/or tabs are reloaded dynamically
- addedc KML-layer elements
- and some bug fixes of course