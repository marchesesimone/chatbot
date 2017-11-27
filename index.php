<?php
require __DIR__ . '/vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

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
  $bot->reply('Ciao Benvenuto in Wellnet!');
  $bot->reply(ButtonTemplate::create('Ciao Benvenuto in Wellnet! Come posso aiutarti?')
    ->addButton(ElementButton::create('Vuoi sapere dove ci troviamo?')->url('https://www.wellnet.it/contatti'))
    ->addButton(ElementButton::create('Vuoi parlare con l’amministrazione?')->url('http://botman.io/'))
    ->addButton(ElementButton::create('Hai bisogno di un preventivo?')->url('https://www.wellnet.it/contatti'))
  );
});

$botman->listen();