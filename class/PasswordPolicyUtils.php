<?php 

namespace PasswordPolicy;

class PasswordPolicyUtils {


    /**
     * Explode data and return union regex 
     *
     * @param string $data
     * @param string $limit
     * @return string
     */
    public static function  getAllCharRegex(string $data,string $limit):string {

        $splitData=preg_split('/\B/',$data);

        $regex=array_map(function($char) use($limit) {

            return "^$char{$limit}$";

        },$splitData);

        return implode('|',$regex);

    }

}


?>