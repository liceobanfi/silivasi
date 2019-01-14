<?php

/**
 * api endpoint for the registrazione.php front end
 *
 * this page receives a GET requests from the registrazione.php front end
 * when the user subscribes or cancel the subscription to a day.
 *
 * parameters received:
 * action string - can be either "add" or "remove"
 * giorno string - the day the user wants to subscribe to
 * orario string - the hour the user wants to subscrbe to
 */
$config = require 'config/config.php';
$days = require 'config/days-config.php';
require_once 'classes/connectDb.php';
require_once 'classes/SessionManager.php';

//initialize session, and die if the user is not in session
$session = new SessionManager();
if(!$session->isValid())
{
  header("HTTP/1.0 400 invalid session");
  die();
}

//validates received output, and die if something fails
$error = 0;
$error += !(isset($_POST['action']) && ($_POST['action'] === "add" || $_POST['action'] === "delete"));
$error += !(isset($_POST['giorno']) && strlen($_POST['giorno']) < 50 );
$error += !(isset($_POST['orario']) && strlen($_POST['orario']) < 50 );
if($error !== 0)
{
  header("HTTP/1.0 400 invalid data");
  die();
}

//check that the selected days actually exist
$giorno = htmlspecialchars($_POST['giorno']);
$orario = htmlspecialchars($_POST['orario']);
if (!(array_key_exists($giorno, $days) && array_key_exists($orario, $days[$giorno])) )
{
  header("HTTP/1.0 400 invalid selection");
  die();
}

//initialize the db connection, and add or remove the subscription
$instance = ConnectDb::getInstance();
$pdo = $instance->getConnection();

$action = $_POST['action'];
$info = "--";

if($action === "add")
{
  $stmt = $pdo->prepare(
    'insert  into
    `iscrizione`(`giorno`,`orario`,`scuola`,`citta`,`docente`,`mail`,`telefono`,`info`) values 
    (:giorno, :orario, :scuola, :citta, :docente, :mail, :telefono, :info) '
  );
  $stmt->execute( [
  'scuola' => $_SESSION['scuola'],
  'giorno' => $giorno,
  'orario' => $orario,
  'citta' => $_SESSION['citta'],
  'docente' => $_SESSION['docente'],
  'mail' => $_SESSION['mail'],
  'telefono' => $_SESSION['telefono'],
  'info' => $info
  ]);

  $affectedRows = $stmt->rowCount();
  echo $affectedRows;
}else
{
  $stmt = $pdo->prepare(
    'delete from `iscrizione`
    where giorno = :giorno and orario = :orario and mail = :mail'
  );
  $stmt->execute( [
  'giorno' => $giorno,
  'orario' => $orario,
  'mail' => $_SESSION['mail']
  ]);

  $affectedRows = $stmt->rowCount();
  echo $affectedRows;
}

