<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 10-06-2016
 * Time: 09:39 PM

require_once 'Client.php';
require_once 'Notification.php';
require_once 'Message.php';
require_once 'Recipient/Device.php';
$server_key = '_YOUR_SERVER_KEY_';
$client = new Client();
$client->setApiKey($server_key);
$client->injectGuzzleHttpClient();

$message = new Message();
$message->addRecipient(new Device('_YOUR_DEVICE_TOKEN_'));
$message
    ->setNotification(new Notification('some title', 'some body'))
    ->setData(['key' => 'value'])
;

$response = $client->send($message);
var_dump($response->getStatusCode());*/
$message=array('notification'=>array(
                                'title'=>'145eghsdv-Test',
                                'text'=>'testingtesting'),
                'to'=>'cZuwKcPHo7g:APA91bFEUIqiv52tuV73zGkLrDTeF_Qx3Ue34dLVUjErhh5wPKaiju-xzoxjVFqrWE2b09pmyRqXzRjyNBZOjRKmY7gtEj0ACRnzXLfiXOP3TFo2BRAPMlzcZzopt2SUry8BKVkh3ulz'
            );
$ch = curl_init('https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Key=AIzaSyBe_E7W1gleL7MDmTj6q__jrmkUQxSOYXc',
        'Content-Type: application/json')
);

$result = curl_exec($ch);
var_dump($result);