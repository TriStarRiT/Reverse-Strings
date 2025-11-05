<?php
if (isset($_POST['text'])) {
    $input = $_POST['text'];
    $result = execute(strval($input));
    echo "<p>Результат: <strong>" . htmlentities($result) . "</strong></p>";
}

function execute(string $string): string
{
    $return_string = [];
    $parts = preg_split(splitPattern(), $string, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    foreach ($parts as $part) {
        $return_string[] = preg_match('/^\p{L}+$/u', $part) ? wordReverse($part) : $part;
    }
    return implode($return_string);
}

function splitPattern(): string
{
    return '/(\p{L}+)|(\p{N}+)|(\s+)|(.)/ux';
}

function wordReverse(string $word): string
{
    $letters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
    $new_word_letters = array_reverse($letters);
    foreach($letters as $k => $letter) {
        $is_uppercase = (mb_strtoupper($letter, 'UTF-8') === $letter && mb_strtolower($letter, 'UTF-8') !== $letter);
        $new_letter = $new_word_letters[$k];
        $new_word_letters[$k] = $is_uppercase 
            ? mb_strtoupper($new_letter, 'UTF-8') 
            : mb_strtolower($new_letter, 'UTF-8');
    }
    return implode($new_word_letters);
}
?>

<form method="post">
    <label>Введите текст:</label>
    <input type="text" name="text" style="width:300px;">
    <button type="submit">Отправить</button>
</form>
