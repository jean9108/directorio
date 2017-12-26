<?php
// Conectando, seleccionando la base de datos
$link = mysql_connect('localhost', 'sgesecurityfair_SGE', 'VT!1ag3}#Xp.') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('sgesecurityfair_expositores') or die('No se pudo seleccionar la base de datos');
mysql_query ("SET NAMES 'utf8'");
?>