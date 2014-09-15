<?php

// recaptcha
$data['recaptcha'] = recaptcha_get_html('6LfgtPkSAAAAADDDOsXG2mFZA5b4Az0k-u5nft34');

$data["home"] = true;

//
// NEWS FEED FROM BUNGIE
//
$feed = implode(file('https://www.bungie.net/en/Rss/NewsByCategory?category=destiny&currentpage=1&itemsPerPage=10'));
$xml = simplexml_load_string($feed);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

$data['feed'] = [];
foreach($array['channel']['item'] as $item) {
  array_push($data['feed'], $item);
}

//
// GUARDIANS DATA
//
$data['guardians'] = [];
$data['guardianCount'] = R::count("users", " banned = 0 AND enabled = 1");

$guardians = R::find("users", " banned = 0 AND enabled = 1 ORDER BY id DESC LIMIT 5");

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
    $char['characterBase']['toNextLevel'] = $char['percentToNextLevel'];
    $char['characterBase']['emblem']      = 'http://www.bungie.net'.$char['emblemPath'];

    array_push($data['guardians'], $char['characterBase']);
  }
}

//
// LFG DATA
//
$data['LFGs'] = [];
$lfg = R::find('lfg', 'enabled = 1 ORDER BY created DESC');
foreach($lfg as $l) {
  $l['created'] = lib\fuzzyDate::date($l['created']);
  switch($l['platform']) {
    case 'Xbox 360':
      $l['platform'] = '<img src="/assets/img/icons/360.png" rel="tooltip" title="Xbox 360">';
    break;
    case 'Xbox One':
      $l['platform'] = '<img src="/assets/img/icons/xbone.png" rel="tooltip" title="Xbox One">';
    break;
    case 'PS3':
      $l['platform'] = '<img src="/assets/img/icons/ps3.png" rel="tooltip" title="Playstation 3">';
    break;
    default:
      $l['platform'] = '<img src="/assets/img/icons/ps4.png" rel="tooltip" title="Playstation 4">';
    break;
  }
  array_push($data['LFGs'], $l);
}

echo $m->render('public/index', $data);

?>