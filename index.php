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
  $botman->reply(GenericTemplate::create()
    ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
    ->addElements([
      Element::create('BotMan Documentation')
        ->subtitle('All about BotMan')
        ->image('http://botman.io/img/botman-body.png')
        ->addButton(ElementButton::create('visit')->url('http://botman.io'))
        ->addButton(ElementButton::create('tell me more')
          ->payload('tellmemore')->type('postback')),
      Element::create('BotMan Laravel Starter')
        ->subtitle('This is the best way to start with Laravel and BotMan')
        ->image('http://botman.io/img/botman-body.png')
        ->addButton(ElementButton::create('visit')
          ->url('https://github.com/mpociot/botman-laravel-starter')
        )
    ])
  );
});

$botman->listen();