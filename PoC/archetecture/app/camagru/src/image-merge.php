<?php

$_FILES['base-image']['tmp_name'];
$_FILES['overlay-image']['tmp_name'];

$ims = [
    'base-image' => imagecreatefrompng($_FILES['base-image']['tmp_name']),
    'overlay-image' => imagecreatefrompng($_FILES['overlay-image']['tmp_name']),
];

$im = $ims['base-image'];
$over = $ims['overlay-image'];

imagecopymerge($im, $over,
    0, 0,
    0, 0,
    imagesx($over), imagesy($over), 50);

header('Content-Type: image/png');

imagepng($im);
// imagepng($ims['base-image']);
// imagepng($ims['overlay-image']);

?>
