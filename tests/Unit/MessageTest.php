<?php

use PasswordPolicy\PasswordPolicy;

describe('Error Message test',function() {

    test(' error message', function () {

         $message=(new PasswordPolicy('JOHNDOE2002'))->withLowercase(2)->getData()->messages;

        $message2=(new PasswordPolicy('johndoe2002'))->withLowercase(2,5)->getData()->messages;

        $message3=(new PasswordPolicy('johndoe2002'))->withLowercase(2,5,'Invalide password')->getData()->messages; 

       
         expect($message)->toBe(['withLowercase'=>'the password must contain minimum 2 lowercase letters']);

        expect($message2)->toBe(['withLowercase'=>"the password must contain 2  to 5 lowercase letters"]);

        expect($message3)->toBe(['withLowercase'=>"Invalide password"]); 

        $message3=(new PasswordPolicy('johndoe2002'))->withLowercase(2,5,'Invalide password')->withSymbol(1)->withNumber(max:0)->setLength()->getData()->messages;


       expect($message3)->toBe(
            [
                'withLowercase'=>"Invalide password",
                "symbol"=>'the password must contain minimum 1 special character',
                'withNumber'=>'the password must contain 0 number'
        ]); 

    
    });



});


?>