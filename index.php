<?php 
require './vendor/autoload.php';

use PasswordPolicy\PasswordPolicy;

$isValidated=preg_match_all('/[\W_]/','johnDoe',$matches);


$symbolList=$matches[0];

dump(empty($symbolList));


?>