/*
 Boxtracker - Simple tracking of computer availability and ip-address.
 Copyright (C) <2012> <Kim Roar FoldÃ¸y Hauge>
 Copyright (C) <2011-2012> <Vegard LangÃ¥s>

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
 
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Tabellstruktur for tabell `boxtracker`
--

CREATE TABLE IF NOT EXISTS `boxtracker` (
  `box` varchar(100) NOT NULL COMMENT 'Navnet på datamaskinen (boxen)',
  `ip` varchar(20) NULL COMMENT 'Sist rapporterte ip-adresse',
  `tid` bigint(20) NULL COMMENT 'Unix timestamp for siste rapportering',
  `gruppe` varchar(20) NULL,
  `passord` varchar(50) NOT NULL COMMENT 'Passord slik at ikke u-authoriserte kan oppdatere',
//  `url` varchar(200) NULL,
//  `master` BOOLEAN NOT NULL DEFAULT false ,
  `dns_tid` bigint(20) NULL COMMENT 'Unix timestamp for siste oppdatering av dns info',
//  `dns_user` varchar(200) NULL COMMENT 'bruker:pw til dns tjeneste',
  `dns_hostname` varchar(200) NULL COMMENT 'domenenavnet som skal oppdateres hos dns',
  `dns_status` varchar(200) NULL COMMENT 'Status på dns oppdateringen',
//  `dns_type` varchar(200) NULL COMMENT 'dns provider, eks: no-ip, dyndns'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `userid` bigint(20) NOT NULL COMMENT 'Navnet på datamaskinen (boxen)',
  `username` varchar(100) NOT NULL COMMENT 'Navnet på datamaskinen (boxen)',
  `passord` varchar(50) NOT NULL COMMENT 'Passord slik at ikke u-authoriserte kan oppdatere',
  `master` BOOLEAN NOT NULL DEFAULT false ,
  `dns_user` varchar(200) NULL COMMENT 'bruker:pw til dns tjeneste',
  `dns_type` varchar(200) NULL COMMENT 'dns provider, eks: no-ip, dyndns'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `log` (
  `errorlvl` int(1) NOT NULL COMMENT 'Unix timestamp for siste rapportering',
  `description` varchar() NOT NULL COMMENT 'Navnet på datamaskinen (boxen)',
  `box` varchar(50) NOT NULL COMMENT 'Passord slik at ikke u-authoriserte kan oppdatere',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;