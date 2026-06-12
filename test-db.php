<?php
require 'app/core/DB.php';
$c = ConnectDB::Connect();
echo $c ? 'Connected' : 'Failed';
