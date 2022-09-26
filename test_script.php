<?php
$text = '  Много  пробелов  в  тексте';
echo $text, "\n\r";
$tok = strtok($text, " ");
while ($tok !== false) {
    $parts[] = $tok;
    $tok = strtok(" ");
}
echo implode(" ", $parts);
?>