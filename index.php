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

    if($update->message->text == '/email' || $update->message->text == '/email@RospoOV_Bot')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "You can send email to : lucarospocher@gmail.com"
     	]);
    }
    else if($update->message->text == '/help' || $update->message->text == '/help@RospoOV_Bot')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "List of commands :\n /email -> Rospo's secret email \n /countdown -> Mostra il countdown di LFC \n /help -> Lista Comandi"
    		]);

    }
    else if($update->message->text == '/countdown'  || $update->message->text == '/countdown@RospoOV_Bot')
    {
        $event = mktime(0,30,8,6,22,2016);
        $secondsLeft = $event - time();
        
        //$days = 6;
        //$hours = 7;
        //$minutes = 8;
        $days = floor($secondsLeft / 86400);
        $hours = floor(($secondsLeft - ($days * 86400)) / 3600) - 1;
        $minutes = floor(($secondsLeft - ($days * 86400) - (($hours + 1) * 3600)) / 60) + 1;
        
    	$response = $client->sendMessage([
         	'chat_id' => $update->message->chat->id,
         	'text' => "LFC Countdown: ".$days." giorni, ".$hours." ore e ".$minutes." minuti"
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
