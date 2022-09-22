<?php
//header('Content-Type: image/svg+xml');
$svg_tags = array('<?xml version="1.0" encoding="utf-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="201" height="201">',
null,
'</svg>');
$rect = array('<rect x="0" y="0" width="', 200,'" height="', 200,'" style="fill: rgb(', 0,',', 0, ',', 0, ')"/>');
$circ = array('<circle cx="100" cy="100" r="', 10,'" x="0" y="0" style="fill: rgb(', 0,',', 0, ',', 0, ')"/>');
// 000 000 000 000 -> 8191

$num = $_GET['num'];
$color = ($num & 56) << 3;
$height = ($num & 448) >> 3;
$radius = ($num & 3584) >> 5;
if ($radius > 50){
	$radius = 50;
} elseif ($radius < 0) {
	$radius = 10;
}
if ($color > 255){
	$color = 255;
} elseif ($color < 0) {
	$color = 0;
}
if ($height > 200){
	$height = 200;
} elseif ($height < 0) {
	$height = 10;
}
$shape = $num & 7;
if ($shape == 2){
	$width = $height;
    $rect[1] = $height;
    $rect[3] = $width;
    $rect[5] = $color;
    $rect[7] = $color / 2;
    $rect[9] = $color / 4;
    $str = implode('', $rect);	
} elseif ($shape == 5) {
	$width = $height / 2;
    $rect[1] = $height;
    $rect[3] = $width;
    $rect[5] = $color;
    $rect[7] = $color / 2;
    $rect[9] = $color / 4;
    $str = implode('', $rect);
} elseif ($shape == 7) {
	$circ[1] = $radius;
    $circ[3] = $color;
    $circ[5] = $color / 2;
    $circ[7] = $color / 4;
    $str = implode('', $circ);
} else {
    $width = $height;
    $rect[1] = $height;
    $rect[3] = $width;
    $rect[5] = $color;
    $rect[7] = $color / 2;
    $rect[9] = $color / 4;
    $str = implode('', $rect);
}

$svg_tags[1] = $str;
$figure = implode('', $svg_tags);

echo $figure;
