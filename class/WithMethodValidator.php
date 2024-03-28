<?php 

namespace PasswordPolicy;

class WithMethodValidator {


    public static function check(array $data) {

        $maxExist=$data['max']!==null;

        //Rule pattern
        preg_match_all($data['pattern'],$data['password'],$matches);

        $matchCount=count($matches[0]);
       
        $minCase=!$maxExist&& $matchCount>=$data['min'];
        $minmaxCase=$maxExist && $matchCount>=$data['min'] && $matchCount<=$data['max'];

        $response=$minCase||$minmaxCase;

        return [
            'isValidated'=>$response,
            'minCase'=>$minCase,
            'minmaxCase'=>$minmaxCase,
            'matchCount'=>$matchCount
        ]; 
        

    }

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
}

?>