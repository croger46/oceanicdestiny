<?php

// guardians.php
$data['index'] = true;
$data['guardians'] = [];
$data['guardianCount'] = R::count("users", " banned = 0 AND enabled = 1");

$guardians = R::find("users", " banned = 0 AND enabled = 1 ORDER BY gamerid ASC");

foreach($guardians as $g) {
  // find characters
  $uuid  = $user->getMembershipID($g['gamerid'], $g['platform']);
  $gData = $user->getAccountDetails($uuid, $g['platform']);

  foreach($gData['Response']['data']['characters'] as $char) {

    if($char['baseCharacterLevel'] == 20) {
      $char['characterBase']['bonus'] = $char['characterLevel'] - $char['baseCharacterLevel'];
    }

    $char['characterBase']['owner']       = $g['gamerid'];
    $char['characterBase']['class']       = lib\classHash::toText($char['characterBase']['classHash']);
    $char['characterBase']['level']       = $char['baseCharacterLevel'];
    $char['characterBase']['toNextLevel'] = number_format($char['percentToNextLevel'], 2);
    $char['characterBase']['emblem']      = 'http://www.bungie.net'.$char['emblemPath'];

    array_push($data['guardians'], $char['characterBase']);
  }
}

echo $m->render('public/guardians', $data);

