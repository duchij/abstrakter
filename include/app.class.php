<?php 
require_once 'pager/Pager.php';

/**
 * @author Boris Duchaj
 * 
 * @version 0.0.1
 *
 */
class app {
	
	var $dbData = array();
	var $user_id;
	var $user_email;
	/**
		 * {@inheritdoc}db
		 */
	var $omega;
	
	var $classCache = array();
	
	//var $odbc;
	
	var $LABELS = array();
	
	//var $formdes;
	
	
	function __construct()
	{
	    $this->init($this);
	}
	
	
	function init($caller)
	{
	    $classes = $GLOBALS["dclasses"];
	    
	    foreach ($classes as $class){
	        
	        //echo $class;
	        if (isset($GLOBALS[$class])!=FALSE){
	            $c = strtolower(get_class($GLOBALS[$class]));
	           $caller->$c = &$GLOBALS[$c];
	        }
            else {
                $obj = $this->loadClass($class);
                $GLOBALS[$class]=$obj;
                $caller->$class = &$obj;
            }	        
	    }
	}
	
	
	public function start($request)
	{
	   //$_SESSION["hlo"]="test"; 
	    
	   $class = $request["_rData"];
	   $method = $request["_oData"];
	   
	   //var_dump($class);
	   if (isset($class) != FALSE)
	   {
	       $obj = $this->loadClass("router");	       
	       $obj->start($_REQUEST);
	   }
	   else 
	   {
	       $this->showPage("index.tpl",$data);
	   }
	   	               
		
	}
	
	public function loadClass($class)
	{
	    $completeClassFile = INCLUDE_DIR."{$class}.class.php";
	    
        if (file_exists($completeClassFile)){
               $res = require_once $completeClassFile;
               $obj = &new $res();
               return $obj;
            }
            else {
                echo("uplne zle");
            }
	    
	    
	}
	
	public function showPage($page="index.tpl",$variab=array())
	{
	    
	    
	    $avab_congress = $this->db->sql_table("SELECT * FROM [kongressdata]");
	    
	    //var_dump($avab_congress);
	    
	    $links = $this->showPager($avab_congress["table"]);
	    $this->smarty->assign("links",$links);
	    $this->smarty->assign("avab_kongress",$avab_congress["table"]);
	    $this->smarty->assign("page_template",$page);
        $this->smarty->display("mpage/mbody.tpl");	     
	}
	
	public function startTransaction()
	{
	    
	}
	
	public function getRights()
	{
	    
	}
	
	public function showPager($data)
	{
	    $pages = count($data);
	    
	    echo $pages;
	    
	    $pager_options = array(
	        'mode'       => 'Sliding',
	        'perPage'    => 5,
	        'delta'      => 4,
	        'totalItems' => $pages,
	    );
	    $pager = Pager::factory($pager_options);
	    return $pager->links;
	    
	}

	//return app;
	
}



?>
