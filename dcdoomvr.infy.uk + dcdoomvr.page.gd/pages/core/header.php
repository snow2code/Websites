<?php

if (!defined("ON_SITE")) {
    echo "You should not be here. Only follow links!";
    die();
}
global $smarty;


$smarty->assign('title', $title);
$smarty->assign('page', filter_input(INPUT_GET, 'p', FILTER_SANITIZE_SPECIAL_CHARS));


$systemMessage = getSystemMessage();

if ($systemMessage[0] == "active") {
    $smarty->assign('systemmessage', $systemMessage[1]);
} else {
    $smarty->assign('systemmessage', "null");
}

$smarty->display('core/header.tpl');