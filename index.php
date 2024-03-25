<?php 
require './vendor/autoload.php';

use PasswordPolicy\PasswordPolicy;

$passwordPolicy=new PasswordPolicy('Gautier');
        $result=$passwordPolicy->withUppercase(true)
                                 ->getStatus();

?>