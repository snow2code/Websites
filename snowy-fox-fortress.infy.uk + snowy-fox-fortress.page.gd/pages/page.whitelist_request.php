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

global $userbank, $theme;

use Sbpp\Mail\EmailType;
use Sbpp\Mail\Mail;
use Sbpp\Mail\Mailer;
use xPaw\SourceQuery\SourceQuery;

if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}
if (!Config::getBool('config.enablesubmit')) {
    print "<script>ShowBox('Error', 'This page is disabled. You should not be here.', 'red');</script>";
    PageDie();
}
if (!isset($_POST['subban']) || $_POST['subban'] != 1) {
    $ProfileID       = "";
    $PlayerName    = "";
    $Comments      = "";
    $Email         = "";
    echo "meow";
} else {
    $ProfileID       = trim(htmlspecialchars($_POST['ProfileID']));
    $PlayerName    = htmlspecialchars($_POST['PlayerName']);
    $Comments      = htmlspecialchars($_POST['Comments']);
    $Email         = trim(htmlspecialchars($_POST['EmailAddr']));
    $validsubmit   = true;
    $errors        = "";
    if (strlen($ProfileID) == 0) {
        $errors .= '* Please type a valid ProfileID.<br>';
        $validsubmit = false;
    }
    if (strlen($PlayerName) == 0) {
        $errors .= '* You have to include your nickname<br>';
        $validsubmit = false;
    }
    if (strlen($Comments) == 0) {
        $errors .= '* You must include reasoning for your whitelist<br>';
        $validsubmit = false;
    }
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors .= '* You must include a valid email address<br>';
        $validsubmit = false;
    }


    if (!$validsubmit) {
        print "<script>ShowBox('Error', '$errors', 'red');</script>";
    }

    if ($validsubmit) {
        $pre = $GLOBALS['db']->Prepare("INSERT INTO " . DB_PREFIX . "_whitelistrequest(date,profileid,name,email,reason) VALUES (UNIX_TIMESTAMP(),?,?,?,?)");

        // execute with the matching four values
        $GLOBALS['db']->Execute(
            $pre,
            array(
                $ProfileID,     // treating SteamID as the profileid
                $PlayerName,  // name
                $Email,       // email
                $Comments    // reason
            )
        );
        
        $subid = (int) $GLOBALS['db']->Insert_ID();
        // $ProfileID       = "";
        // $PlayerName      = "";
        // $Comments     = "";
        // $Email = "";
        
        $webhook = "https://discord.com/api/webhooks/1383535930937184286/SssO65qyLNCD0PjrjJdherq00Ko0sYYJaKSlMswVvfelIP0_k9g72XnLk4rgPP0ZhQeZ";
        $_WEBHOOK = "embed";

        if ($_WEBHOOK == "normal") {
            // Message payload
            $data = [
                "content" => "Hello, Discord! This is a message from PHP.",
                "username" => "PHP Bot", // Optional: Set a custom username
                "avatar_url" => "https://example.com/avatar.png" // Optional: Set a custom avatar
            ];

            // Convert data to JSON
            $jsonData = json_encode($data);

            // Initialize cURL
            $ch = curl_init($webhook);

            // Set cURL options
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the request
            $response = curl_exec($ch);

            // Check for errors
            if (curl_errno($ch)) {
                echo "Error: " . curl_error($ch);
            } else {
                echo "Message sent successfully!";
            }

            // Close cURL
            curl_close($ch);
        } elseif ($_WEBHOOK == "embed") {
            $hookObject = json_encode([
                "content" => null,
                "username" => "Whitelisting",
                "avatar_url" => "https://pbs.twimg.com/profile_images/972154872261853184/RnOg6UyU_400x400.jpg",
                "tts" => false,
                
                // "file" => "",
                
                "embeds" => [
                    [
                        "title" => "Whitelist Request",
                        "type" => "rich",
                        "description" => "",

                        // "url" => "https://www.google.com/",

                        "timestamp" => date('c'),
                        "color" => hexdec( "FFFFFF" ),

                        "footer" => [
                            "text" => "snowy-fox-fortress.infy.uk",
                            // "icon_url" => "https://th.bing.com/th/id/OIP.Zc9EIFwNtOX2PI9RGS47zgHaHV?rs=1&pid=ImgDetMain"
                        ],

                        // "image" => [
                        //     "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
                        // ],

                        // "thumbnail" => [
                        //     "url" => "https://th.bing.com/th/id/OIP.Zc9EIFwNtOX2PI9RGS47zgHaHV?rs=1&pid=ImgDetMain"
                        // ],

                        // Author object
                        "author" => [
                            "name" => "Snow2Code",
                            "url" => "https://snow2code.vercel.app"
                        ],

                        // Field array of objects
                        "fields" => [
                            // Field 1
                            [
                                "name" => "Status",
                                "value" => "Pending",
                                "inline" => true
                            ],
                            [
                                "name" => "ProfileID",
                                "value" => "{$ProfileID}",
                                "inline" => true
                            ],
                            [
                                "name" => "Username",
                                "value" => "$PlayerName",
                                "inline" => true
                            ],
                            [
                                "name" => "Comments",
                                "value" => "{$Comments}",
                                "inline" => true
                            ]
                        ]
                    ]
                ]

            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

            $ch = curl_init();

            curl_setopt_array( $ch, [
                CURLOPT_URL => $webhook,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $hookObject,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ]
            ]);

            $response = curl_exec( $ch );
            curl_close( $ch );
        }

        print "<script>ShowBox('Successful', 'Your submission has been added into the database, and will be reviewed by one of our admins.', 'green');</script>";
    }
}


$theme->assign('ProfileID', $ProfileID);
$theme->assign('PlayerName', $PlayerName);
$theme->assign('Comments', $Comments);
$theme->assign('EmailAddr', $Email);

$theme->display('page_whitelist_request.tpl');
