<?php

use PasswordPolicy\PasswordPolicy;

test('password length test', function (string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->setLength()
                             ->getStatus();
  
     expect($result)->toBeTrue();


})->with(['eeee','3333','super@adm1n']);

test('password length test:min max case', function (string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->setLength(max:6)
                             ->getStatus();
  
     expect($result)->toBeFalse();


})->with(['2987310','gautier2002']);

test('password length test:fixe length error case', function (string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->setLength(5,5)
                             ->getStatus();
  
     expect($result)->toBeFalse();


})->with(['2987310','gautier2002','']);

test('password length test:fixe length case', function (string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->setLength(5,5)
    ->setLength(5,5)
                             ->getStatus();
  
     expect($result)->toBeTrue();


})->with(['d(821','hsy7@']);


?>