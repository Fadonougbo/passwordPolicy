<?php 

namespace PasswordPolicy;

class PasswordPolicy {

    private bool $status=false;

    private int $id=0;

    private int $totalRull=0;

    private array $matches=[];

    private array $messages=[];

    public function __construct(private string $secret) {


    }

    /**
     * Validates the presence of one or more symbol.
     * 
     * 
     *
     * @param boolean $acceptMany
     * @return self
     */
    public function withSymbol(int $min=0,?int $max=null,?string $message=null):self {


        //Gere les exeption pour le cas ou min

        
        $this->incrementTotalRull();

        $maxExist=$max!==null;

        if($min<0) {
            return $this;
            //Gere les exeption pour le cas ou min
        }

        if($maxExist && ($max<$min||$max<0)) {
            return $this;
            //Gere les exeption pour le cas ou min
        }


        preg_match_all('/[\W_]/',$this->secret,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   

        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        if($minCase) {

            $this->messages['symbol']='the password must contain 1 special character';

        }else {
            $s=$maxExist&&$max>1?'s':'';
            $this->messages['symbol']="the password must contain  $min  to $max special character$s";

        }


        return $this;

    }

    
    /**
     * Validates the presence of one or more number letters.
     *
     * @param boolean $acceptMany
     * @return self
     */
    public function withNumber(int $min=0,?int $max=null,?string $message=null):self {

        $this->incrementTotalRull();

        $maxExist=$max!==null;

        if($min<0) {
            return $this;
            //Gere les exeption pour le cas ou min
        }

        if($maxExist && ($max<$min||$max<0)) {
            return $this;
            //Gere les exeption pour le cas ou min
        }


        preg_match_all('/[\d]/',$this->secret,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   

        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        if($minCase) {

            $this->messages['number']='the password must contain 1 number';

        }else {
            $s=$maxExist&&$max>1?'s':'';
            $this->messages['symbol']="the password must contain  $min  to $max number$s";

        }


        return $this;


    }

   
    /**
     * Validates the presence of one or more lowercase letters.
     *
     * @param boolean $acceptMany
     * @return self
     */
    public function withLowercase(int $min=0,?int $max=null,?string $message=null):self {

        $this->incrementTotalRull();

        $maxExist=$max!==null;

        //range ça dans une function
        if($min<0) {
            return $this;
            //Gere les exeption pour le cas ou min
        }

        if($maxExist && ($max<$min||$max<0)) {
            return $this;
            //Gere les exeption pour le cas ou min
        }


        preg_match_all('/[a-z]/',$this->secret,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   

        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        if($minCase) {

            $this->messages['lowercase']='the password must contain 1 lowercase';

        }else {
            $s=$maxExist&&$max>1?'s':'';
            $this->messages['lowercase']="the password must contain  $min  to $max lowercase$s";

        }


        return $this;

    }

    
    /**
     * 
     *Validates the presence of one or more uppercase letters.
     * @param boolean $acceptMany
     * @return self
     */
    public function withUppercase(bool $acceptMany=true):self {

        $regex=!$acceptMany?"/(^[a-z\d\W]*[A-Z]{1}[a-z\d\W]*$)+/":"/(^.*[A-Z]+.*$)+/";

        $status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();
        if($status) {
            $this->incrementId();
        }

        return $this;

    }


    public function blockSameCharactere(int $min=2,?int $max=null):self {

        $limit=empty($max)?'{'.$min.',}':'{'.$min.','.$max.'}';

        $lowercaseLetter='abcdefghijklmnopqrstuvwxyz';

        $lowercaseRegex="/".PasswordPolicyUtils::getAllCharRegex($lowercaseLetter,$limit)."/";

        $uppercaseLetter=strtoupper('abcdefghijklmnopqrstuvwxyz');

        $uppercaseRegex="/".PasswordPolicyUtils::getAllCharRegex($uppercaseLetter,$limit)."/";


        $number='123456789';

        $numberRegex="/".PasswordPolicyUtils::getAllCharRegex($number,$limit)."/";



        /* $regex="/".implode('|',$response)."/";
      
        $regex="/".implode('|',$response)."/"; */

        $lowercaseStatus=preg_match_all($lowercaseRegex,$this->secret);

        $uppercaseStatus=preg_match_all($uppercaseRegex,$this->secret);

        $numberStatus=preg_match_all($numberRegex,$this->secret);

        $this->incrementTotalRull();

        if($lowercaseStatus||$uppercaseStatus||$numberStatus) {
            $this->incrementId();
        }

        return $this;
    }

    
    /**
     * Return password verification status
     *
     * @return boolean
     */
    public function getStatus():bool {
        
        return $this->getId()===$this->getTotalRull();
    }

    public function getMatch() {
        return $this->matches;
    }

    private function incrementTotalRull() {
        $this->totalRull+=1;
    }

    private function getTotalRull():int {
        return $this->totalRull;
    }

    private function incrementId() {
        $this->id+=1;
    }

    private function getId():int {

        return  $this->id;
    }

    /**
     * Get secret 
     *
     * @return string
     */
    public function getSecret():string {

        return $this->secret;
    }

    /**
     * Get validation result
     *
     * @return array
     */
    public function getData():DataBag {

        $totalRull=$this->getTotalRull();
        $valideRull=$this->getId();
        $status=$this->getStatus();
        $secret=$this->getSecret();

        return (new DataBag($totalRull,$valideRull,$status,$secret));

    }


 }

 


?>