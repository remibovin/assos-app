<?php

define ("Busy" , 0);
define ("available" , 1);
define ("offline" , 2);
define ("Developer" , 0);
define ("Association" , 1);
require_once 'vendor/autoload.php';
require_once ('./src/managers/DeveloperManager.php');
require_once ('./src/managers/AssosManager.php');
require_once ('./src/Stack.php');

$i  = 0;
$faker = Faker\Factory::create();
$error = [];
for ($i = 0; $i < 10; $i++) {
  try {
    $developer = new Developer([
      'name' => $faker->name,
      'phone' => "06-73-90-92-26",
      'mail' => $faker->freeEmail,
      'Type' => Developer,
      'admin' => True,
      'technoUse' => $faker->words[0].';'.$faker->words[1].';'.$faker->words[2].';',
      'technoInterest' => $faker->words[0].';'.$faker->words[1].';'.$faker->words[2].';',
      'isMentor' => false,
      'isMentorInterest' => false,
      'status' => offline,
      'portfolio' => $faker->url,
      'interests' => $faker->words[0].';'.$faker->words[1].';'.$faker->words[2].';'
    ]);
    $db = new PDO('mysql:host=localhost;dbname=app_assos', 'root', 'bo81re47&*', array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      $manager = new DeveloperManager($db);
      $manager->add($developer);
    } catch (Exception $e) {

      $error[$i] = $e;
    }
  }
  $developer->setMsgError($error);
//  $error = $developer->getMsgError();
  foreach ($error as $key => $value) {
    $stack = new Stack($value);
    echo('<b style="color:red">Message:</b> '.$stack->getMsg().'<br/>');
    echo('<b style="color:red">File:</b> '.$stack->getFile().'<br/>');
    echo('<b style="color:red">Stack:</b> '.$stack->getStack().'<br/>');
    unset($stack);
  }

  // for ($i = 0; $i < 10; $i++) {
  //   try {
  //     $assos = new Assos([
  //       'name' => $faker->name,
  //       'phone' => $faker->phoneNumber,
  //       'mail' => $faker->freeEmail,
  //       'Type' => Association,
  //       'admin' => True,
  //       'status' => offline,
  //       'description' => $faker->text,
  //       'address' => $faker->address,
  //       'statusAssos' => true,
  //
  //     ]);
  //     $db = new PDO('mysql:host=localhost;dbname=app_assos', 'root', 'bo81re47&*');
  //     //$manager = new AssosManager($db);
  //     //$manager->add($assos);
  //   } catch (Exception $e) {
  //     $error[$i] = $e;
  //   }
  // }
  ?>
