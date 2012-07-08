<?
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

header("Content-type:text/html; charset=utf-8");

require ("settings.php");

$box = htmlentities(strip_tags(mysql_real_escape_string($_GET['box'])), ENT_QUOTES, "UTF-8");
$p = htmlentities(strip_tags(mysql_real_escape_string($_GET['p'])), ENT_QUOTES, "UTF-8");

if ((strlen($box) > 0) && (strlen($p) > 2)) {
	//Files related to updating
	include ("dyndns.php");

	$tid = time();
	$ip = $_SERVER['REMOTE_ADDR'];

	/*
	 * If the box is eligible for automatically getting added if not already in boxtracker
	 */
	if ((strncmp($ip, $allowedIpRange, 7) == 0) && !strstr($box, "["))//To-Do: 7 characters???
	{
		$Query = "SELECT box, ip, tid, url FROM	boxtracker WHERE box = '$box'";
		$dbResult = mysql_query($Query);
		$exists = 0;
		while ($dbRow = mysql_fetch_object($dbResult)) {
			$exists = 1;
		}
		if ($exists == 0) {
			$q = "INSERT INTO boxtracker SET box = '$box', passord = '$p'";
			mysql_query($q);
		}
	}

	/*
	 * Check the database if the box need dns updating
	 */
	$Query = "SELECT * FROM	boxtracker WHERE box = '$box'";
	$dbResult = mysql_query($Query);
	while ($dbRow = mysql_fetch_object($dbResult)) {
		if ((($dbRow -> ip != $ip) || ($dbRow -> dns_tid < ($tid - $dns_refreshrate))) && ($dbRow -> dns_type != NULL)) {
			$dns_status = update_dns($dbRow -> dns_user, $dbRow -> dns_hostname, $ip, $dbRow -> dns_type);
			$dns_tid = $tid;
			echo "dyndns";
		} else {
			$dns_tid = $dbRow -> dns_tid;
			echo "ikke dyndns";
			if (($dbRow -> dns_type == NULL) || ($dbRow -> dns_type == "")) {
				$dns_status = "Not configured!";
			} else {
				$dns_status = $dbRow -> dns_status;
			}
		}
	}

	/*
	 * Update info in the database
	 */
	$query = "UPDATE boxtracker SET tid = '$tid', ip ='$ip' WHERE box = '$box' AND passord = '$p'";
	mysql_query($query);
	exit();
}

//Files only used when generating visuals
include ("pentid.php");
include ("man_changelog.php");
include ("man_install.php");
include ("man_doc.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo "Boxtracker $bt_version on $bt_url"; ?></title>
		<link rel="stylesheet" media="screen" href="browser.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
	</head>
	<body>
		<h1><?php echo "Boxtracker $bt_version on $bt_url";?></h1><?php
		$Query = "SELECT box, ip, tid, url, dns_status, dns_hostname, dns_tid FROM boxtracker ORDER by box";
		if (!($dbResult = mysql_query($Query))) {
			print("Couldn't execute query!<BR>\n");
			print("MySQL reports: " . mysql_error() . "<BR>\n");
			print("Query was: $Query<BR>\n");
			exit();
		}?>
		<table width="100%"><tr><th>&nbsp;</th><th>Boks</th><th>IP</th><th>Sist sett p&aring; nett</th><th></th><th>DNS host</th><th>DNS Status</th><th></th></tr>
		<?php while ($dbRow = mysql_fetch_object($dbResult)) {

			print("<tr><td><img src=\"" . pentid($dbRow -> tid, smiley) . "\" /></td><td>$dbRow->box</td><td>");
			if (strlen($dbRow -> url))
				print("<a href=\"http://$dbRow->url\">$dbRow->ip</a>");
			else
				print("$dbRow->ip");

			print("</td><td>" . pentid($dbRow -> tid, tid) . "</td><td>" . pentid($dbRow -> tid, siden) . "</td>" . "<td>$dbRow->dns_hostname</td><td>$dbRow->dns_status</td><td>" . pentid($dbRow -> dns_tid, siden) . "</td></tr>\n");
		}?>
		</table>
		
		<?php man_doc();
		man_install($useSsl, $bt_user, $bt_url);
		man_changelog();
		?>
	</body>
</html>
