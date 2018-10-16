<?php
echo "hi";
$my_file = 'user.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = 'This is the data';
fwrite($handle, $data);
echo "hi";
?>
