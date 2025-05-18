<?php
$article ="montre";
$prix =15;
$devise = ' $ ';

$articles_names = [
    "Bracelet",
    "Montre",
    "Cable usb",
    "Ecouteur",
    "Carnets",
];

$articles_prix = [
    "Bracelet" => 5000,
    "Montre" => 13000,
    "Cable usb" =>7500,
    "Ecouteur" =>25000,
    "Carnets" =>2500,
];

$total =0;
foreach($articles_prix as $p){
    $total += $p;
}
