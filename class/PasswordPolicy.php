<?php 

namespace PasswordPolicy;


class PasswordPolicy extends PasswordPolicyUtils {

    private int $id=0;

    private array $messages=[];

    private array $ruleAlreadyUsedList=[];

    private ?int $passwordLength=null;

    public function __construct(private string $password) {


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

        
        if($this->ruleAlreadyUsed('withSymbol',$this->ruleAlreadyUsedList)) {
            return $this;
        }
        $this->ruleAlreadyUsedList[]='withSymbol';

        //Exception Generator
        $this->parameterVerification($min,$max);

        $maxExist=$max!==null;

        //Rule pattern
        preg_match_all('/[\W_]/',$this->password,$matches);

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   
        //Increment id if password valid this rule
        if($minCase||$minmaxCase) {
            $this->incrementId();
        }


        //Return if password valid this rule
        if($this->getStatus()) {
            return $this;
        }

        //Add message if password not valid this rule

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

        if($this->ruleAlreadyUsed('withNumber',$this->ruleAlreadyUsedList)) {
            return $this;
        }
        $this->ruleAlreadyUsedList[]='withNumber';


        $maxExist=$max!==null;

        //Exception generator
        $this->parameterVerification($min,$max);

        //Rule pattern
        preg_match_all('/[\d]/',$this->password,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   
        //Increment id if password valid this rule
        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        //Return if rule is validated
        if($this->getStatus()) {
            return $this;
        }

        //Add message if error
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

        if($this->ruleAlreadyUsed('withLowercase',$this->ruleAlreadyUsedList)) {
            return $this;
        }

        $this->ruleAlreadyUsedList[]='withLowercase';


        $maxExist=$max!==null;

        //Exception generator
        $this->parameterVerification($min,$max);

        //rule pattern
        preg_match_all('/[a-z]/',$this->password,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   
        //increment id if success
        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        //return if success
        if($this->getStatus()) {
            return $this;
        }


        //Add message if failure
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

        if($this->ruleAlreadyUsed('withUppercase',$this->ruleAlreadyUsedList)) {
            return $this;
        }

        $this->ruleAlreadyUsedList[]='withUppercase';


        $maxExist=$max!==null;

        //Exception generator
        $this->parameterVerification($min,$max);


        //Rule pattern
        preg_match_all('/[A-Z]/',$this->password,$matches);
        

        $symbolList=$matches[0];
       
        $minCase=!$maxExist&& count($symbolList)>=$min;
        $minmaxCase=$maxExist && count($symbolList)>=$min && count($symbolList)<=$max;
   
        //Increment id if success
        if($minCase||$minmaxCase) {
            $this->incrementId();
        }

        //Return if status is true
        if($this->getStatus()) {
            return $this;
        }


        //Add message if failure
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
    public function blockSameCharacter(int $repeat=5,?string $message=null):self {

        if($this->ruleAlreadyUsed('blockSameCharacter',$this->ruleAlreadyUsedList)) {
            return $this;
        }
        
        $this->ruleAlreadyUsedList[]='blockSameCharacter';

        //Exception Generator
        $this->passwordRepeatCharacterVerification($repeat);


        $lowercaseLetter='abcdefghijklmnopqrstuvwxyz';

        //Generate pattern for lowercase 
        $lowercaseRegex="/".PasswordPolicyUtils::getAllCharRegex($repeat,$lowercaseLetter)."/";
       

        $uppercaseLetter=strtoupper('abcdefghijklmnopqrstuvwxyz');

        //Generate pattern for uppercase 
        $uppercaseRegex="/".PasswordPolicyUtils::getAllCharRegex($repeat,$uppercaseLetter)."/";


        $number='0123456789';

        //Generate pattern for number 
        $numberRegex="/".PasswordPolicyUtils::getAllCharRegex($repeat,$number)."/";


        $lowercaseValidated=preg_match_all($lowercaseRegex,$this->password);

        $uppercaseValidated=preg_match_all($uppercaseRegex,$this->password);

        $numberValidated=preg_match_all($numberRegex,$this->password,$matches);

        //Increment id if we have note repetiton of number,lowercase,uppercase
        if(!$numberValidated&&!$uppercaseValidated&&!$lowercaseValidated) {
            
            $this->incrementId();
        }

        if($this->getStatus()) {
            return $this;
        }


        //message
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

        if($this->ruleAlreadyUsed('blockIf',$this->ruleAlreadyUsedList)) {
            return $this;
        }

        $this->ruleAlreadyUsedList[]='blockIf';


        if(is_bool($param)) {

            if($param) {
                $this->incrementId();
            }

        }else {

            $response=call_user_func($param,$this->password);

            if($response) {
                $this->incrementId();
            }

        }

        if($this->getStatus()) {
            return $this;
        }


        //message
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


        if($this->ruleAlreadyUsed('blockCommonPasswords',$this->ruleAlreadyUsedList)) {
            return $this;
        }

        $this->ruleAlreadyUsedList[]='blockCommonPasswords';

        
        //Common password list
        $commonPassword='/(qwerty|azerty|qwerty|abc123|12345|1234567|123456,1234567890|12345678|jesus|iloveyou|admin|qwertyuiop|aa123456)|superman|mustang|password\d*/i';

        $isValidated=preg_match_all($commonPassword,$this->password);

        //increment id if we have not common passwords in user password
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


        if($this->ruleAlreadyUsed('blockListContent',$this->ruleAlreadyUsedList)) {
            return $this;
        }

        $this->ruleAlreadyUsedList[]='blockListContent';

        

        if(empty($list)) {
            $this->incrementId();
            return $this;
        }


        $implodeList=implode('|',$list);

        $pattern="/".$implodeList."/";


        $isValidated=preg_match_all($pattern,$this->password);

        //increment id if we have not list passwords in user password
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

    public function setLength(int $min=4,?int $max=null,?string $message=null) {

        if($this->ruleAlreadyUsed('setLength',$this->ruleAlreadyUsedList)) {
            return $this;
        }
        

        $this->ruleAlreadyUsedList[]='setLength';

        //Exception generator
        $this->passwordLengthVerification($min,$max);

        $maxExist=$max!==null;

        $stringLength=strlen($this->password);
        
       
        $case1=!$maxExist&& $stringLength>=$min;

        $case2=$maxExist && $stringLength>=$min && $stringLength<=$max;
   

        if($case1||$case2) {
            $this->incrementId();
            $this->passwordLength=$stringLength;
        }

        if($this->getStatus()) {
            return $this;
        }


        //message
        if(!empty($message)) {

            $this->messages['string_lenght']=$message;
            
        }elseif($case1||($min===$max)) {

            $this->messages['string_lenght']="the password must contain $min characters";

        }else {
            
            $this->messages['string_lenght']="the password must contain  $min  to $max characters";

        }


        return $this;

    }

    
    /**
     * Return password verification status
     *
     * @return boolean
     */
    public function getStatus():bool {
       
        return $this->getId()===count($this->ruleAlreadyUsedList);
    }

    /**
     * Get message list
     *
     * @return array
     */
    private function getMessages():array {
        return $this->messages;
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
     * Get password length
     *
     * 
     */
    private function getPasswordLength() {
        return !empty($this->passwordLength)?$this->passwordLength:strlen($this->password);
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
    public function getPassword():string {

        return $this->password;
    }

    /**
     * Get validation result
     *
     * @return array
     */
    public function getData():DataBag {

        $totalRule=count($this->ruleAlreadyUsedList);
        $valideRule=$this->getId();
        $status=$this->getStatus();
        $secret=$this->getPassword();
        $messages=$this->getMessages();
        $lenght=$this->getPasswordLength();
        

        return (new DataBag($totalRule,$valideRule,$status,$secret,$messages,$lenght));

    }


 }

 


?>