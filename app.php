<?php
if (!session_start()) die ("stop");

require_once 'common.php';
require_once INCLUDE_DIR.'app.class.php';

$app = new app();
$app->start($_REQUEST);

?>