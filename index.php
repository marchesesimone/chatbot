<?php
require __DIR__ . '/vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

$config = [
  // Your driver-specific configuration
  'facebook' => [
    'token' => 'EAAHCF500w5sBAOjpYTJOQPYlEF58oRae1gdNVPRLxWY2g4Iya8axaYWRTp0OGJDnujRuzRyTH2ZAAzRSZBZCb5gmpXOz2RDWPugZAYsiH5mZC2IiZBg1ESMzgqRxk3ZBTWTXNhUG55DeZAe0eo4M850KEIkgieIZC78JnYFFOQSHRNAZDZD',
    'app_secret' => '8dbc5620f7bb9c4e3c6ccb7bd51f30b8',
    'verification'=>'tutorialbotfacebook-verify',
  ]
];

DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);


// create an instance
$botman = BotManFactory::create($config);

// give the bot something to listen for.
$botman->hears('Ciao', function (BotMan $bot) {
  $bot->reply('Ciao benvenuto in Wellnet! Come posso aiutarti?');
});

$botman->hears('button', function (BotMan $bot) {
  $bot->typesAndWaits(2);
  $bot->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
    ->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'))
    ->addButton(ElementButton::create('Show me the docs')->url('http://botman.io/'))
  );
});


$botman->listen();