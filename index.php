<?php
require __DIR__ . '/vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;

$config = [
  // Your driver-specific configuration
  'facebook' => [
    'token' => 'EAAHCF500w5sBAOjpYTJOQPYlEF58oRae1gdNVPRLxWY2g4Iya8axaYWRTp0OGJDnujRuzRyTH2ZAAzRSZBZCb5gmpXOz2RDWPugZAYsiH5mZC2IiZBg1ESMzgqRxk3ZBTWTXNhUG55DeZAe0eo4M850KEIkgieIZC78JnYFFOQSHRNAZDZD',
    'app_secret' => '8dbc5620f7bb9c4e3c6ccb7bd51f30b8',
    'verification'=>'tutorialbotfacebook-verify',
  ]
];

// create an instance
$botman = BotManFactory::create($config);

// In your BotMan controller
$botman->verifyServices('tutorialbotfacebook-verify');

// give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
  $bot->reply('Hello yourself.');
});

// start listening
$botman->listen();