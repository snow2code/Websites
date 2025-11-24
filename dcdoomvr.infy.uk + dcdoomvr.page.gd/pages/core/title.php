<?php

if (!defined("ON_SITE")) {
    echo "You should not be here. Only follow links!";
    die();
}
global $smarty;

$breadcrumb = [
    [
        'title' => 'Home',
        'url' => 'index.php?p=home'
    ]
];

$smarty->assign('board_name', "title board_name");
$smarty->assign('title', $title);
$smarty->assign('breadcrumb', $breadcrumb);
$smarty->display('core/title.tpl');
