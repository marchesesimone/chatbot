<?php
require __DIR__ . '/../vendor/autoload.php';


use Mpociot\BotMan\Conversations\InlineConversation;
use Mpociot\BotMan\Answer;
use Mpociot\BotMan\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

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
    $this->askForDatabase();
  }

  // ...inside the conversation object...
  public function askForDatabase()
  {
    $question = Question::create('Do you need a database?')
      ->fallback('Unable to create a new database')
      ->callbackId('create_database')
      ->addButtons([
        Button::create('Of course')->value('yes'),
        Button::create('Hell no!')->value('no'),
      ]);

    $this->ask($question, function (Answer $answer) {
      // Detect if button was clicked:
      if ($answer->isInteractiveMessageReply()) {
        $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
        $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
      }
    });
  }
}
