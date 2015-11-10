<?php 
//session_start();
require_once '../include/app.class.php';

class init {
    
    function __construct()
    {
        
    }
    
    /**
     * 
     * Funkcia zavola triedu a instancuje dla formularu ktory ju zavolal a odovzda jej webovsky request.
     * 
     * @param array $data REQUEST data
     * 
     * @todo toto treba obohatit a furu veci :)
     */
    public function run($data)
    {
        if (isset($data["w"]))
        {
            
            $cls = $data["w"];
            if (file_exists("./app/".$cls.".class.php"))
            {
            
                require_once $cls.'.class.php';
                $obj = new $cls();
                $obj->init($data);
            }
            else 
            {
               // var_dump($_REQUEST);
                echo "no such class exiting";
                exit;
            }
            
        }
        else  //fallback trieda
        {
           echo "No sync class defined exiting";
           exit;
        }
    }
}

?>