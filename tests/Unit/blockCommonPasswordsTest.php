<?php

use PasswordPolicy\PasswordPolicy;

test('Block common password test',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->blockCommonPasswords()->getStatus();
  
     expect($result)->toBeFalse();

})->with(['azertyuser','ILOVEYOU','password','password4985']);

test('Block common password test:error case',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->blockCommonPasswords()->getStatus();
  
     expect($result)->toBeTrue();

})->with(['Gautier2002$','super@dmin','(john)2002']);

?>