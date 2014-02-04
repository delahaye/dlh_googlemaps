Google Maps Modul für Contao
=====

Erweitert die Liste der vorhandenen Inhaltsarten um das Modul "Google Maps". Es sind beliebig viele Maps möglich, die an beliebigen Stellen in den Content eingebunden werden können. Hierfür steht nebem dem Modul auch je ein Content-Element für normale bzw. statische Maps zur Verfügung.

Haupt-Features:

- Beliebig viele Maps verwaltbar.
- Beliebig viele Elemente zu jeder Map definierbar:

>- Einfache Markierungen
- Komplexe Markierungen mit Icons und Schatten
- Infoblasen
- Grafik-Überlagerungen
- (Poly-)Linien
- Polygone
- Kreise
- Rechtecke
- KML-Layer

- Ansteuerung des Google Maps Routenplaners aus der Infoblase einer Markierung
- Direkte (Seiten-)Verlinkung von Markierungen, Polygonen etc.
- Geocoding von Adressen
- Modul zur Einbindung in Layouts
- Content-Element zur Einbindung in Artikel
- Content-Element zur Einbindung als Statische Map (PNG)
- Dynamische Markierungen und Verhaltensänderungen zur Laufzeit
- Wegfall des Google Maps API Keys durch Verwendung der Google Maps API V3
- Street View
- Übersetzungen via Transifex

Dynamische Map-Elemente lassen sich durch Html-/Javascript-Blöcke oder angepasste (Metamodels-)Templates nutzen. Hierfür ist kein Wechsel des Modul-Templates mehr nötig. Die Datei TL_ROOT/system/modules/dlh_googlemaps/docs/de/Dynamische_Markierungen.md erläutert - auch anhand eines konkreten Beispiels -, wie eine Map durch dynamische Elemente angereichert werden kann.