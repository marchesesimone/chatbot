<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/basic.php';



use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Messages\Message;
use Mpociot\BotMan\Facebook\ElementButton;
use Mpociot\BotMan\Facebook\ButtonTemplate;

use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Message;
use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\BotManFactory;




$config = [
  'facebook_token' => Config::FACEBOOK_TOKEN,
  'facebook_app_secret' => Config::FACEBOOK_APP_SECRET,
];

// create an instance
$botman = BotManFactory::create($config);

$botman->verifyServices('tutorialbotfacebook-verify');

// give the bot something to listen for.
$botman->hears('Hi', function (BotMan $bot) {
  $bot->typesAndWaits(2);
  $bot->reply(ButtonTemplate::create('Welcome to Wellnet! How can I help you?')
    ->addButton(ElementButton::create('Where we are')->url('https://www.google.it/maps/place/Wellnet+S.r.l./@45.467766,9.173752,17z/data=!3m1!4b1!4m5!3m4!1s0x4786c151cfb6560f:0x529a891fd0d58a8c!8m2!3d45.4677623!4d9.175946'))
    ->addButton(ElementButton::create('Contact')->url('https://www.wellnet.it/contatti'))
    ->addButton(ElementButton::create('Want a quote?')->url('https://www.wellnet.it/contatti'))
  );
});

$botman->hears('test', function (BotMan $bot) {
  $bot->reply('OK');
});

$botman->hears('Hello', function($bot) {
  $bot->startConversation(new Facebook());
});



$botman->listen();