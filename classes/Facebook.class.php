<?php
require __DIR__ . '/../vendor/autoload.php';

use Mpociot\BotMan\Conversation;
use Mpociot\BotMan\Answer;
use DBApp\DB;
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

  public function __construct() {
    $con = new DB();
    $db = $con::getInstance();
    $db->getConnection();
    $this->db = $db;
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

      $this->say('Great - that is all we need, '.$this->firstname);

      $userValue = array(
        "name"  =>  $this->firstname,
        "email" =>  $this->email,
      );

      $this->db->insert('user', $userValue, FALSE);
    });
  }

  public function run() {
    // This will be called immediately
    $this->askFirstname();
  }
}
