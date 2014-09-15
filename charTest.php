<?php

// chromatoss
echo "\n\n\n";
echo "= CHROMATOS = \n";
$bData = file_get_contents('http://www.bungie.net/platform/Destiny/2/Account/4611686018433106159/');
$bArray = json_decode($bData, true);
print_r($bArray);

// fish_in_a_wig
echo "\n\n\n";
echo "= FISH_IN_A_WIG = \n";
$bData = file_get_contents('http://www.bungie.net/platform/Destiny/2/Account/4611686018428752359/');
$bArray = json_decode($bData, true);
print_r($bArray);

// jaytwitch
echo "\n\n\n";
echo "= JAYTWITCH = \n";
$bData = file_get_contents('http://www.bungie.net/platform/Destiny/2/Account/4611686018433058403/');
$bArray = json_decode($bData, true);
print_r($bArray);