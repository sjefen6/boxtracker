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

/* ----------------------------------------
 * General
 * ----------------------------------------
 */
 
 $bt_url = "example.com";
 $bt_user = "";
 $allowedIpRange = "158.39.";
 $useBoxPassword = true;
 $useSsl = false;
 $dns_refreshrate = 1209600; //how often it refreshes the domain (in seconds), so the domain ain't marked as inactive
 //Setting this to less then 1800 will result in an abuse flag
 //Default: 1209600
 //this does not affect wheter it is updated on an ip-change
 date_default_timezone_set("Europe/Berlin");
 

/* ----------------------------------------
 * mySQL configuration
 * ----------------------------------------
 */

$host= "localhost";
$dbuser ="user";
$dbpass = "pass";
$dbname = "boxtracker";

/* ----------------------------------------
 * Create database connection
 * ----------------------------------------
 */
$connection = mysql_connect($host, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
?>