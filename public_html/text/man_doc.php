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
function man_doc()
{
?>
<h2>Dokumentasjon</h2>
Maskinene må selv si i fra når de er i live, så blir dette registrert i en database.
<br/>
<img src="gfx/smiley-dead.png"> - Maskinen har vært offline i mer enn 30 dager.
<br/>
<img src="gfx/smiley-sad.png"> - Maskinen har vært offline i 1 dag til 30 dager.
<br/>
<img src="gfx/smiley-neutral.png"> - Maskinen har vært offline i 1 minutt til 1 dag.
<br/>
<img src="gfx/smiley-happy.png"> - Maskinen har vært aktiv i det siste minuttet.
<br/>
<?php
}
?>