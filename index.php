<?
/*
    Boxtracker - Simple tracking of computer availability and ip-address.
    Copyright (C) <2012> <Kim Roar Foldøy Hauge>

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
	
	date_default_timezone_set("Europe/Berlin");

	include("../db.php");
	$box	= htmlentities(strip_tags(mysql_real_escape_string($_GET['box'])), ENT_QUOTES, "UTF-8");;
	$p 	= htmlentities(strip_tags(mysql_real_escape_string($_GET['p'])), ENT_QUOTES, "UTF-8");;	

	if ((strlen($box) > 0) && (strlen($p) > 2))
	{
		$tid = time();
		$ip = $_SERVER['REMOTE_ADDR'];

		if ((strncmp($ip, "158.39.",7) == 0) && !strstr($box,"["))
		{
			$Query = "SELECT box, ip, tid, url FROM	boxtracker WHERE box = '$box'";
			$dbResult = mysql_query($Query);
			$exists = 0;
			while($dbRow = mysql_fetch_object($dbResult))
			{
				$exists = 1;

			}
			if ($exists == 0)
			{
				$q = "INSERT INTO boxtracker SET box = '$box', passord = '$p'";
				mysql_query($q);

			}
		}
	
		$query = "UPDATE boxtracker SET tid = '$tid', ip ='$ip' WHERE box = '$box' AND passord = '$p'";
		mysql_query($query);
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
  <title>AUTH TLS | CWD boxtracker | STAT -al 2004</title>
  <link rel="stylesheet" media="screen">
  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>
<body text="#DDDDDD" link="#AAFFFF" vlink="#AAFFFF" alink="#AAFFFF" BGCOLOR="#000000">

<h1> SysRq Boxtracker 0.15-b1</h1>
<?
$Query = "SELECT box, ip, tid,url FROM boxtracker ORDER by box";
if(!($dbResult = mysql_query($Query)))
{
        print("Couldn't execute query!<BR>\n");
        print("MySQL reports: " . mysql_error() . "<BR>\n");
        print("Query was: $Query<BR>\n");
        exit();
}
print("<table width=\"100%\"> <tr><td>&nbsp;</td><td> BOKS </td><td>IP</td><td>Sist sett på nett</td><td></td>\n");
while($dbRow = mysql_fetch_object($dbResult))
{
	$smiley = "smiley-dead.png";
	$penaar = 0;

	if ($dbRow->tid > 1)
	{
		$pentid  = date("Y d M. \K\l\o\k\k\e\\n H:i", $dbRow->tid );
		$difftid = time() - $dbRow->tid;

		if      ($difftid > (3600 * 24 * 30))	$smiley = "smiley-dead.png"; // mer enn 1 maaned
		else if ($difftid > (3600 * 24))        $smiley = "smiley-sad.png"; // mer enn 1 dag
		else if ($difftid > (60))               $smiley = "smiley-neutral.png"; // mer enn 1 minutt
		else                                    $smiley = "smiley-happy.png"; // under et minutt

		if ($difftid > (3600*24*30))
		{
			$pendag = floor( $difftid / (3600 * 24 * 30));
			while ($pendag > 12)
			{
				$penaar++;
				$pendag = $pendag - 12;

			}
			if ($penaar)
			{
				if ($pendag > 1)
					$pensiden = "($penaar &aring;r og $pendag måneder siden)";
				else
					$pensiden = "($penaar &aring;r og $pendag måned siden)";
			}
			else {
				if ($pendag > 1)
					$pensiden = "($pendag måneder siden)";
				else
					$pensiden = "($pendag måned siden)";	
			}
		}
		else if ($difftid > (3600*24))
		{
			$pendag = floor( $difftid / (3600 * 24));
			$pensiden = "($pendag dager siden)";
		}
		else if ($difftid > 3599)
		{
			$pentimer = floor($difftid / (3600));
			if ($pentimer > 1)
				$pensiden = "($pentimer timer siden)";
			else
				$pensiden = "($pentimer time siden)";
		}
		else if ($difftid > 61)
		{
			$penminutter = floor( $difftid / (60));
			$pensiden = "($penminutter min. siden)";
		}
		else
		{
			$pensiden = "($difftid sekund siden)" ;
		}
	}
	else
	{
		$pentid = "aldri";
		$pensiden = "";
	}
	
	print("<tr><td><img src=\"$smiley\" /></td><td>$dbRow->box</td><td>");
	if (strlen($dbRow->url))	print("<a href=\"http://$dbRow->url\">$dbRow->ip</a>");
	else				print("$dbRow->ip");

	print("</td><td>$pentid</td><td>$pensiden</td></tr>\n");

}
print("</table>\n");
?>
<h2>Dokumentasjon</h2>
Maskinene må selv si i fra når de er i live, så blir dette registrert i en database.<br/>
<img src="smiley-dead.png"> - Maskinen har vært offline i mer enn 30 dager.<br/>
<img src="smiley-sad.png"> - Maskinen har vært offline i 1 dag til 30 dager.<br/>
<img src="smiley-neutral.png"> - Maskinen har vært offline i 1 minutt til 1 dag.<br/>
<img src="smiley-happy.png"> - Maskinen har vært aktiv i det siste minuttet.<br/>

<h2>Nedlasting</h2>
<a href="boxtracker-0.15-b1.tar">0.15-b1</a> Nyeste offentlige versjon, antagelig stabil.

<h2>Installasjon klient</h2>
<pre>echo "wget -q -O /dev/null \"http://boxtracker.sysrq.no/index.php?box=[BOX]&amp;p=[PASSORD]\"" > /root/boxtracker.sh
chmod +x /root/boxtracker.sh
crontab -e
*/1 * * * * /root/boxtracker.sh > /dev/null</pre>
<h2>Installasjon server</h2>
<pre>Du trenger en mysql-database med en tabell 'boxtracker' med følgende felter:
box - varchar(100)
ip - varchar(20)
tid - bigint(20)
gruppe - varchar(20) 
passord - varchar(50)
url - varchar(200)

Putt index.php sammen med png-bildene i en egnet katalog.
Putt db.php i en katalog som ikke er lesbar for andre og endre index.php til å 
peke til denne filens lokasjon.</pre>

<h2>Changelog</h2>
<pre>
0.15-b1 (2012-01-06)
* Forbedret sikkerhet, fjernet mulig SQL-injection.
* Fjerne kolonne for 'link'. Denne funksjonaliteten er nå en del av ip-kolonnen
* Oppdatert dokumentasjonen, kort om installasjon på serverside.

0.14-r2 (2012-01-06)
* Versjon 0.14 release 2 er nå tilgjengelig som <a href="boxtracker-0.14r2.tar">download</a>.

0.14 (2011-11-25)
* Koden er nå tilgkengelig under en GPL3-lisens, ta kontakt på irc for kildekode.

0.13-rc4 (2011-10-22)
* Fikset det slik at det når står måned i entall om det kun er en måned.
* Endret bredden på tabellen til 100%.

0.13-rc3 (2011-08-13)
* Maskiner med nedetid over 30 dager får nå nedetid i år og måneder.

0.13-rc2
* Maskiner med [ osv i navnet kan ikke autoregistreres.

0.13-rc1
* Du kan nå registrere nye maskiner automatisk fra en god del av uninett,  
  kontakt zokum på EFNet for maskiner utenom uninett.

0.12-rc1
* Flyttet over på egen prosjektkonto

0.11
* Småfikser, husker ikke så godt.

0.10
* Første offentlige versjon</pre>
</body>
</html>
