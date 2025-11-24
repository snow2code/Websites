<?php

if (!defined("ON_SITE")) {
    echo "You should not be here. Only follow links!";
    die();
}

$navbar = [
    [
        'title' => 'Home',
        'endpoint' => 'home'
    ],
    [
        'title' => 'DCDoomVR',
        'endpoint' => 'dcdoomvr'
    ],
    [
        'title' => 'Site Author',
        'endpoint' => 'siteauthor'
    ]
];

$smarty->assign('navbar', array_values($navbar));
$smarty->display('core/navbar.tpl');
