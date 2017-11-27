<?php
require __DIR__ . '/vendor/autoload.php';

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
$botman->hears('Ciao', function (BotMan $bot) {
  $bot->reply('Ciao benvenuto in Wellnet! Come posso aiutarti?');
  $bot->typesAndWaits(2);
  $bot->reply(GenericTemplate::create()
    ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
    ->addElements([
      Element::create('Vuoi sapere dove ci troviamo?')
        ->subtitle('Wellnet a Milano')

        ->addButton(ElementButton::create('visit')->url('https://wellnet.it'))
        ->addButton(ElementButton::create('tell me more')
          ->payload('tellmemore')->type('postback')),
      Element::create('Vuoi parlare con l’amministrazione?')
        ->addButton(ElementButton::create('visit')
          ->url('https://github.com/mpociot/botman-laravel-starter')
        ),
      Element::create(' Hai bisogno di un preventivo?')
        ->subtitle('Descrivi il tuo progetto')
        ->addButton(ElementButton::create('Richiedi')
          ->url('https://wellnet.it/contatti')
        )
    ])


  );
});



$botman->listen();