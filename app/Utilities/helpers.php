<?php

if(!function_exists('trim_array_elements')){
    function trim_array_elements(array $array): array
    {
        foreach ($array as $index => $element){
            $array[$index] = str_replace(' ', '', $element);
        }
        return $array;
    }
}

if(!function_exists('add_single_quotes_at_array_elements')){
    function add_single_quotes_at_array_elements(array $array): array
    {
        foreach ($array as $index => $element){
            $array[$index] = "'$element'";
        }
        return $array;
    }
}

if(!function_exists('convert_array_elements_to_lowercase')){
    function convert_array_elements_to_lowercase(array $array): array
    {
        foreach ($array as $index => $element){
            $array[$index] = strtolower($element);
        }
        return $array;
    }
}
