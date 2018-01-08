<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/basic.php';

use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Messages\Message;
use Mpociot\BotMan\Facebook\ElementButton;
use Mpociot\BotMan\Facebook\ButtonTemplate;

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


// give the bot something to listen for.
$botman->hears('customer', function (BotMan $bot) {
  $index = $client->initIndex(Config::ALGOLIA_INDEX);

  $bot->reply(ButtonTemplate::create('Per quale customer vuoi cercare?');
  $bot->raply($answer->getText());
  /*// without search parameters
  $res = $index->search('query string');

  // with search parameters
  $res = $index->search('query string', [
    'attributesToRetrieve' => [
      'firstname',
      'lastname',
    ],
    'hitsPerPage' => 50
  ]);*/
});

$botman->listen();