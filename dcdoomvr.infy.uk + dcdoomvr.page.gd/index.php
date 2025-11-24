<?php
/*==========================================================================*

  File:        index.php                      Created: 17/06/2025
  Purpose:     The primary file for
               the website

  Project:     DCDoomVR personal site
  Author:      Snowy  –  snow2code@protonmail.com
  Copyright:   © 2025 DCDoomVR. All rights reserved.
               This is personal hobby code. No warranty, no promises.
               Please don’t nick it without asking.

  Color‑blind note: no red‑green reliance anywhere. Verified for deuteranopia.

 *==========================================================================*/




global $smarty;

require_once 'vendor/autoload.php'; // Include Composer autoload or Smarty library
include_once 'page-builder.php';
include_once "site-callback.php";
include_once 'init.php';


$smarty = new \Smarty\Smarty;

// $smarty->debugging = false;
// $smarty->caching = true;
// $smarty->cache_lifetime = 120;

// $smarty->display('home.tpl');


$smarty->configLoad("configs/config.conf");

$config = $smarty->getConfigVars();

// Example: Use the configuration variables
// echo "Site Name: " . $config['site_name'] . "<br>";
// echo "Admin Email: " . $config['admin_email'];
$route = route();

build($route[0], $route[1]);