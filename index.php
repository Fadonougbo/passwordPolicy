<?php 
require './vendor/autoload.php';

use PasswordPolicy\PasswordPolicy;

$data='abcdefghijklmnopqrstuvwxyz';

$splitData=preg_split('/\B/',$data);

$limit="{2,4}";

$response=array_map(function($el) use($limit) {

    return "^$el{$limit}$";

},$splitData);

$r=implode('|',$response);

dump($r);

?>