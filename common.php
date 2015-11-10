<?php
    error_reporting(7);
    
    $__FILE__ = dirname(__FILE__);
    
    $INCLUDE_DIR = $__FILE__.'/include/';
    $SMARTY_DIR = $__FILE__.'/smarty/';
    $APP_DIR = $__FILE__.'/app/';
    $CONF_DIR = $__FILE__.'/local_settings/';
    
    $CSS_DIR = $__FILE__.'/css/';
    $JS_DIR = $__FILE__.'/js/';
    
    define("INCLUDE_DIR",$INCLUDE_DIR);
    define("SMARTY_DIR",$SMARTY_DIR);
    define("APP_DIR",$APP_DIR);
    define("CONF_DIR",$CONF_DIR);
    
    define("CSS_DIR",$CSS_DIR);
    define("JS_DIR",$JS_DIR);
    
    define("APP_URL","http://".$GLOBALS["HTTP_HOST"]);
    
    require_once SMARTY_DIR.'Smarty.class.php';
    $smarty = &new Smarty();
    
    $smarty->template_dir = './templates';
    $smarty->compile_dir = './templates/template_c';
    $smarty->cache_dir = './templates/cache';
    $smarty->config_dir = './templates/configs';
    
    //$_SESSION["userData"]["userName"] = "Boris Duchaj";
    
    $smarty->assign_by_ref("GLOBALS",$GLOBALS);
    
    $GLOBALS["dclasses"] = require_once CONF_DIR.'dclasses.ini.php';
    
    //require_once INCLUDE_DIR.'/pager/Pager.php';
    
    
?>