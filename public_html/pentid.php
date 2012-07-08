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
function pentid($tid, $type) {
	$difftid = time() - $tid;

	/*
	 * If the requested type is "tid"
	 */
	if ($type == "tid") {
		if ($tid > 1) {
			return date("H:i d. M Y", $tid);
		} else {
			return "aldri";
		}
		/*
		 * If the requested type is "siden"
		 */
	} elseif ($type == "siden") {
		$penaar = 0;
		if ($tid > 1) {
			if ($difftid > (3600 * 24 * 30.4375)) {
				$penmonth = floor($difftid / (3600 * 24 * 30.4375));
				while ($penmonth >= 12) {
					$penaar++;
					$penmonth = $penmonth - 12;
				}
				return "(" . ($penaar ? "$penaar &aring;r og " : "") . "$penmonth m&aring;nede" . ($penmonth > 1 ? "r" : "") . " siden)";
			} else if ($difftid > (3600 * 24)) {
				$pendag = floor($difftid / (3600 * 24));
				return "($pendag dage" . ($pendag > 1 ? "r" : "") . " siden)";
			} else if ($difftid > 3599) {
				$pentimer = floor($difftid / (3600));
				return "($pentimer time" . ($pentimer > 1 ? "r" : "") . " siden)";
			} else if ($difftid > 61) {
				$penminutter = floor($difftid / (60));
				return "($penminutter min. siden)";
			} else {
				return "($difftid sekund siden)";
			}
		} else {
			return "";
		}
		/*
		 * If the requested type is "smiley"
		 */
	} elseif ($type == "smiley") {
		if ($difftid > (3600 * 24 * 30))
			return "gfx/smiley-dead.png";
		// mer enn 1 maaned
		else if ($difftid > (3600 * 24))
			return "gfx/smiley-sad.png";
		// mer enn 1 dag
		else if ($difftid > (60))
			return "gfx/smiley-neutral.png";
		// mer enn 1 minutt
		else
			return "gfx/smiley-happy.png";
		// under et minutt
		/*
		 * If not; there must be a misunderstanding
		 */
	} else {
		return "Tror du har en skriveleif!";
	}
}
?>