<?php

function redirect($url1)
{
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url .= $url1;
    header('Location: ' . $url);
}

?>