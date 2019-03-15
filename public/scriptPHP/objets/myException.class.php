<?php
require_once dirname(__FILE__) . "/Exceptions.class.php";

global $monTraceur;
$monTraceur = new Exceptions();

class myException extends Exception
{

    private $contenuDeClasse;

    protected $message;

    protected $code;

    protected $line;

    protected $file;

    protected $function;

    protected $class;

    protected $method;

    protected $trait;

    protected $namespace;

    public function __construct($message, $code = NULL)
    {
        global $monTraceur;
        $this->message = $message;
        $this->code = $code;
        $this->file = __FILE__;
        $this->line = __LINE__;
        $this->function = __FUNCTION__;
        $this->class = __CLASS__;
        $this->method = __METHOD__;
        $this->trait = __TRAIT__;
        $this->namespace = __NAMESPACE__;
        
        // On cale le traceur au cas o� ...
        
        $this->contenuDeClasse = Array(
            'message' => $this->message,
            'code' => $this->code,
            'ligne' => $this->file,
            'fonction' => $this->line,
            'classe' => $this->class,
            'methode' => $this->method,
            'aire dl espace de nom' => $this->trait,
            'espace de noms' => $this->namespace
        );
        
        $monTraceur->addException($this);
    }

    /*
     * Oublions les getters et les setters c'est plus class de dire accesseurs et composeurs (ou d'autres mots aussi gros ceux l�-s )
     * public method getMessage(), getFile(), getCode(), getLine(){ return NULL }
     */
    public function getContenuDeClasse()
    {
        return $this->contenuDeClasse;
    }

    public function TraceLaSonde()
    {
        global $monTraceur;
        return $monTraceur;
    }

    public function TraceLaSondeEcho()
    {
        global $monTraceur;
        ob_start();
        $monTraceur->AfficheLeTraceur_des_exceptions();
        return ob_end_flush();
    }
    /*
     * public function getTraceAsString(){
     * }
     * public function getTraceAsString(){
     * }
     * public function __toString(){
     * }
     * public function __clone(){
     * }
     */
    
    /*
     * DOESN'T WORK ? WHY NOT ? >>> send to Rasmus LENDORF
     * $this->function = (isset( __FUNCTION__ ))? __FUNCTION__ : "Not From A Funk...(Zion)";
     * $this->class = (isset( __CLASS__ ))? __CLASS__ : "Not From A Class...(Room)";
     * $this->method = (isset( __METHOD__ ))? __METHOD__ : "Not From A Meet...(Ode)";
     * $this->trait = (isset( __TRAIT__ ))? __TRAIT__ : "Not From A Tree...(Hate)";
     * $this->namespace = (isset( __NAMESPACE__ ))? __NAMESPACE__ : "Not From A Name...(Espace)";
     */
} 