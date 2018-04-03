<?php

require __DIR__ . '/../vendor/autoload.php';

require_once 'Config.class.php';
require_once 'DB.class.php';

use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\Answer;

/**
 * Class Facebook
 */
class Facebook extends Conversation {

  /**
   * @var
   */
  protected $firstname;

  /**
   * @var
   */
  protected $email;

  /**
   * Facebook constructor.
   */

  protected $db;

  protected $con;

  public function __construct() {
    $this->con = new \DBApp\DB();
  }

  /**
   * Richiedo il nome all'utente e lo salvo
   */
  public function askFirstname() {
    $this->ask('Hello! What is your firstname?', function(Answer $answer) {
      // Save result
      $this->firstname = $answer->getText();

      $this->say('Nice to meet you ' . $this->firstname);
      $this->askEmail();
    });
  }

  /**
   * Richiedo l'email all'utente
   */
  public function askEmail() {
    $userValue = array();
    $this->ask('One more thing - what is your email?', function(Answer $answer) {
      // Save result
      $this->email = $answer->getText();

      $validate_email = $this->checkEmail($this->email);
      if ($validate_email) {

        //$con::getInstance();
        //$con->getConnection();

        $userValue = array(
          "id"    => NULL,
          "name"  =>  $this->firstname,
          "email" =>  $this->email,
          "botman_id" => $this->bot->getUser()->getId()
        );

        // Insert information in DB
        $this->con->insert('user', $userValue, TRUE);
        $this->say('Great - that is all we need, ' . $this->firstname );

      } else {
        $this->say('Attention: enter a valid email address');
        $this->askEmail();
      }

    });
  }

  public function checkEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return FALSE;
    }
    return TRUE;
  }

  public function run() {
    // This will be called immediately
    $user_id = $this->bot->getUser()->getId();
    $this->say($user_id);
    $user = $this->con->find('user', 'botman_id', $user_id);
    if ($user) {
      $this->say('Hello ' . $user->name);
    } else {
      $this->askFirstname();
    }

  }
}
