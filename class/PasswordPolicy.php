<?php 

namespace PasswordPolicy;


class PasswordPolicy extends PasswordPolicyUtils {

    private int $id=0;

    private array $messages=[];

    private array $ruleAlreadyUsedList=[];

    private array $ruleValidated=[];

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

        
        if(in_array('withSymbol',$this->ruleAlreadyUsedList)) {
            return $this;
        }
        
        $this->ruleAlreadyUsedList[]='withSymbol';

        //Exception Generator
        $this->parameterVerification($min,$max);


        $response=WithMethodValidator::check([
            'min'=>$min,
            'max'=>$max,
            'pattern'=>"/[\W_]/",
            'password'=>$this->password
        ]);

       
        //Increment id if password valid this rule
        if($response['isValidated']) {
            $this->incrementId();
            $this->ruleValidated[]='withSymbol';
        }


        //Return if password valid this rule
        if(in_array('withSymbol',$this->ruleValidated)) {
            return $this;
        }

        //Add message if password not valid this rule
        $errorMessage=WithMethodValidator::getErrorMessage($message,[
            'max'=>$max,
            'min'=>$min,
            'm'=>$min>1?'special characters':'special character',
            'matchCount'=>$response['matchCount']
        ]);

        
        if(!empty($errorMessage)) {
            $this->messages['symbol']=$errorMessage;
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

        //Exception generator
        $this->parameterVerification($min,$max);


        $response=WithMethodValidator::check([
            'min'=>$min,
            'max'=>$max,
            'pattern'=>'/[\d]/',
            'password'=>$this->password
        ]);
   
        //Increment id if password valid this rule
        if($response['isValidated']) {
            $this->incrementId();
            $this->ruleValidated[]='withNumber';
        }

        //Return if rule is validated
        if(in_array('withNumber',$this->ruleValidated)) {
            return $this;
        }

        //Add message if password not valid this rule
        $errorMessage=WithMethodValidator::getErrorMessage($message,[
            'max'=>$max,
            'min'=>$min,
            'm'=>$min>1?'numbers':'number',
            'matchCount'=>$response['matchCount']
        ]);

        
        if(!empty($errorMessage)) {
            $this->messages['withNumber']=$errorMessage;
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
     

        //Exception generator
        $this->parameterVerification($min,$max);
        

        $response=WithMethodValidator::check([
            'min'=>$min,
            'max'=>$max,
            'pattern'=>'/[a-z]/',
            'password'=>$this->password
        ]);

        //increment id if success
        if($response['isValidated']) {
            $this->incrementId();
            $this->ruleValidated[]='withLowercase';
        }

        //return if success
        
        if(in_array('withLowercase',$this->ruleValidated)) {
            return $this;
        }


       //Add message if password not valid this rule
       $errorMessage=WithMethodValidator::getErrorMessage($message,[
            'max'=>$max,
            'min'=>$min,
            'm'=>$min>1?'lowercase letters':'lowercase letter',
            'matchCount'=>$response['matchCount']
        ]);

        
        if(!empty($errorMessage)) {
            $this->messages['withLowercase']=$errorMessage;
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

        //Exception generator
        $this->parameterVerification($min,$max);

        $response=WithMethodValidator::check([
            'min'=>$min,
            'max'=>$max,
            'pattern'=>'/[A-Z]/',
            'password'=>$this->password
        ]);
   
        //Increment id if success
        if($response['isValidated']) {
            $this->incrementId();
            $this->ruleValidated[]='withUppercase';
        }

        //Return if status is true
        if(in_array('withUppercase',$this->ruleValidated)) {
            return $this;
        }


        //Add message if password not valid this rule
       $errorMessage=WithMethodValidator::getErrorMessage($message,[
            'max'=>$max,
            'min'=>$min,
            'm'=>$min>1?'uppercase letters':'uppercase letter',
            'matchCount'=>$response['matchCount']
        ]);

        
        if(!empty($errorMessage)) {
            $this->messages['withUppercase']=$errorMessage;
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
        $lowercaseRegex="/".$this->getAllCharRegex($repeat,$lowercaseLetter)."/";
       

        $uppercaseLetter=strtoupper('abcdefghijklmnopqrstuvwxyz');

        //Generate pattern for uppercase 
        $uppercaseRegex="/".$this->getAllCharRegex($repeat,$uppercaseLetter)."/";


        $number='0123456789';

        //Generate pattern for number 
        $numberRegex="/".$this->getAllCharRegex($repeat,$number)."/";

        //$symbol="`~!@#$%^&*()_+=-][{}\|';\",.></?";

        $lowercaseValidated=preg_match_all($lowercaseRegex,$this->password);

        $uppercaseValidated=preg_match_all($uppercaseRegex,$this->password);

        $numberValidated=preg_match_all($numberRegex,$this->password,$matches);

        //Increment id if we have note repetiton of number,lowercase,uppercase
        if(!$numberValidated&&!$uppercaseValidated&&!$lowercaseValidated) {
            
            $this->incrementId();
            $this->ruleValidated[]='blockSameCharacter';
        }

        if(in_array('blockSameCharacter',$this->ruleValidated)) {
            return $this;
        }


        //message
        if(!empty($message)) {

            $this->messages['same_character']=$message;
            return $this;

        }

        $this->messages['same_character']="you cannot use the same letter or number more than {$repeat} times";
        

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
                $this->ruleValidated[]='blockIf';
            }

        }else {

            $response=call_user_func($param,$this->password);

            if($response) {
                $this->incrementId();
                $this->ruleValidated[]='blockIf';
            }

        }

        if(in_array('blockIf',$this->ruleValidated)) {
            return $this;
        }


        //message
        if(!empty($message)) {

            $this->messages['block_reason']=$message;

            return $this;

        }
            
        $this->messages['block_reason']="Password not accepted";


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
            $this->ruleValidated[]='blockCommonPasswords';
        }

        if(in_array('blockCommonPasswords',$this->ruleValidated)) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['common_password']=$message;
            return $this;
        }
            
