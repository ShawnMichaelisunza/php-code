<?php

function get_size($size){
    $kb_size = $size / 1024;
    $format_size = number_format($kb_size, 2). 'KB';
    return $format_size;
}

echo $_FILES['picture']['size'];