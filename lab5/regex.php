<?php

$strings = "<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>";
    
    $patten_remove_html = "/<([^>]+)>/s";
    $output = preg_replace($patten_remove_html, "",$strings);
    echo $output;
?>