<?php
class user extends app{
    function __construct(){
        parent::init($this);
    }
    
    public function data()
    {
        //echo "lal";
        $this->showPage("user.tpl");
    }
    
    
}
return "user";