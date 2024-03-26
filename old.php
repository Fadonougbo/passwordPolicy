 <?php 
 //Symbol
 $this->incrementTotalRull();

        $maxExist=!empty($max);
        $minExist=!empty($min);
       
        $regex=!$maxExist&&!$minExist?"/(^[a-zA-Z0-9]*[\W_]{1}[a-zA-Z0-9]*$)+/":"/(^.*[\W_]+.*$)+/";

        $isValidated=preg_match_all($regex,$this->secret);

        if(!$isValidated) {
            return $this;
        }

        if(($isValidated&&!$maxExist&&!$minExist)) {
            $this->incrementId();
            return $this;
        }

        $symbolFound=preg_match_all('/[\W_]/',$this->secret,$matches);

        if(!$symbolFound) {
            return $this;
        }

        $symbolList=$matches[0];

      

        if(count($symbolList)>=$min && count($symbolList)<=$max ) {
            $this->incrementId();
        }

        return $this;

//Number

$regex=!$acceptMany?"/(^[\D\W]*[\d]{1}[\D\W]*$)+/":"/(^.*[\d]+.*$)+/";


        $status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();
        if($status) {
            $this->incrementId();
        }

        return $this;
//lowercase

$regex=!$acceptMany?"/(^[A-Z\d\W]*[a-z]{1}[A-Z\d\W]*$)+/":"/(^.*[a-z]+.*$)+/";

        $status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();
        if($status) {
            $this->incrementId();
        }

        return $this;