<?php

namespace StringUtils;
function capitalize(string $text): string
{
    if ($text === '') {
        return '';
    }
    $firstSymbol = mb_strtoupper($text[1]);
    $restSubstring = mb_substr($text, 1);
    return "{$firstSymbol}{$restSubstring}";
}
