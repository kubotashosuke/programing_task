<?php
function isValid($s) {
    $s_array = str_split($s); // オリジナル：$sを一文字ずつ配列に要素として入れる
    $close = []; // 閉じかっこを記憶する配列

    $i = 0;
    foreach ($s_array as $val) { // 配列s_arrayを要素valとして一つずつ処理する
        if ($val === '(' || $val === '{' || $val === '[') {
            $close[$i] = close($val); // valに対応する閉じかっこをclose[i]に入れる
            $i++;
        } elseif ($val === ')' || $val === '}' || $val === ']') {
            
            // もしvalと対応していない閉じかっこがきた時にfalseを返す
            // close[i-1]は、8行目のifでi++しているため、何も要素がない場所にiが存在しているので-1して配列内に入る
            // 「)))」のような閉じかっこのみがきた時用に、iが0のとき、つまり開きかっこがないときはfalseにする
            if ($i == 0 || $val !== $close[$i - 1]) {
                return false;
            }

            // valと対応した閉じかっこがきた時は順序通りなので、その前の閉じかっこと対応しているか判別するためにjを一つ下げる
            $i--;
        }
    }

    // 「(((」のような開きかっこのみがきた時用に、iが0になっていないとtrueにしない
    if ($i == 0) {
        return true;
    } else {
        return false;
    }
}

// 対応した閉じかっこを返す変数
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
