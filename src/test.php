<?php
$re = '/@[a-zA-Z0-9]+/m';
$str = 'Hello, glad to see you on my page, @podyganov. Hi, @jsmith!';

preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

// echo $matches[0][0];
// var_dump($matches);

foreach ($matches as $a) {
    $content_for_replace = $a[0];
    $content_to_replace = '<a href="">'.$b.'</a>';

    $str1 = preg_replace($re, '<a href="">'.$a[0].'</a>', $a[0]);
    $str2 = preg_replace($re, '<a href="">'.$a[0].'</a>', $a[0]);

    echo $str;
}


?>
