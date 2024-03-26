<?php 
require './vendor/autoload.php';

use PasswordPolicy\PasswordPolicy;

$passwordPolicy=new PasswordPolicy('333');
$result=$passwordPolicy->withSymbol(1,2,'okok')
->withNumber(1,2)
                                 ->getData();

dump($result);


?>