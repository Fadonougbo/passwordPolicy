<?php 

namespace PasswordPolicy;

class PasswordPolicy {

    private bool $status=false;

    public function __construct(private string $secret) {



    }

    public function withSymbol(?bool $acceptMany=false) {


    }


    public function withNumber(?bool $acceptMany=false) {

    }

    public function withLowercase(?bool $acceptMany=false) {

    }

    public function withUppercase(?bool $acceptMany=false) {

        $regex=$acceptMany?"/(.*[A-Z]+.+)+|(^[A-Z]+.+)+|(.*[A-Z]+$)+/":"/(.*[A-Z]{1}.+)+|(^[A-Z]{1}.+)+|(.*[A-Z]{1}$)+/";

        $this->status=preg_match_all($regex,$this->secret,$maches);

        dump($maches);

        return $this;

    }

    
    public function getStatus():bool {

        return $this->status;
    }


 }


?>