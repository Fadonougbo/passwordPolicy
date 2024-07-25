<?php 

namespace PasswordPolicy;

class WithMethodValidator {

    /**
     * Pattern verification
     * @param array $data
     * @return array
     */
    public static function check(array $data) {

        $maxExist=!is_null($data['max']);

        //Rule pattern
        preg_match_all($data['pattern'],$data['password'],$matches);
        
        $matchCount=count($matches[0]);
        
       //Test if password is greater than or equal min value
        $minCase=!$maxExist && $matchCount>=$data['min'];

        //Test if password is between min an max value
        $minmaxCase=$maxExist && $matchCount>=$data['min'] && $matchCount<=$data['max'];

        $response=$minCase||$minmaxCase;

        return [
            'isValidated'=>$response,
            'minCase'=>$minCase,
            'minmaxCase'=>$minmaxCase,
            'matchCount'=>$matchCount
        ]; 
        
    }

    /**
     * Generate error message
     * @param mixed $message
     * @param array $data
     * @return string
     */
    public static function getErrorMessage(?string $message,array $data):string {

        $errorMessage='';

        $errorMessage=match(true) {

            !empty($message)=>$message,

            $data['max']===$data['min']=>"the password must contain {$data['min']} {$data['m']}",

            $data['matchCount']<$data['min']=>"the password must contain minimum {$data['min']} {$data['m']}",

            ($data['matchCount']>$data['max']&&!empty($data['max']))=>"the password must contain {$data['min']}  to {$data['max']} {$data['m']}",

            default=>'error'


        };

       
        return $errorMessage;


    }

    public static function getSetLengthErrorMessage(array $data):string {

        $min=$data['min'];
        $max=$data['max'];
        $stringLength=$data['stringLength'];

        $maxExist=!is_null($max);

        $response=match(true) {
            !empty($message)=>$message,

            ($stringLength>$max&&$maxExist)=>"the password must contain  $min to $max  characters",

            ($stringLength>$min&&$min===$max)=>"the password must contain  $min characters",

            ($stringLength<$min&&!$maxExist)=>"the password must contain minimum $min characters",

            ($stringLength<$min&&$maxExist)=>"the password must contain  $min to $max characters",

            default=>'error'
        };

        return $response;

    }
}

?>