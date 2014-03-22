2014-02-04, 2.0.7 stable
----------
Added IT language, thanks to Paolo Brunelli. Updated CS, thanks to Tomáš Petrlík. Updated FA, thanks to Hamid Abbaszadeh. Fixes a bug with composer.


2014-02-04, 2.0.6 stable
----------
Fixes some bugs, removes old files on update and comes with the languages FR, CS, and FA


2014-02-04, 2.0.5 stable
----------
Was not published in the ER


2014-02-04, 2.0.4 stable
----------
Fixes some bugs and enables maps in jQuery accordions


2014-02-07, 2.0.3 stable
----------
Hopefully solves the problem at least. sorry.


2014-02-07, 2.0.2 stable
----------
Fixes a bug which let updates fail


2014-02-05, 2.0.1 stable
----------
Fixes some bugs


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