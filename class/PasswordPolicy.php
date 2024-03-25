<?php 

namespace PasswordPolicy;

class PasswordPolicy {

    public function __construct(private string $secret) {

    }

    public function withSymbol(?bool $acceptMany=false) {


    }


    public function withNumber(?bool $acceptMany=false) {

    }

    public function withUppercase(?bool $acceptMany=false) {

    }

    public function withLowercase(?bool $acceptMany=false) {

    }


 }


?>