<?php

use PasswordPolicy\PasswordPolicy;



test('Result  test',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase()
                            ->withLowercase()
                            ->withSymbol()
                            ->withNumber()
                            ->getData();
    
        expect($result)->toBeObject()->toHaveProperties(['status','totalRule','totalValidated']);

})->with([
    'Gautier2002@'
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

                            dump($result);
    
        expect($result)->toBeObject()->toHaveProperties([
          
            'totalValidated'=>2,
           
        ]);

        
        
       

})->with([
    '11111111'
]);






?>
