<?php 

namespace PasswordPolicy;

class PasswordPolicy {

    private bool $status=false;

    private int $id=0;

    private int $totalRull=0;

    private array $matches=[];

    public function __construct(private string $secret) {


    }

    /**
     * Validates the presence of one or more symbol.
     *
     * @param boolean $acceptMany
     * @return self
     */
    public function withSymbol(bool $acceptMany=true,?string $message=null):self {
       
        $regex=!$acceptMany?"/(^[a-zA-Z0-9]*[\W_]{1}[a-zA-Z0-9]*$)+/":"/(^.*[\W_]+.*$)+/";

        $this->status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();

        if($this->status) {
            $this->incrementId();
        }

        return $this;

    }

    
    /**
     * Validates the presence of one or more number letters.
     *
     * @param boolean $acceptMany
     * @return self
     */
    public function withNumber(?bool $acceptMany=true):self {

        $regex=!$acceptMany?"/(^[\D\W]*[\d]{1}[\D\W]*$)+/":"/(^.*[\d]+.*$)+/";


        $this->status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();
        if($this->status) {
            $this->incrementId();
        }

        return $this;

    }

   
    /**
     * Validates the presence of one or more lowercase letters.
     *
     * @param boolean $acceptMany
     * @return self
     */
    public function withLowercase(bool $acceptMany=true):self {

        $regex=!$acceptMany?"/(^[A-Z\d\W]*[a-z]{1}[A-Z\d\W]*$)+/":"/(^.*[a-z]+.*$)+/";

        $this->status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();
        if($this->status) {
            $this->incrementId();
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

        $this->status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();
        if($this->status) {
            $this->incrementId();
        }

        return $this;

    }


    public function blockSameCharactere(int $min=2,?int $max=null):self {

        $limit=empty($max)?'{'.$min.',}':'{'.$min.','.$max.'}';

        $data='abcdefghijklmnopqrstuvwxyz';

        $splitData=preg_split('/\B/',$data);


        $response=array_map(function($el) use($limit) {

            return "^$el{$limit}$";

        },$splitData);

        $regex="/".implode('|',$response)."/";

        dump($regex);

        /* fait la meme chose pour les nombres et les lettres majuscule et les caracteres speciaux */

        $this->status=preg_match_all($regex,$this->secret);

        $this->incrementTotalRull();
        if($this->status) {
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