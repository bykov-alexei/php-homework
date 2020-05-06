<?php
$files = $_GET['for_delete'];
var_dump($files);
foreach ($files as $file) {
  unlink("applications/".$file);
}
?>
