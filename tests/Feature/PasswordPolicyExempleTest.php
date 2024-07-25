<?php

use PasswordPolicy\PasswordPolicy;



test('Result  test',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase()
                            ->withLowercase()
                            ->withSymbol()
                            ->withNumber()
                            ->setLength()
                            ->getData();

                           
    
        expect($result)->toBeObject()->toHaveProperties(['status','totalRule','totalValidated']);

})->with([
    'Ga'
]);

test('good password  test',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase(false)
                            ->withLowercase()
                            ->withSymbol(false)
                            ->withNumber()
                            ->getData();
    
        expect($result)->toBeObject()->toHaveProperties([
            
            'totalValidated'=>4,
            'status'=>true,
            'totalRule'=>4,
            'length'=>12

        ]);
        
       

})->with([
    'Gautier2002@'
]);

test('good password  test with 3 policies ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase()
                            ->withLowercase()
                            ->withSymbol()
                            ->getData();
    
        expect($result)->toBeObject()->toHaveProperties([
            'totalRule'=>3,
            'totalValidated'=>3,
            'status'=>true
        ]);
        
       

})->with([
    'Gautier@'
]);

test('bad password  test  ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase()
                            ->withSymbol()
                            ->getData();
    
        expect($result)->toBeObject()->toHaveProperties([
            'totalRule'=>2,
            'totalValidated'=>2,
            'status'=>true
        ]);
        
       

})->with([
    'gautier@'
]);

test('Block same caracter  test  ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withNumber()
                            ->withLowercase()
                            ->blockSameCharacter()
                            ->getData();

                            
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>2,
            'totalRule'=>3,
            'status'=>false 
           
        ]);


})->with([
    '11111111','userrrrr'
]);


test('password  test1  ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withNumber(1)
                            ->withLowercase(1)
                            ->blockSameCharacter()
                            ->getData();

                            
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>1,
            'totalRule'=>3,
            'status'=>false
           
        ]);


})->with([
    '$$$$$$','*******'
]);

test('password  test2  ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withNumber(1)
                            ->withLowercase(4)
                            ->withUppercase(1)
                            ->blockCommonPasswords()
                            ->blockListContent(['john','doe'])
                            ->blockIf(true)
                            ->blockSameCharacter()
                            ->setLength(max:8)
                            ->getData();

                            //dump($result);
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>8,
            'totalRule'=>8,
            'status'=>true
           
        ]);


})->with([
    'p2K2ejl$','dK9#jhp9'
]);


test('password  test 3  ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withNumber()
                            ->withLowercase()
                            ->withUppercase()
                            ->withSymbol()
                            ->setLength(4,50)
                            ->getData();

                            //dump($result);
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>5,
            'totalRule'=>5,
            'status'=>true
           
        ]);


})->with([
    '3}l~BN2E%MnO#hg39]:8','2S\£t2\T3znq*>:vHrxs',"8I9`]1/o$1ycD9E,~~4"
]);


test('test for readme',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withNumber(max:1)
                            ->withLowercase(2)
                            ->withUppercase(2,3)
                            ->withSymbol(1,1)
                            ->getData();

                            
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>4,
            'totalRule'=>4,
            'status'=>true
           
        ]);

})->with(['useR@aMin0','sJw*Bc']);


test('test for readme 2',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy
                            ->withLowercase()
                            ->withUppercase(4)
                            ->withSymbol(max:3)
                            ->getData();

                            //dump($result);
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>3,
            'totalRule'=>3,
            'status'=>true
           
        ]);

})->with(['%USERmsjah22']);


test('test for readme 3',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy
                            ->withLowercase(0,0)
                            ->withUppercase(0,0)
                            ->withNumber()
                            ->getData();

                           
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>3,
            'totalRule'=>3,
            'status'=>true
           
        ]);

})->with(['2003#','9093761','#*@(#&']);


test('test for readme 4',function($secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->blockSameCharacter(4)
                            ->getData();

                            //dump(password_hash('ok',PASSWORD_DEFAULT));
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>1,
            'totalRule'=>1,
            'status'=>true
           
        ]);

})->with(['']);

test('test for readme 5',function($secret) {

    $oldPasswordHash='$2y$10$i8FPWdu/4B.GV4Cl8Hq80.9p/TjrGncCrhkQYjradFpy6o/CAJnsG';

    $result=(new PasswordPolicy($secret))

            ->blockIf(function($password) use($oldPasswordHash) {

                return !password_verify($password,$oldPasswordHash);

            },'Vous ne pouvez pas utiliser un ancien mot de passe')
            ->getStatus();

    
        expect($result)->toBeFalse(true);

})->with(['ok']);






?>
