<?php

require __DIR__ . '/../vendor/autoload.php';

require_once 'Config.class.php';
require_once 'DB.class.php';

use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\Answer;
use \DBApp\DB;
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

    $this->con = new DB();
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
        $con = new \DBApp\DB();

        $userValue = array(
          "id"    => NULL,
          "name"  =>  $this->firstname,
          "email" =>  $this->email,
          "botman_id" => $this->bot->getUser()->getId()
        );

        // Insert information in DB
        $con->insert('user', $userValue, TRUE);
        $this->say('Great - that is all we need, ' . $this->firstname );

      } else {
        $this->say('Attention: enter a valid email address');
        $this->askEmail();
      }

    });
  }

  /**
   * Check format email
   * @param $email
   *
   * @return bool
   */
  public function checkEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return FALSE;
    }
    return TRUE;
  }

  public function run() {
    // This will be called immediately
    $user_id = $this->bot->getUser()->getId();
    $user = $this->con->find('user', 'botman_id', $user_id);
    $this->say($user_id);
    $this->say($user);
    if ($user) {
      $this->say('Hello ' . $user->name);
      $this->askEmail();
    } else {
      $this->askFirstname();
    }

  }
}
