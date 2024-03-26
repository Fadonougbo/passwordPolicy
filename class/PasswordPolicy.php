<?php 

namespace PasswordPolicy;


class PasswordPolicy extends PasswordPolicyUtils {

    

    private int $id=0;

    private int $totalRule=0;

    private array $messages=[];

    public function __construct(private string $secret) {


    }


     /**
      * Validates the presence of zero or more symbol.
      *
      * @param integer $min
      * @param integer|null $max
      * @param string|null $message
      * @return self
      */
    public function withSymbol(int $min=0,?int $max=null,?string $message=null):self {


        $this->incrementTotalRule();

        $maxExist=$max!==null;

        $this->parameterVerification($min,$max);


        preg_match_all('/[\W_]/',$this->secret,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   

        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['symbol']=$message;

            return $this;

        }elseif($minCase||$max===1) {

            $this->messages['symbol']='the password must contain 1 special character';

        }else {
           
            $this->messages['symbol']="the password must contain  $min  to $max special characters";

        }


        return $this;

    }


     /**
      * Validates the presence of zero or more numbers .
      *
      * @param integer $min
      * @param integer|null $max
      * @param string|null $message
      * @return self
      */
    public function withNumber(int $min=0,?int $max=null,?string $message=null):self {

        $this->incrementTotalRule();

        $maxExist=$max!==null;

        $this->parameterVerification($min,$max);


        preg_match_all('/[\d]/',$this->secret,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   

        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['number']=$message;

         
        }elseif($minCase||$max===1) {

            $this->messages['number']='the password must contain 1 number';

        }else {
            
            $this->messages['number']="the password must contain  $min  to $max numbers";

        }

        return $this;


    }

   
 
     /**
      * Validates the presence of zero or more lowercase .
      *
      * @param integer $min
      * @param integer|null $max
      * @param string|null $message
      * @return self
      */
    public function withLowercase(int $min=0,?int $max=null,?string $message=null):self {

        $this->incrementTotalRule();

        $maxExist=$max!==null;

        $this->parameterVerification($min,$max);


        preg_match_all('/[a-z]/',$this->secret,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   

        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['lowercase']=$message;
            
        }elseif($minCase||$max===1) {

            $this->messages['lowercase']='the password must contain 1 lowercase';

        }else {
            
            $this->messages['lowercase']="the password must contain  $min  to $max lowercase";

        }


        return $this;

    }

    
 

     /**
      * Validates the presence of zero or more uppercase
      *
      * @param integer $min
      * @param integer|null $max
      * @param string|null $message
      * @return self
      */
    public function withUppercase(int $min=0,?int $max=null,?string $message=null):self {

        $this->incrementTotalRule();

        $maxExist=$max!==null;

        $this->parameterVerification($min,$max);


        preg_match_all('/[A-Z]/',$this->secret,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   

        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['uppercase']=$message;

        }elseif($minCase||$max===1) {

            $this->messages['uppercase']='the password must contain 1 uppercase';

        }else {
            
            $this->messages['uppercase']="the password must contain  $min  to $max lowercase";

        }

        return $this;

    }

     /**
      * 
      *Block same characters
      * @param string|null $message
      * @return self
      */
    public function blockSameCharacter(?string $message=null):self {

        
        $this->incrementTotalRule();

        $lowercaseLetter='abcdefghijklmnopqrstuvwxyz';

        $lowercaseRegex="/".PasswordPolicyUtils::getAllCharRegex($lowercaseLetter)."/";

        $uppercaseLetter=strtoupper('abcdefghijklmnopqrstuvwxyz');

        $uppercaseRegex="/".PasswordPolicyUtils::getAllCharRegex($uppercaseLetter)."/";


        $number='123456789';

        $numberRegex="/".PasswordPolicyUtils::getAllCharRegex($number)."/";


        $lowercaseValidated=preg_match_all($lowercaseRegex,$this->secret);

        $uppercaseValidated=preg_match_all($uppercaseRegex,$this->secret);

        $numberValidated=preg_match_all($numberRegex,$this->secret);

        

        if($lowercaseValidated||$uppercaseValidated||$numberValidated) {
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['same_character']=$message;

        }else {
            $this->messages['same_character']='you cannot use the same letter or number multiple times';
        }

        return $this;
    }

    /**
     * 
     *
     * @param callable|boolean $param
     * @param string|null $message
     * @return self
     */
    public function blockIf(callable|bool $param,?string $message=null):self {

        $this->incrementTotalRule();

        if(is_bool($param)) {

            if($param) {
                $this->incrementId();
            }

        }else {

            $response=call_user_func($param,$this->secret);

            if($response) {
                $this->incrementId();
            }

        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['blockReason']=$message;

        }

        return $this;

    }

     
    /**
     * Block common password
     *
     * @param string|null $message
     * @return self
     */
    public function blockCommonPasswords(?string $message=null):self {

        $this->incrementTotalRule();

        $commonPassword='/(qwerty|azerty|qwerty|abc123|12345|1234567|123456,1234567890|12345678|jesus|iloveyou|admin|qwertyuiop|aa123456)|superman|mustang|password\d*/i';

        $isValidated=preg_match_all($commonPassword,$this->secret);

        if(!$isValidated) {
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['common_password']=$message;

        }

        return $this;

    }

    /**
     * 
     *
     * @param array $list
     * @param string|null $message
     * @return self
     */
    public function blockListContent(array $list=[],?string $message=null):self {

        if(empty($list)) {
            return $this;
        }

        $this->incrementTotalRule();

        $implodeList=implode('|',$list);

        $pattern="/".$implodeList."/";


        $isValidated=preg_match_all($pattern,$this->secret,$matches);

        if(!$isValidated) {
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['contain']=$message;

        }

        return $this;
    }

    
    /**
     * Return password verification status
     *
     * @return boolean
     */
    public function getStatus():bool {
        
        return $this->getId()===$this->getTotalRule();
    }

    /**
     * Get message list
     *
     * @return array
     */
    public function getMessages():array {
        return $this->messages;
    }

    /**
     *Increment if one rule is used
     * @return void
     */
    private function incrementTotalRule() {
        $this->totalRule+=1;
    }

    /**
     * Total rull used
     *
     * @return integer
     */
    private function getTotalRule():int {
        return $this->totalRule;
    }


    /**
     * Increment if rule is valide
     *
     * @return void
     */
    private function incrementId() {
        $this->id+=1;
    }

    /**
     * Total rule validated
     *
     * @return integer
     */
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

        $totalRule=$this->getTotalRule();
        $valideRule=$this->getId();
        $status=$this->getStatus();
        $secret=$this->getSecret();
        $messages=$this->getMessages();

        return (new DataBag($totalRule,$valideRule,$status,$secret,$messages));

    }


 }

 


?>