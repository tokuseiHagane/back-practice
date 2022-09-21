<?php
//header('Content-Type: image/svg+xml');
$svg_tags = array('<?xml version="1.0" encoding="utf-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200">',
'</svg>')
$rect = array('<rect x="0" y="0" width="', 200,'" height="', 200,'" style="fill: rgb(', 0,',' 0, ',', 0, ')"/>');
$circ = array('<circle cx="100" cy="100" r="', 10,'" x="0" y="0" style="fill: rgb(', 0,',' 0, ',', 0, ')"/>');
if ($_GET['num'] == 1) {
    $figure = $rect;
} elseif ($_GET['num'] == 2) {
    $figure = $circ;
} else {
    $figure = $rect2;
}

echo $figure;
