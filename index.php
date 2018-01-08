<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/Config.php';

use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Messages\Message;
use Mpociot\BotMan\Facebook\ElementButton;
use Mpociot\BotMan\Facebook\ButtonTemplate;

$config = [
  'hipchat_urls' => [
    'YOUR-INTEGRATION-URL-1',
    'YOUR-INTEGRATION-URL-2',
  ],
  'nexmo_key' => 'YOUR-NEXMO-APP-KEY',
  'nexmo_secret' => 'YOUR-NEXMO-APP-SECRET',
  'microsoft_bot_handle' => 'YOUR-MICROSOFT-BOT-HANDLE',
  'microsoft_app_id' => 'YOUR-MICROSOFT-APP-ID',
  'microsoft_app_key' => 'YOUR-MICROSOFT-APP-KEY',
  'slack_token' => 'YOUR-SLACK-TOKEN-HERE',
  'telegram_token' => 'YOUR-TELEGRAM-TOKEN-HERE',
  'facebook_token' => 'EAAHCF500w5sBAOjpYTJOQPYlEF58oRae1gdNVPRLxWY2g4Iya8axaYWRTp0OGJDnujRuzRyTH2ZAAzRSZBZCb5gmpXOz2RDWPugZAYsiH5mZC2IiZBg1ESMzgqRxk3ZBTWTXNhUG55DeZAe0eo4M850KEIkgieIZC78JnYFFOQSHRNAZDZD',
  'facebook_app_secret' => '8dbc5620f7bb9c4e3c6ccb7bd51f30b8',
  'wechat_app_id' => 'YOUR-WECHAT-APP-ID',
  'wechat_app_key' => 'YOUR-WECHAT-APP-KEY',
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
$botman->hears('algolia', function (BotMan $bot) {
  $bot->reply(Config::ALGOLIA_APP_ID);
});

$botman->listen();