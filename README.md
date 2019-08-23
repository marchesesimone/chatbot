## Chatbot Tutorial

Questo codice è stato utilizzato per scrivere il seguente articolo
https://www.wellnet.it/blog/tutorial/come-creare-un-chatbot-facebook-messenger-parte-1

## Requisiti
1. Avere una pagina Facebook ed essere amministratori
2. Utilizzare php 7

## Installazione
Copiare il file `classes/Config.class.php.dist` in `classes/Config.class.php` e valorizzare le costanti di Facebook
Dalla root del progetto lanciare `composer install`

## Config botman
```
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
  'facebook_token' => 'YOUR-FACEBOOK-TOKEN-HERE',
  'facebook_app_secret' => 'YOUR-FACEBOOK-APP-SECRET-HERE',
  'wechat_app_id' => 'YOUR-WECHAT-APP-ID',
  'wechat_app_key' => 'YOUR-WECHAT-APP-KEY',
];
```