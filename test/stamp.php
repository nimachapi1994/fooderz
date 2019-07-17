<?php
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 8/28/18
 * Time: 6:36 PM
 */
$stamp = imagecreatefrompng('asdf.png');
$im = imagecreatefromjpeg('mbp15touch-silver-gallery4-201610 (copy).jpeg');

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo
// width to calculate positioning of the stamp.
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Output and free memory
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);