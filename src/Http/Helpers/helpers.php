<?php

use Illuminate\View\ComponentAttributeBag;


function keyToTitle($text)
{
    return ucfirst(preg_replace('/[^A-Za-z0-9 ]/', ' ', $text));
}

function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}

function attributes_to_string($attributes)
{
    if (!is_array($attributes)) {
        return '';
    }

    return implode(' ', array_map(function ($key, $value) {
        return $key . '="' . htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') . '"';
    }, array_keys($attributes), $attributes));
}

function generateId($length = 4, $characters = 'qwertyuiopasdfghjklzxcvbnm1234567890')
{
    $randomStringArray = array_map(function () use ($characters) {
        return $characters[random_int(0, strlen($characters) - 1)];
    }, range(1, $length));

    return 'a' . implode('', $randomStringArray);
}

function toPixels($value)
{
    return is_numeric($value) ? $value . 'px' : $value;
}

function array_to_string($attributes)
{
    $attributeString = '';

    foreach ($attributes as $key => $value) {
        $attributeString .= htmlspecialchars($key) . '=' . htmlspecialchars($value) . ' ';
    }

    // Удаляем пробел в конце строки
    return trim($attributeString);
}

function array_to_attributes($attributes)
{
    if(is_array($attributes)) {
        return new ComponentAttributeBag($attributes);
    }
}
