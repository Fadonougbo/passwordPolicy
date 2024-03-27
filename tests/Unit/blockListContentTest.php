<?php

use PasswordPolicy\PasswordPolicy;

test('Block common list content:empty array',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->blockListContent()->getStatus();
  
     expect($result)->toBeTrue();

})->with(['azertyuser','ILOVEYOU','password','password4985']);

test('Block common list content:  fill array',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->blockListContent(['azerty','user\d*','Gautier'])->getStatus();
  
     expect($result)->toBeFalse();

})->with(['azerty1234','user','user3948','Gautier2002@']);

?>