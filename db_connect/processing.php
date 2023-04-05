<?php

function get_size($size){
    $kb_size = $size / 1024;
    $format_size = number_format($kb_size, 2);
    return $format_size;
}

$size = get_size($_FILES['picture']['size']);

if($size < 4.0){
    echo "Success";
}else{
    echo "File to Large";
}