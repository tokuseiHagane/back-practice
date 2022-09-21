<?php
//header('Content-Type: image/svg+xml');
$rect = '<?xml version="1.0" encoding="utf-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200">
<rect x="0" y="0" width="200" height="200" style="fill: #0000FF"/>
</svg>';
$circ = '<?xml version="1.0" encoding="utf-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="201" height="201">
<circle cx="100" cy="100" r="100" x="0" y="0" style="fill: #ff1900"/>
</svg>';
$rect2 = '<?xml version="1.0" encoding="utf-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="400" height="200">
<rect x="0" y="0" width="400" height="200" style="fill: #6d6d9e"/>
</svg>';
if ($_GET['num'] == 1) {
    $figure = $rect;
} elseif ($_GET['num'] == 2) {
    $figure = $circ;
} else {
    $figure = $rect2;
}

echo $figure;
