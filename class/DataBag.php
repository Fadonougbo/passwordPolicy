<?php 

namespace PasswordPolicy;

class DataBag {


    public function __construct(

        public readonly int $totalRule,
        public readonly int $totalValidated,
        public readonly bool $status,
        public readonly string $password,
        public readonly array $messages,
        public readonly int $length

    ) {

    }

}

?>