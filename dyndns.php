<?php
/*
 Boxtracker - Simple tracking of computer availability and ip-address.
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

/* Denne kommer til å kreve
 siste oppdateringtid, slik at den kan kjøre minst hver 14 dag
 bruker, se $user
 hostname, domene eller gruppe med domener som skal oppdateres
 dns status, for å gi infoen som blir gitt at dns
 [tjeneste], for å kunne velge mellom forsjellige dyndns-er

 Må ikke kjøres uten å ha sjekket at ip-en er den samme som tidligere
 */
function update_dns($user, $hostname, $myip, $type) {
	$userAgent = "PHP " . phpversion() . " $hostname ver $version $contact_email";

	switch ($type) {
		case no-ip :
			$dyndns = "https://$user@dynupdate.no-ip.com/nic/update?hostname=$hostname&myip=$myip";
			break;
		case dyndns :
			$dyndns = "https://$user@members.dyndns.org/nic/update?hostname=$hostname&myip=$myip&wildcard=NOCHG&mx=NOCHG&backmx=NOCHG";
			break;
		default :
			return "Type error!";
	}

	//echo "$user, $hostname, $myip, $type";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "$dyndns");
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: $userAgent"));
	$reply = curl_exec($ch);
	//echo "OMGOMG!!!" . $reply . "omglol";
	curl_close($ch);
	return $reply;
}
?>