<?php
/*
 * Project: Double-P Framework
 * Copyright: 2011-2012, Moin Uddin (pay2moin@gmail.com)
 * Version: 1.0
 * Author: Moin Uddin
 */
define("BASE","http://localhost/cm");
define("SPICE","ydtfm~");
date_default_timezone_set('UTC');
define("START", 2);
$link=mysql_connect("localhost","root","") or die('Could not connect:'.mysql_error());
mysql_select_db("db_name",$link) or die('Could not select database:'.mysql_error());
?>
