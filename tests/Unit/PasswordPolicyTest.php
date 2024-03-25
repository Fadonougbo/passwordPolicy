<?php
use PasswordPolicy\PasswordPolicy;



describe('withUpper test',function() {

    

    test('word with uppercase', function () {

        $passwordPolicy=new PasswordPolicy('Gautier');

        $result=$passwordPolicy->withUppercase()
                                 ->getStatus();

        
      
        expect($result)->toBeTrue();

        $passwordPolicy=new PasswordPolicy('Gautier');
        $result=$passwordPolicy->withUppercase(true)
                                 ->getStatus();
        
        expect($result)->toBeTrue();


       /*  $passwordPolicy=new PasswordPolicy('GGautier');
        $result=$passwordPolicy->withUppercase()
                                 ->getStatus();
        
        expect($result)->toBeFalse(); */
    
    });

    test('word without uppercase ', function () {

        $passwordPolicy=new PasswordPolicy('gautier');

        $result=$passwordPolicy->withUppercase()
                                 ->getStatus();

        
        
        expect($result)->toBeFalse();
    
    });

});

?>


