<?php

function getSystemMessage()
{
    $statusUrl = "https://raw.githubusercontent.com/snow2code/websites/dcdoomvr/refs/heads/main/system-message/active";
    $messageUrl = "https://raw.githubusercontent.com/snow2code/websites/dcdoomvr/refs/heads/main/system-message/message";
    $systemmessage__Status = file_get_contents($statusUrl);
    $systemmessage__Message = file_get_contents($messageUrl);
    
    if ($systemmessage__Status === false) {
        // "Failed to fetch the file."
    } else {
        if ($systemmessage__Status === "true\n") {
            // console.log("true");
            return ['active', $systemmessage__Message];
        // } else {
        //     console.log("bad value");
        }
    }
}

?>