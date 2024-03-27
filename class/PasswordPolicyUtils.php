<?php 

namespace PasswordPolicy;

use PasswordPolicyException\PasswordPolicyException;

abstract class PasswordPolicyUtils {


    /**
     * Explode data and return  regex for each charater 
     *
     * @param string $data
     * @return string
     */
    protected static function  getAllCharRegex(int $repeat,string $data):string {

        $splitData=preg_split('/\B/',$data);

        $regex=array_map(function($char) use($repeat) {

            $quantifier="{".$repeat.",}";

            return "^.*$char{$quantifier}.*$";

        },$splitData);

        return implode('|',$regex);

    }

    /**
     * Throw PasswordPolicyException if $min|$max value is not correct
     *
     * @param integer $min
     * @param integer|null $max
     * @return void
     */
    protected function parameterVerification(int $min,?int $max=null) {

        $maxExist=$max!==null;

         if($min<0) {
            throw new PasswordPolicyException("The min parameter value cannot be less than zero");
         }
 
         if($maxExist && ($min>$max) ) {
             
             throw new PasswordPolicyException("The max parameter value cannot be less than min value");
             
         }
 
         if($maxExist && ($max<0) ) {
             
             throw new PasswordPolicyException("The max parameter value cannot be less than zero");
             
         }

    }

    protected function passwordRepeatCharacterVerification(int $repeat) {

        if($repeat<3) {
            throw new PasswordPolicyException("The number of repetitions cannot be less than 3");
         }

    }

    
    /**
     * Throw PasswordPolicyException if password is not correct
     *
     * @param integer $min
     * @param integer|null $max
     *
     */
    protected function passwordLengthVerification(int $min,?int $max=null) {

        $maxExist=$max!==null;

         if($min<4) {
            throw new PasswordPolicyException("The password cannot be less than 4 characteres");
         }
 
         if($maxExist && ($min>$max) ) {
             
             throw new PasswordPolicyException("The max parameter value cannot be less than min value");
             
         }
 
         if($maxExist && ($max<4) ) {
             
             throw new PasswordPolicyException("The password cannot be less than 4 characteres");
             
         }

    }

    public function ruleAlreadyUsed(string $name,array $arr):bool {

        return in_array($name,$arr);

    }


}


?>