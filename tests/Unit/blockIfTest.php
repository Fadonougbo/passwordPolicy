<?php

use PasswordPolicy\PasswordPolicy;

test('password with same charactere ', function (string $oldSecret) {

    $passwordPolicy=new PasswordPolicy('Gaut2002');

    $result=$passwordPolicy->blockIf(function($secret) use($oldSecret) {
     
        return $oldSecret===$secret;
    })
                             ->getStatus();
  
     expect($result)->toBeTrue();


})->with([
    'Gaut2002'
]);


test('block if old password is used', function (string $oldPasswordHash) {

    $passwordPolicy=new PasswordPolicy('gautier2002');

    $result=$passwordPolicy->blockIf(function($newPassword) use($oldPasswordHash) {
        
        return password_verify($newPassword,$oldPasswordHash);
    })
                             ->getStatus();
  
     expect($result)->toBeTrue();


})->with([
    password_hash('gautier2002',PASSWORD_DEFAULT,['cost'=>10])
]);


test('block if old password is used: error case', function (string $oldPasswordHash) {

    $passwordPolicy=new PasswordPolicy('L0nd0n#2002');

    $result=$passwordPolicy->blockIf(function($newPassword) use($oldPasswordHash) {
        return password_verify($newPassword,$oldPasswordHash);
    })
                             ->getStatus();
  
     expect($result)->toBefalse();


})->with([
    password_hash('gautier2002',PASSWORD_DEFAULT,['cost'=>10])
]);

test('Boolean test ', function () {

    $passwordPolicy=new PasswordPolicy('L0nd0n#2002');

    $result=$passwordPolicy->blockIf(true)->getStatus();
  
     expect($result)->toBeTrue();


});