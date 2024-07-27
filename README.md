PasswordPolicy is a library that allows defining various validation rules for passwords.

## Installation


```bash
composer require fadonougbo/password-policy
```

## Usage

#### Create a new instance of PasswordPolicy

```php

use PasswordPolicy\PasswordPolicy;

$policy=new PasswordPolicy('paswword');

```

#### Now add rule


```PHP

use PasswordPolicy\PasswordPolicy;

$status=(new PasswordPolicy('password'))
        ->withLowercase() //  [a-z]
        ->withUppercase()  //  [A-Z]
        ->withNumber()   //  [0-9]
        ->withSymbol()  // [\W_] 
        ->getStatus();  

 var_dump($status);  
        
```
``` 
   true
```

#### The methods `withLowercase`, `withUppercase`, `withSymbol`, and `withNumber` can take a minimum or maximum value as a parameter, representing the accepted number of occurrences.

```PHP

use PasswordPolicy\PasswordPolicy;

$password=$_POST['password'];

$status=(new PasswordPolicy($password))
        ->withLowercase(2) //  minimum 2 lowercase letters
        ->withUppercase(2,3)  //  2 to 3 uppercase letters
        ->withNumber(max:1)   //  0 or 1 number
        ->withSymbol(1,1)  // 1 symbol
        ->getStatus();  

   if($status) {
      echo 'Very good';
   }else {
      echo 'error';
   }

```
| password   | validated |
|------------|-----------|
| useR@aMin0 | true      |
| sJw*Bc     | true      |
| 2002doe    | false     |

#### You can use the `getData` method to get much more information.

```PHP

use PasswordPolicy\PasswordPolicy;


$data=(new PasswordPolicy('%USERmsjah22'))
        ->withLowercase() //  0 or more lowercase letters
        ->withUppercase(4)   //  minimum 4 uppsercase letters
        ->withSymbol(max:3)  // 0 to 3 symbol
        ->getData();  

 echo $data->password;
 echo $data->status;
 echo $data->length;

```
```
   %USERmsjah22
   true
   12
```

#### Attention, if you want the complete absence of numbers in the password, you must specify it in the `withNumber` method. The same goes for lowercase letters, uppercase letters, and symbols.

```PHP

use PasswordPolicy\PasswordPolicy;

$password=$_POST['password'];

$status=(new PasswordPolicy($password))
        ->withLowercase(0,0) // 0 lowercase letter
        ->withUppercase(0,0)  //  0 uppercase letter
        ->withNumber()   //  0 or more numbers
        ->getStatus();  

```
| password | validated |
|----------|-----------|
| 2003#    | true      |
| 9093761  | true      |
| eiwWS39  | false     |
| PASSWORD | false     |
| #*@(#&   | true      |

#### The `blockSameCharacters` method invalidates the password if it contains repeated characters a certain number of times.

e.g: aaaaaa ,bbbbb ,password11111

```PHP

use PasswordPolicy\PasswordPolicy;


$data=(new PasswordPolicy('user222222'))
               ->blockSameCharacter(4) //Does not accept passwords with a repeated character 4 or more times.
               ->getData();  

   echo $data->status;

```
```
   false
```

#### If you want to block a user who uses a previous password, you can use the `blockIf` method 

```PHP
use PasswordPolicy\PasswordPolicy;

$oldPasswordHash='$2y$10$i8FPWdu/4B.GV4Cl8Hq80.9p/TjrGncCrhkQYjradFpy6o/CAJnsG';

$status=(new PasswordPolicy('newpassword'))
            ->blockIf(function($password) use($oldPasswordHash) {

                return !password_verify($password,$oldPasswordHash);

            })
            ->getStatus();

    if($status) {
        echo 'Yes, it is ok';
    }else {
        echo 'You cannot use an old password.';
    }
```


#### You can use `blockCommonPasswords` to block some of the most commonly used passwords in the world, such as azerty or 12345.

```PHP
use PasswordPolicy\PasswordPolicy;

$response=(new PasswordPolicy('iloveyou'))
               ->blockCommonPasswords("This password is too weak") 
               ->getData();  

    if($response->status) {
        echo 'Yes, it is ok';
    }else {
        echo $response->messages['blockCommonPasswords'];
    }
```

```
This password is too weak
```

NB: If you need to define a list of undesirable passwords, you can use `blockListContent`.

#### Define the size of a password with`setLength` 

```PHP
use PasswordPolicy\PasswordPolicy;

$response=(new PasswordPolicy('JohnD0e2oo2'))
               ->setLength(6) // min 6 characters
               ->getData();  
```
