<?php

class router extends app{
    //var $app;
    
    function __construct()
    {
        parent::init($this);
        //$this->app = &$GLOBALS["app"];
    }
    
   public function start($request){
       
       $route = $request["_rData"];
       
       $method = substr($request["_oData"],1);
       
       switch ($route){
           case "user":
                $this->showUser($route,$method,$request);
                break;
           case "congress":
               $this->showCongress($route,$method,$request);
               break;
       }
    }
    
    private function showUser($class,$method="",$data=array())
    {
        $obj =  $this->loadClass($class);
        $obj->$method($data);
        
    }
    
    
    private function showCongress($class,$method,$data)
    {
        $obj = $this->loadClass($class);
        $obj->$method($data);
    }
}

return "router";
 ?>
 