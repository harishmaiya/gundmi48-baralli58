<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apns
{
	public function send_push_message($deviceId,$messages){
		date_default_timezone_set('Asia/Kolkata');
		error_reporting(-1);
		require_once(APPPATH.'/third_party/ApnsPHP/Autoload.php');
		$push = new ApnsPHP_Push(
			ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
			'certificates/certficate_rentes.pem'
			//ApnsPHP_Abstract::ENVIRONMENT_SANDBOX,
			//'certificates/certficate_rentes.pem'
		);
		$push->connect();

		$message = new ApnsPHP_Message($deviceId);

		$message->setCustomIdentifier("Message-Badge-3");

		$message->setBadge(3);

		$message->setText($messages['message']);

		$message->setSound();

		$message->setCustomProperty('acme2', array('bang', 'whiz'));

		$message->setCustomProperty('acme3', array('bing', 'bong'));
		
		$message->setCustomProperty('message', $messages);

		$message->setExpiry(30);

		$push->add($message);

		$push->send();

		$push->disconnect();
		return $push->getErrors();
	}
}