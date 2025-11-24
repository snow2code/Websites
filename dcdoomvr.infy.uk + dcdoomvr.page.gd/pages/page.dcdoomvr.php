<?php

if (!defined("ON_SITE")) {
    echo "You should not be here. Only follow links!";
    die();
}
define('IN_HOME', true);

$smarty->display('page_dcdoomvr.tpl');
