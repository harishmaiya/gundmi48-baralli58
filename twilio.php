<?php
require_once('twilio/Services/Twilio.php'); // Loads the library

$account_sid = 'AC86dee6bbb798dfa194415808420c6518'; 
$auth_token = '0a4495ba71d620a5981f0527743e5de4'; 
$client = new Services_Twilio($account_sid, $auth_token); 
 $client->account->messages->create(array( 
	'To' => "+917845727657", 
	'From' => "+14703308893", 
	'Body' => "I will come by Tomorrow",   
));