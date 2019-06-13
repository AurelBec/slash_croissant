<?php
    /*	Configuration */
    //  Slack webhook URL - from the webhook config page
    $slack_webhook_url = "https://hooks.slack.com/services/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";
    /*  Now for some action! */
    //  Grab the POST values from the slash command, create vars for post back to webhook
    $command = $_POST['command'];
    $text = $_POST['text'];
    $token = $_POST['token'];
    $team_id = $_POST['team_id'];
    $channel_id = $_POST['channel_id'];
    $channel_name = $_POST['channel_name'];
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];

    // Send it back through the webhook
    $data = array(
        // "username" => "Slackipedia",
        "channel" => "slash_croissant",
        "text" => "Hey! " + $user_name + " just get croissanted! Guess who will bring breakfast tomorrow? :D",
        // "mrkdwn" => true,
        // "icon_url" => $icon_url,
    );
    $json_string = json_encode($data);        
    $slack_call = curl_init($slack_webhook_url);
    curl_setopt($slack_call, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($slack_call, CURLOPT_POSTFIELDS, $json_string);
    curl_setopt($slack_call, CURLOPT_CRLF, true);                                                               
    curl_setopt($slack_call, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($slack_call, CURLOPT_HTTPHEADER, array(                                                                          
        "Content-Type: application/json",                                                                                
        "Content-Length: " . strlen($json_string))                                                                       
    );                                                                                                                   
    $result = curl_exec($slack_call);
    curl_close($slack_call);
?>
