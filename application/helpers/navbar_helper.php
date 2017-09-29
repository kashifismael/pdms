<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function activeCheck($pageRoute){
    if(uri_string() == $pageRoute){ 
        echo ' class="active"';             
    }
}