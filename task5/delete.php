<?php
$files = $_GET['for_delete'];
foreach ($files as $file) {
  unlink("applications/".$file);
}
echo "Заявки успешно удалены";
?>
