<?php

use PasswordPolicy\PasswordPolicy;



test('Result  test',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase(false)
                            ->withLowercase()
                            ->withSymbol(false)
                            ->withNumber()
                            ->getData();
    
        expect($result)->toBeObject()->toHaveProperties(['status','totalRull','totalValidated']);

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
            'totalRull'=>4,
            'totalValidated'=>4,
            'status'=>true
        ]);
        
       

})->with([
    'Gautier2002@'
]);

test('good password  test with 3 policies ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase(false)
                            ->withLowercase()
                            ->withSymbol(false)
                            ->getData();
    
        expect($result)->toBeObject()->toHaveProperties([
            'totalRull'=>3,
            'totalValidated'=>3,
            'status'=>true
        ]);
        
       

})->with([
    'Gautier@'
]);

test('bad password  test  ',function(string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->withUppercase(false)
                            ->withSymbol(false)
                            ->getData();
    
        expect($result)->toBeObject()->toHaveProperties([
            'totalRull'=>2,
            'totalValidated'=>1,
            'status'=>false
        ]);
        
       

})->with([
    'gautier@'
]);



?>
