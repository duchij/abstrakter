<?php 
class congress extends app {
    function __construct(){
        parent::init($this);
    }
    
    public function add($data)
    {
             
        $this->showPage("kongress.tpl");
    }
}

return "congress";
?>