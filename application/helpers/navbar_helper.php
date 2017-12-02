<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function activeCheck($pageRoute){
    if(uri_string() == $pageRoute){ 
        echo ' class="active"';             
    }
}

function activeCheckTwo($pageRouteOne, $pageRouteTwo){
    if(uri_string() == $pageRouteOne){ 
        echo 'active';             
    } else if(uri_string() == $pageRouteTwo){
        echo 'active'; 
    }
}