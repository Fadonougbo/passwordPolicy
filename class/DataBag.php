<?php 

namespace PasswordPolicy;

class DataBag {


    public function __construct(

        public int $totalRull,
        public int $totalValidated,
        public bool $status,
        public string $secret

    ) {

    }

}

?>