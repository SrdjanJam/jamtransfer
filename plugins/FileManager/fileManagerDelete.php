<?
error_reporting(E_ALL);
$file = $_GET['file'];

$path  = '../../i/website/';
$path2 = $path . 'thumbnail/';

unlink($path.$file);
unlink($path2.$file);

echo 'Deleted';
