<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;

$config = [
  // Your driver-specific configuration
  'facebook' => [
    'token' => 'EAAHCF500w5sBABBluOef4LXVNv7oFWmnQxawj8tbyENo1ZC5XL8tTGqTEgHkQndHDXQfn9OaiVgXjzmx5fEHZBy9YqhLB47esFYUJACkEtgjCPEAd7x7qkHAU0NjT1IRmT6MviLMpQnFqhzZCOl1OuuXB76wzp0rgQt9QiNZAwZDZD',
    'app_secret' => '8dbc5620f7bb9c4e3c6ccb7bd51f30b8',
    'verification'=>'MY_SECRET_VERIFICATION_TOKEN',
  ]
];

// create an instance
$botman = BotManFactory::create($config);

// give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
  $bot->reply('Hello yourself.');
});

// start listening
$botman->listen();