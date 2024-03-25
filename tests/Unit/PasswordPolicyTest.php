<?php
use PasswordPolicy\PasswordPolicy;



describe('withUpper test',function() {

    test('word with one uppercase letter: normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase(false)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['Gautier','D','doE','joHn','iiD#2002']);

    test('word with one uppercase letter: error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase(false)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['GaUtier','DDe','J@oHn']);

    test('accept one or many upercase letters:normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['GaUtieR','DDe','J@oHn']);

    test('accept one or many upercase letters: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase()
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['gautier','doe','user@gmail.com']);

});



describe('withLower test',function() {

    test('word with one lowercase letters: normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase(false)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['Ga2003','q','Us394']);

    test('word with one lowercase letters: error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase(false)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doe','User09','309827']);
 
    test('accept one or many lowercase letters: normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['GautieR','Doe@002','J@oHn']);

    test('accept one or  many lowercase letters: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase()
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['GA2003','Q','US394']);

});




describe('withNumber test',function() {

    test('word with one number letter: normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber(false)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['user2','ID#)3']);

    test('word with one number : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber(false)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['User09','309827']);
 
     test('accept one or many numbers : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
     })->with(['#99','Doe@002']);

    test('accept one or  many numbers: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber()
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['john doe','Q','benin']); 

});




describe('withSymbol test',function() {

    test('word with one symbol : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(false)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['user2@','#user','id#09p']);

    test('word with one symbol : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(false)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doe@gmail.com','www.google.com','user']);
 
     test('accept one or many symbols : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
     })->with(['doe@gmail.com',':D)']);

    test('accept one or  many number: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol()
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doegmailcom','']); 

});



describe('blockSameCharactere test',function() {

     test('word with same charactere : min case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->blockSameCharactere()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['eeeeeeeeeeeeee']);

    /* test('word with same charactere : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->blockSameCharactere()
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['22222222222ss22']);
 */
   /*  test('word with same charactere : min max case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->blockSameCharactere(3,7)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['kkkk']); */

    /* test('word with same charactere : min max error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->blockSameCharactere(3,7)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['ekisj']); */

   /* test('word with one symbol : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(false)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doe@gmail.com','www.google.com','user']);
 
     test('accept one or many symbols : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
     })->with(['doe@gmail.com',':D)']);

    test('accept one or  many number: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol()
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doegmailcom','']);  */

});


   

?>


