<?php


use Intervention\Image\ImageManager;


$fileName = uniqid() . '-' . $_FILES["file"]["name"];
$tmpFile = $_FILES["file"]["tmp_name"];

// create an image manager instance with favored driver
$manager = new ImageManager(['driver' => 'imagick']);

// open an image file
$img = $manager->make($tmpFile);

// finally we save the image as a new file
$img->save(__DIR__ . '/img/original/' . $fileName);

// now you are able to resize the instance
// resize the image so that the largest side fits within the limit; the smaller
// side will be scaled to maintain the original aspect ratio
$img->resize(300, 300, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
});

// and insert a watermark for example
//$img->insert('public/watermark.png');

// finally we save the image as a new file
$img->save(__DIR__ . '/img/thumbnails/' . $fileName);
