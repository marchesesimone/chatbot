<?php
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\Conversations;

class OnboardingConversation extends Conversation
{
  protected $firstname;

  protected $email;

  public function __construct() {
    print 'Start conversation';
  }
/*
  public function askFirstname()
  {
    $this->ask('Hello! What is your firstname?', function(Answer $answer) {
      // Save result
      $this->firstname = $answer->getText();

      $this->say('Nice to meet you '.$this->firstname);
      $this->askEmail();
    });
  }

  public function askEmail()
  {
    $this->ask('One more thing - what is your email?', function(Answer $answer) {
      // Save result
      $this->email = $answer->getText();

      $this->say('Great - that is all we need, '.$this->firstname);
    });
  }

  public function run()
  {
    // This will be called immediately
    $this->askFirstname();
  }*/
}
