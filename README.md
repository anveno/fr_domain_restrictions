# REDAXO-AddOn: Domain Restrictions

- Schränkt die Tabellen-Rechte von Nutzern je nach Domain-Einstellungen der Rolle ein.
- Die Tabelle muss über ein Feld vom Typ **choice** mit Name **domain** verfügen.
- Die Auswahlmöglichkeit für das Feld lautet: `SELECT id AS value, domain AS label FROM rex_yrewrite_domain ORDER BY domain ASC`

## Todos/Bugs:

- wenn bei der Rolle unter Domains nichts ausgewählt ist, hat der User Rechte für alle Domains 
- package.yml um Abhängigkeiten erweitern
- Domain-Zuordnung in der Suche verstecken bzw. Auswahl der Domains einschränken

## Version 1.0.0 - 08.12.2022

- Initial
