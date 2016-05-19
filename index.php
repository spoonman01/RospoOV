<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api('228323367:AAEXLPwj85d0lgioziW8HWINB2T8jZhOVqw'); // Set your access token
$url = 'https://rospo.herokuapp.com/'; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));

//your app
try {

    if($update->message->text == '/email')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "You can send email to : lucarospocher@gmail.com"
     	]);
    }
    else if($update->message->text == '/help')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "List of commands :\n /email -> Rospo's secret email \n /countdown -> Mostra il countdown di Overwatch \n /help -> Lista Comandi"
    		]);

    }
    else if($update->message->text == '/countdown')
    {
        $event = mktime(0,0,0,5,24,2016);
        $secondsLeft = $event - time();
        
        $days = floor($secondsLeft / (60*60*24));
        $hours = floor(($secondsLeft - $days*60*60*24) / (60*60))
        //$minutes = floor(($secondsLeft - $days*60*60*24 - $hours*60*60) / 60)
        
    	$response = $client->sendMessage([
         	'chat_id' => $update->message->chat->id,
         	'text' => "Overwatch Countdown: ".$days." giorni, ".$hours." ore e ".$minutes." minuti"
     	]);

    }
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Invalid command, please use /help to get list of available commands"
    		]);
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}
