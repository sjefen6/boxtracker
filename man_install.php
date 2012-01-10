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
function man_install($useSsl,$bt_user,$bt_url)
{
?>
<h2>Installasjon - med wget (Linux/Ubuntu)</h2>
<pre>echo "wget -q -O /dev/null \"http<?php echo ($useSsl? "s":""); ?>://<?php echo ($bt_user != ""? $bt_user . "@" : "") . $bt_url;?>/?box=[BOX]&amp;p=[PASSORD]\"" > ~/scripts/boxtracker.sh
chmod +x ~/scripts/boxtracker.sh
crontab -e
*/1 * * * * ~/scripts/boxtracker.sh > /dev/null</pre>

<h2>Installasjon - med curl (Mac OS X)</h2>
<pre>echo "curl -s -o /dev/null "http<?php echo ($useSsl? "s":""); ?>://<?php echo ($bt_user != ""? $bt_user . "@" : "") . $bt_url;?>/?box=[BOX]&amp;p=[PASSORD]\"" > ~/scripts/boxtracker.sh
chmod +x ~/scripts/boxtracker.sh
crontab -e
*/1 * * * * ~/scripts/boxtracker.sh > /dev/null</pre>

<h2>Installasjon server</h2>
<pre>Du trenger en mysql-database med en tabell 'boxtracker' med f&oslash;lgende felter:
box - varchar(100)
ip - varchar(20)
tid - bigint(20)
gruppe - varchar(20) 
passord - varchar(50)
url - varchar(200)

Putt index.php sammen med png-bildene i en egnet katalog.
Putt db.php i en katalog som ikke er lesbar for andre og endre index.php til Ã¥ 
peke til denne filens lokasjon.</pre>
<?php
}
?>