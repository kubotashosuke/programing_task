<?php
function isValid($s) {
    $s_array = str_split($s);
    $close = [];

    $i = 0;
    foreach ($s_array as $val) {
        if ($val === '(' || $val === '{' || $val === '[') {
            $close[$i] = close($val);
            $i++;
        } elseif ($val === ')' || $val === '}' || $val === ']') {
            if ($i == 0 || $val !== $close[$i - 1]) {
                return false;
            }
            $i--;
        }
    }

    if ($i == 0) {
        return true;
    } else {
        return false;
    }
}

function close($open) {
    if ($open === '(') {
        return ')';
    } elseif ($open === '{') {
        return '}';
    } elseif ($open === '[') {
        return ']';
    } else {
        return null;
    }
}

// 実行例
$s = '()';
var_dump(isValid($s)); // true

$s = '({)}';
var_dump(isValid($s)); // false

?>