        $this->messages['common_password']="The password used is easy";
        

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
            $this->ruleValidated[]='blockListContent';
            return $this;
        }


        $implodeList=implode('|',$list);

        $pattern="/".$implodeList."/";


        $isValidated=preg_match_all($pattern,$this->password);

        //increment id if we have not list passwords in user password
        if(!$isValidated) {
            $this->incrementId();
            $this->ruleValidated[]='blockListContent';
            
        }

        if(in_array('blockListContent',$this->ruleValidated)) {
            return $this;
        }

        if(!empty($message)) {

            $this->messages['block_list_content']=$message;

        }else {
            $implodeList=implode(';',$list);

            if(count($list)>1) {
                $this->messages['block_list_content']="The following words are not accepted in the password: {$implodeList}";
            }else {
                $this->messages['block_list_content']="The following word is not accepted in the password: {$implodeList}";
            }
            
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

        $stringLength=mb_strlen($this->password);
        
       
        $case1=!$maxExist&& $stringLength>=$min;

        $case2=$maxExist && $stringLength>=$min && $stringLength<=$max;
   
        if($case1||$case2) {
            $this->incrementId();
            $this->ruleValidated[]='setLength';
            $this->passwordLength=$stringLength;
        }

        if(in_array('setLength',$this->ruleValidated)) {
            return $this;
        }


        //message
  

        $message=match(true) {
            !empty($message)=>$message,

            ($stringLength>$max&&$maxExist)=>"the password must contain  $min to $max  characters",

            ($stringLength===$min&&$min===$max)=>"the password must contain  $min characters",

            ($stringLength<$min&&!$maxExist)=>"the password must contain minimum $min characters",

            ($stringLength<$min&&$maxExist)=>"the password must contain  $min to $max characters",

            default=>'error'
        };


        if($message) {
            $this->messages['string_length']=$message;
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
        return !empty($this->passwordLength)?$this->passwordLength:mb_strlen($this->password);
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
        $password=$this->getPassword();
        $messages=$this->getMessages();
        $lenght=$this->getPasswordLength();
        
        return (new DataBag($totalRule,$valideRule,$status,$password,$messages,$lenght));

    }

 }


?>