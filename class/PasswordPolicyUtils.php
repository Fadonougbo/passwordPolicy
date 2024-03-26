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
    protected static function  getAllCharRegex(string $data):string {

        $splitData=preg_split('/\B/',$data);

        $regex=array_map(function($char) {

            return "^$char{2,}$";

        },$splitData);

        return implode('|',$regex);

    }

    public function parameterVerification(int $min,?int $max=null) {

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

}


?>