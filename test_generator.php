<?php

$file = './test.xml';

$xml = simplexml_load_file($file);

echo '<link href="style.css" rel="stylesheet" type="text/css">';

function process_text($text) {
	#1 вариант - уебанское регулярное выражение для удаления повторяющихся пробелов и trim, шобы не было пробелчьиков в начале и конце строки ебать
	#$text = preg_replace('|[\s]+|s', ' ', $text); #Удаляет повторяющиеся пробелы
	#$text = trim($text, " "); #Удаляет пробелы из начала и конца строки
	#2-ой вариант - разбить строку по пробелу через explode, удалить из списка повторяющиеся пробелы и склеить всё обратно через implode
	/* $text = explode(" ", $text);
	foreach ($text as $key => $item)
	{
		if ($item == "")
		{
			unset($text[$key]);
		}
	}
	$text = implode(" ", $text); */
	#3 вариант - разбить строку на токены через strtok и склеить обратно через implode, пробелов в $parts не будет вообще
	$parts = [];
	$tok = strtok($text, " ");
	while ($tok !== false) {
    	$parts[] = $tok;
    	$tok = strtok(" ");
	}
	$text = implode(" ", $text);
	$text = ucfirst($text); #Заглавный первый символ
	$text = htmlentities($text);
	$text = htmlspecialchars($text);
    $text = strip_tags($text);
	#$text = htmlspecialchars_decode($text);
	return $text;
} 

echo "<ol>";
foreach($xml->question as $question) {
	echo "<li>", process_text(($question->name));
	echo "<ol>";
	foreach($question->answer as $answer) 
		echo "<li>", process_text(($answer)), "</li>";
	echo "</ol></li>"; 
}
echo "</ol>"; 

?>
