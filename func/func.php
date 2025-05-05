<?php 
function gettitle($title){
 global $title;

 if($title){
    echo $title;
 }
 else{
    echo "Not Found";
 }
}