<?php

// includes and security
include_once('../_local_auth.inc.php');

// pickup variables
$width = (int) $_REQUEST['width'];
$height = (int) $_REQUEST['height'];
$userId = $Auth->id;
if(isset($_REQUEST['userId']))
{
    $userId = (int) $_REQUEST['userId'];
}
if(($width == 0) || ($height == 0))
{
    adminFunctions::output404();
}

// block memory issues
if(($width > 500) || ($height > 500))
{
    adminFunctions::output404();
}

// setup paths
$avatarCachePath = 'user/' . (int) $userId . '/profile';
$avatarCacheFilename = MD5((int) $userId . $width . $height . 'square') . '.jpg';
$originalFilename = 'avatar_original.jpg';

// check if user has cached avatar
if($fileContent = cache::getCacheFromFile($avatarCachePath . '/' . $avatarCacheFilename))
{
    header('Content-Type: image/jpeg');
    echo $fileContent;
    exit;
}

// check for original avatar image
if(!cache::getCacheFromFile($avatarCachePath.'/'.$originalFilename))
{
    // no avatar uploaded, output default icon
    $defaultIcon = file_get_contents(SITE_IMAGE_DIRECTORY_ROOT.'/'.$originalFilename);
    header('Content-Type: image/jpeg');
    echo $defaultIcon;
    exit;
}

$avatarOriginal = CACHE_DIRECTORY_ROOT . '/' . $avatarCachePath . '/' . $originalFilename;

// resize image to square thumbnail
list($ow, $oh) = getimagesize($avatarOriginal);
switch(substr($avatarOriginal, strlen($avatarOriginal) - 3, 3))
{
    case 'png':
        $imageOriginal = imagecreatefrompng($avatarOriginal);
        break;
    case 'gif':
        $imageOriginal = imagecreatefromgif($avatarOriginal);
        break;
    default:
        $imageOriginal = imagecreatefromjpeg($avatarOriginal);
        break;
}

$imageThumb = imagecreatetruecolor($width, $height);
if($ow > $oh)
{
    $offW = ($ow - $oh) / 2;
    $offH = 0;
    $ow = $oh;
}
elseif($oh > $ow)
{
    $offW = 0;
    $offH = ($oh - $ow) / 2;
    $oh = $ow;
}
else
{
    $offW = 0;
    $offH = 0;
}

imagecopyresampled($imageThumb, $imageOriginal, 0, 0, $offW, $offH, $width, $height, $ow, $oh);

// get content as variable so we can use the caching functions
ob_start();
imagejpeg($imageThumb, null, 100);
$imageData = ob_get_contents();
ob_end_clean();

// save cache
cache::saveCacheToFile($avatarCachePath . '/' . $avatarCacheFilename, $imageData);

// output image
header('Content-Type: image/jpeg');
echo $imageData;
exit;