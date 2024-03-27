<?php 

namespace PasswordPolicy;

class DataBag {


    public function __construct(

        public int $totalRule,
        public int $totalValidated,
        public bool $status,
        public string $password,
        public array $messages,
        public int $length

    ) {

    }

}

?>