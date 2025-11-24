<?php

global $theme;
if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}
define('IN_HOME', true);

$theme->display('pages/crew.tpl');
