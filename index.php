<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/basic.php';

use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Facebook\ElementButton;
use Mpociot\BotMan\Facebook\ButtonTemplate;
use Mpociot\BotMan\Cache\DoctrineCache;
use Doctrine\Common\Cache\FilesystemCache;
use \DBApp\DB;
use \ConfigApp\Config;

$config = [
  'facebook_token' => Config::FACEBOOK_TOKEN,
  'facebook_app_secret' => Config::FACEBOOK_APP_SECRET,
];

// create an instance and settings cache for conversation system
$doctrineCacheDriver = new FilesystemCache(__DIR__);
$botman = BotManFactory::create($config, new DoctrineCache($doctrineCacheDriver));


// Callback Services
$botman->verifyServices('tutorialbotfacebook-verify');

$botman->hears('.*(Hi|Start).*', function (BotMan $bot) {
  $bot->reply(ButtonTemplate::create('Welcome to Wellnet! How can I help you?')
    ->addButton(ElementButton::create('Where we are')->url('https://www.google.it/maps/place/Wellnet+S.r.l./@45.467766,9.173752,17z/data=!3m1!4b1!4m5!3m4!1s0x4786c151cfb6560f:0x529a891fd0d58a8c!8m2!3d45.4677623!4d9.175946'))
    ->addButton(ElementButton::create('Contact')->url('https://www.wellnet.it/contatti'))
    ->addButton(ElementButton::create('Want a quote?')->url('https://www.wellnet.it/contatti'))
  );
});

$botman->hears('Hello', function(BotMan $bot) {
  $bot->startConversation(new Facebook());
});

$botman->hears('Contact', function(BotMan $bot) {
  $bot->reply('My contacts are:');
  $bot->reply('Marchese Simone');
  $bot->reply('✉ simo.marchese@hotmail.it');
});

$botman->fallback(function(BotMan $bot) {
  $bot->reply('Sorry, I did not understand these commands 🤔.');
  $bot->reply('Here is a list of commands I understand: Hi, Hello and Contact');
});

$botman->hears('unsubscribe_yes', function(Botman $bot) {

  $con = new DB();
  $bot_id = $bot->getUser()->getId();
  $del_user = $con->delete('user', 'botman_id', $bot_id);
  if ($del_user) {
    $bot->reply('Unsubscribe success!!');
  } else {
    $bot->reply('Unsubscribe error for ' . $bot_id);
  }
});

$botman->hears('unsubscribe_no', function(Botman $bot) {
  $bot->reply('Great!! 👍');
});

$botman->listen();