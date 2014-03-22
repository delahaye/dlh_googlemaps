2014-02-04, 2.0.7 stable
----------
Sprache IT hinzugefügt, danke an Paolo Brunelli. CS upgedated, danke an Tomáš Petrlík. FA upgedated, danke an Hamid Abbaszadeh. Beseitigt einen Fehler mit Composer.


2014-02-04, 2.0.6 stable
----------
Beseitigt einige Fehler, entfernt allte Dateien beim Update und kommt mit den Sprachen FR, CS und FA.


2014-02-04, 2.0.5 stable
----------
Ist nicht im ER veröffentlicht worden.


2014-02-04, 2.0.4 stable
----------
Beseitigt einige Fehler und ermöglicht Maps in jQuery Accordions.


2014-02-07, 2.0.3 stable
----------
Löst das Problem hoffentlich. Sorry.


2014-02-07, 2.0.2 stable
----------
Beseitigt einen Fehler, der ein Update verhinderte.


2014-02-05, 2.0.1 stable
----------
Beseitigt einige Fehler.


2014-02-04, 2.0.0 stable
----------

Die Version 2.0 ist auf den Betrieb mit Contao 3.2.x ausgelegt. Ältere Contao-Versionen werden nicht unterstützt!

Update:
- alte Dateien aus /system/modules/dlh_googlemaps löschen
- neue Dateien einspielen
- Datenbank-Update
- Speicherung aller vorhandenen Maps und -elemente

Änderungen:
- Contao 3.2-fit, alles recoded
- Übersetzungen via Transifex
- Koordinatenermittlung aus Adresse in eigene Extension ausgelagert
- Koordinaten für Marker werden auf das Zentrum vorbelegt
- Koordinaten für Marker können aus Adresse ermittelt werden
- Koordinaten-Import an neue Contao-Methode angepasst
- Direkte Verlinkung der Maps in der Backend-CE-Ansicht
- Separate Templates pro CE-/Modul-Verwendung
- Einzeltemplates für Kartenelemente
- Integration in das Contao-Rechtesystem
- Marker auch in statischer Karte möglich (auch >5)
- Pan-/Zoomkontrolle gefixt und einzeln positionierbar
- Rotate-Control verfügbar
- Overview-Control verfügbar
- StreetView-Control positionierbar
- CSS abschaltbar
- CSS in Zusammenfassung
- JS und CSS werden nur noch bei Bedarf geladen
- Zusätzliche Parameter ausserhalb des Kartenoptionsblocks
- Standardmarker farblich definierbar
- Karten in Accordions und/oder Tabs werden dynamisch neu geladen
- KML-Dateien als Element einbindbar
- und natürlich ein paar Bugfixes