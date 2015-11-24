<?php
//define(_beloved,1);
session_start();
ob_start();
error_reporting(0);




//SEF code
if(!empty($_GET['querystring'])){
	$queryString = $_GET['querystring'];
	$queryString = explode("/",$queryString );
	$_GET['p'] = str_replace('-','_',$queryString[0]);
	$t="";
	for($i=1; $i<count($queryString ); $i++){
		if($t=="")$t=$queryString[$i];
		else { $_GET[$t] = $queryString[$i]; $t="";}
	}
	unset( $_GET['querystring']);        
        }
if(isset($_GET['p'])) $_GET['p'] = str_replace('-','_',$_GET['p']);

$PATH = dirname(__FILE__).'/';
$INC = $PATH."inc/";
$roseandv = $PATH."bonnesys_d/";
require_once($INC . "belovedFunctions.php");
require_once($INC."config.php");
$beloved = new BelovedFunctions(config::dbhost,config::dbname,config::dbuser,config::dbpass);
$view=$roseandv."_{$_GET['p']}.php";



#print $beloved->getExtension('belovedLogin.php');
if(empty($_GET['p'])) require_once($roseandv."_home.php");
else if(!file_exists($view)) require_once($roseandv."404.php");   
else 
    require_once($INC."head.php");  
    require_once($view);
    require_once($INC."footer.php");

   
?>
           

