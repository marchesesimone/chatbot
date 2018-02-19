<?php
require __DIR__ . '/../vendor/autoload.php';


use Mpociot\BotMan\Conversations\InlineConversation;
use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Cache\CodeIgniterCache;
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
      $this->ask(print_r($answer));
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
