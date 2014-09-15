<?php

$data = [];
$data["uniqid"] = uniqid();

// include all models
foreach (glob(ROOT."/app/models/*.php") as $filename)
{
    include $filename;
}

// standard objects we'll play with
$lfg  = new lfg;
$user = new user;

// include library files
include(ROOT.'/lib/reCaptcha.php');
require_once(ROOT.'/lib/passwordHash.php');
require_once(ROOT.'/lib/hashConversion.php');

if(isset($_SESSION['authenticated']) && ($_SESSION['authenticated'] == true)) {
  $data['authenticated'] = true;

  $data['user'] = array(
    'id'            => $_SESSION['id'],
    'joined'        => $_SESSION['joined'],
    'name'          => $_SESSION['name'],
    'gamerid'       => $_SESSION['gamerid'],
    'email'         => $_SESSION['email'],
    'avatar'        => $_SESSION['avatar'],
    'level'         => $_SESSION['level']
  );

  if($_SESSION['level'] < 100) {
    $data['admin'] = true;
  }
}

// cookie settings for stats pulling
$expire = time() + 60*60*24*3000;
setcookie("bungledid", 'B/hOijsN8hhKsJ5qQjV+gDOEcK+T9pXRCAAA', $expire, ".bungie.net");
setcookie("bungled", '7021455797140621247', 0, ".bungie.net");
setcookie("bungleatk", 'wa=xNBLs5LBo751A0f81g0N1suiZD.HLHCtzk9E4cQLQvLgAAAA-bCMeuVZVF0KQ-wk-2x6FPCs5foVf9lWflGDK5.qhg5sxnaVFsjFd-l62VKGXJ0JXkRHYxeM0kFg8awK5s9XexnyEMD-1nxsoleZl1wZYRSZMWbCyhN6mWM.Ma-Az1RJrMgtM5eb1Ln0tdUR7r--7tliBs2fZZXb.OCjpjcb4y7dPG9e-Ged5tf9N2Na96O9IlD1Cd-Dmbwe5M5INY2NsRh5prf1MaJzfMeeN3wyhDGYzAMvQFNZ7k0SH6Q372Oyc1P02V1fIUvZ-.GBwzuayYgkjdOx10RRwYPWvk3Htjo_&tk=YAAAAB6aQpi6DqAvwHtpGOl7K-gr4nhQy7vvmrcBqts-5UyZ7nxJ5Y0W9lDheDRP-Bt2g5P8M6Kb24670Woc1ezmyaJct2ZS-21urugEcaAGmB3sft1NBdt9L0pwfVVmK9QNtyAAAAA93PS-hrl2ycFsyQqDGlZ4n0oc8neczeiOMd4IS.MGgA__', 0, ".bungie.net");