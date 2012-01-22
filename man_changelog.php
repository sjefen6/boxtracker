<?php
/*
 Boxtracker - Simple tracking of computer availability and ip-address.
 Copyright (C) <2012> <Kim Roar Foldøy Hauge>
 Copyright (C) <2011-2012> <Vegard Langås>

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/*
 * Flyttet ut litt kode som kunne gjenbrukes
 */
function man_changelog()
{
?>
<h2>Changelog</h2>
<pre>
Todo:
* Meny for man_doc(), man_install(), man_changelog() osv.
* Publisere koden.
* register() funksjon som utnytter db->master.
* Install() funksjon som lager db og settings.php.
* Flytte generering av tabellen ut til en funksjon egen fil.
* Utnytte db->gruppe. Ide ?gruppe=sysrq.
* Sjikkelig url rewrite /sysrq/, /box/passord/, /changelog/.
* Dyndns støtte uten behov for user:password, host, type i db (pent).
* Støtter for flere typer dyndns.
* Bedre handtering av pw beskyttelse fra htaccess (aktivering, logon (lastpass) og bruk på box)
* Mobil grensesnitt (iPhone): Baktanke: Farger og ikoner.
* Vurdere meta refresh (10 sek/60 sec)

0.15-b1 - sjefen6 branch 0.2 (2012-01-10)
* Begynner &aring; gj&oslash;re den html5 valid
* CSS i egen fil

0.15-b1 (2012-01-06)
* Forbedret sikkerhet, fjernet mulig SQL-injection.
* Fjerne kolonne for 'link'. Denne funksjonaliteten er n&aring; en del av ip-kolonnen
* Oppdatert dokumentasjonen, kort om installasjon p&aring; serverside.

0.14-r2 (2012-01-06)
* Versjon 0.14 release 2 er n&aring; tilgjengelig som <a href="http://boxtracker.sysrq.no/boxtracker-0.14r2.tar">download</a>.

0.14 (2011-11-25)
* Koden er n&aring; tilgkengelig under en GPL3-lisens, ta kontakt p&aring; irc for kildekode.

0.13-rc4 (2011-10-22)
* Fikset det slik at det n&aring;r st&aring;r m&aring;ned i entall om det kun er en m&aring;ned.
* Endret bredden p&aring; tabellen til 100%.

0.13-rc3 (2011-08-13)
* Maskiner med nedetid over 30 dager f&aring;r n&aring; nedetid i &aring;r og m&aring;neder.

0.13-rc2 - sjefen6 branch 0.1
* Lagt til støtte for no-ip og dyndns.
* Flyttet mye ut i individuelle filer og funksjoner for enkel modifisering.
* Endret installasjons instrukser til user level, og la til curl for feks Mac OS X.

0.13-rc2 - sjefen6 branch 0.0
* Fixet og rapportert bug med duplikater for pc-er som skiftet ip.

0.13-rc2
* Maskiner med [ osv i navnet kan ikke autoregistreres.

0.13-rc1
* Du kan nå registrere nye maskiner automatisk fra en god del av uninett. 
  Kontakt zokum for maskiner utenom uninett.

0.12-rc1
* Flyttet over p&aring; egen prosjektkonto.

0.11
* Sm&aring;fikser, husker ikke s&aring; godt.

0.10
* F&oslash;rste offentlige versjon.</pre><?php
}
?>