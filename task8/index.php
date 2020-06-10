<style>
  img {
    width: 50px;
  }
</style>

<?php
$text = "hello   how\t\t are you  ? ";

function clear($text) {
  return preg_replace('/\s+/', ' ', $text);
}

echo clear($text);
?>
