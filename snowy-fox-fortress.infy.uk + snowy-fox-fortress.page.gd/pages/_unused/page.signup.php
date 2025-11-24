<?php
/*************************************************************************
This file is part of SourceBans++

SourceBans++ (c) 2014-2024 by SourceBans++ Dev Team

The SourceBans++ Web panel is licensed under a
Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.

You should have received a copy of the license along with this
work.  If not, see <http://creativecommons.org/licenses/by-nc-sa/3.0/>.

This program is based off work covered by the following copyright(s):
SourceBans 1.4.11
Copyright © 2007-2014 SourceBans Team - Part of GameConnect
Licensed under CC-BY-NC-SA 3.0
Page: <http://www.sourcebans.net/> - <http://www.gameconnect.net/>
*************************************************************************/

if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}

global $userbank, $theme;

// Check if the user is already logged in
if ($userbank->is_logged_in()) {
    echo "<script>window.location.href = 'index.php';</script>"; // Redirect to the main page using JavaScript
    exit;
}

// Handle messages based on query parameters
if (isset($_GET['m'])) {
    $lostpassword_url = Host::complete() . '/index.php?p=lostpassword';
    switch ($_GET['m']) {
        case 'no_access':
            echo <<<HTML
                <script>
                    ShowBox(
                        'Error - Cannot Signup',
                        '' +
                        '',
                        'red', '', false
                    );
                </script>
HTML;
            break;
        case 'failed':
            echo <<<HTML
                <script>
                    ShowBox(
                        'Error',
                        'User probably already exists',
                        'red', '', false
                    );
                </script>
HTML;
            break;


    }
}

$theme->assign('redir', "DoSignup('');");
$theme->setLeftDelimiter("-{");
$theme->setRightDelimiter("}-");
$theme->display('page_signup.tpl');
$theme->setLeftDelimiter("{");
$theme->setRightDelimiter("}");