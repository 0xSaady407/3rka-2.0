<?php
    function cleanInput($input){
        $input = trim($input);
        $input = strip_tags($input);
        $input = stripslashes($input);
        return $input;
    } 
    
?>
