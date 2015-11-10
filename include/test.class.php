<?php
class test extends app{

    function __construct(){
       parent::init($this);
    }
    
    public function pokus($data="")
    {
        
        $this->smarty->display("index.tpl");
    }
}

return "test";
?>