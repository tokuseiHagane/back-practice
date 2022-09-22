<?php
//header('Content-Type: image/svg+xml');
$svg_tags = array('<?xml version="1.0" encoding="utf-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="201" height="201">',
'',
'</svg>');
$rect = array('<rect x="0" y="0" width="', 200,'" height="', 200,'" style="fill: rgb(', 0,',', 0, ',', 0, ')"/>');
$circ = array('<circle cx="100" cy="100" r="', 10,'" x="0" y="0" style="fill: rgb(', 0,',', 0, ',', 0, ')"/>');
// 000 000 000 000 -> 128

$num = $_GET['num'];
$shape = $num & 7;
$color = ($num & 56) << 3;
$height = ($num & 448) >> 4;
$radius = ($num & 3584) >> 6;
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
if ($shape & 1){
	$width = $height;
    $rect[1] = $height;
    $rect[3] = $width;
    $rect[5] = $color;
    $rect[7] = $color / 2;
    $rect[9] = $color / 4;
    $str = implode('', $rect);
	
} elseif ($shape & 3) {
	$width = $height / 2;
    $rect[1] = $height;
    $rect[3] = $width;
    $rect[5] = $color;
    $rect[7] = $color / 2;
    $rect[9] = $color / 4;
    $str = implode('', $rect);
	
} elseif ($shape & 5) {
	$circ[1] = $radius;
    $circ[3] = $color;
    $circ[5] = $color / 2;
    $circ[7] = $color / 4;
    $str = implode('', $circ);
}

$svg_tags[1] = $str;
$figure = implode('', $svg_tags);

echo $figure;
