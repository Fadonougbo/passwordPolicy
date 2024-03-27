passwordPolicy is a library that allows defining various validation rules for passwords.

## Installation


```bash
composer require fadonougbo/password-policy
```

## Usage

Create a new instance of PasswordPolicy

```php
// Use the PHP factory to generate a PHP regexp

use PasswordPolicy\PasswordPolicy;

$policy=new PasswordPolicy('paswword');

```

Now add rule

```php
// Use the PHP factory to generate a PHP regexp

use PasswordPolicy\PasswordPolicy;

$policy=(new PasswordPolicy('pasword'))
        ->withLowercase() //  [a-z]
        ->withUppercase()  //  [A-Z]
        ->withNumber()   //  [0-9]
        ->withSymbol()// [\W_] 
        ->getStatus();  
        
```
