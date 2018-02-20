<?php
require __DIR__ . '/../vendor/autoload.php';


use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\Conversations\InlineConversation;
use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Question;

/**
 * Class Facebook
 */
class Facebook extends InlineConversation {

  /**
   * @var
   */
  protected $firstname;

  /**
   * @var
   */
  protected $email;

  /**
   *
   */
  public function askFirstname() {
    $this->ask('Hello! What is your firstname?', function(Answer $answer) {
      // Reply answer
     $this->bot->reply("Tell me more! " . print_r($answer));
      // Save result
      $this->firstname = $answer->getText();

      $this->say('Nice to meet you ' . $this->firstname);
      $this->askEmail();
    });
  }

  public function askEmail() {
    $this->ask('One more thing - what is your email?', function(Answer $answer) {
      // Save result
      $this->email = $answer->getText();

      $this->say('Great - that is all we need, '.$this->firstname);
    });
  }

  public function run() {
    // This will be called immediately
    $this->askFirstname();
  }
}
