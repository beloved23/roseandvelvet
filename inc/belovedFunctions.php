<?php
require_once('class.phpmailer.php');
define('GUSER', 'belovedgoal23@gmail.com'); // GMail username
define('GPWD', 'oluwakemi'); // GMail password

/**
 * Description of belovedFunctions
 *
 * @author beloved
 */

##################################################
##A	##
##################################################

## 	The following functions can be found in this class
##	setting($settingname)
##	user($id="",$property="")
##	countryPrices($personalPrice = "")
##	dbconnect($DB_NAME = "")
##	cleanSQL ($sql)
##	dbquery ($sql="",$DB_NAME = "")
##	dbcount ($sql="",$DB_NAME = "")
##	dbcountchanges ($sql="",$DB_NAME = "")
##	dbrow ($sql="",$DB_NAME = "")
##	dbarray ($sql="",$DB_NAME = "")
##	getIpAddress()
##	getExtension($str)
##	uploadNewFile($fieldname, $allowedExt, $uploadsDirectory)
##	alert()
//	makeAlert($msg = "")
##	URLRequest($url2, $protocol="GET")
##	alterPhone($gsm)
##	correctCommas($csv)
##	uniqueArray($myArray)
##	filterNos($csv)
##	customizeMsg($msg,$username='',$name='',$email='',$GSM='',$units='x',$orderAmt='',$orderUnits='')
##	mceil($x)
##	generatePassword($length=10,$case=0)
##	isValidEmail($email)
##	datedsub($first_date,$second_date,$f="d")
##	thisURL()
##	pageReload()
##	fetchFiles ($directory,$filter="") 
##	function gridDisplay($query)
##	function gridSize($tablename,$condition="")
##	function gridSearch($arr)
##	cacheInfo($smsClient,$data)
##	validateDate( $date, $format='YYYY-MM-DD')
##	countdown($year, $month, $day, $hour, $minute)
##	copyFolder($src,$dst)
##	resizeImage($inputFile,$outputFile,$newWidth,$newHeight,$percent,$constrain)
##	preventCopy()
##	preventPrint()
##  savePost()
##	updatePost($tablename,$exclude,$condition)
##	makeSefUrl($url)
##	clientRedirect($url)
##	savePost($tablename,$exclude,$action="INSERT")

class BelovedFunctions{
	private $dbx;
    public $loggedIn = false; //login status of user
    public $user = array();
	public $tables = array();
     


    ##################################################
	##	Function to call immediately class starts 	##
	##################################################
	function __construct( ) {
		$this->DB_HOST = func_get_arg(0);
		$this->DB_NAME = @func_get_arg(1);
		$this->DB_USER = @func_get_arg(2);
		$this->DB_PASS = @func_get_arg(3);
		$this->DB_PREFIX = "";
		$this->tables['settings']='settings';
		$this->isAPI = (empty($this->DB_USER) && empty($this->DB_NAME)) ? false : true ;
		if($this->isAPI) {
			$this->dbx = $this->dbconnect();
		} else $this->dbo = func_get_arg(0);
		$this->dbquery("SET time_zone = '".$this->setting("timezone")."'");
		
    } 
	
	##############################################
	#				load a setting				 #
	##############################################
	function setting($settingname=""){
		if(empty($this->settingsArray)){
			$query = "SELECT setName,setValue FROM {$this->tables['settings']}";
			$arr = $this->dbarray($query);
			for ($i=0; $i < count($arr);$i++){ 
				$this->settingsArray[ $arr[$i]['setName'] ] = $arr[$i]['setValue'];
			}
		}
		if(!empty($settingname))return $this->settingsArray[$settingname];
	}// end of function setting
	
	##############################################
	#			get destination cost			 #
	##############################################
	function countryPrices($personalPrice = ""){
		if(empty($this->cPrices) && empty($personalPrice)){
			$searchKeys = array("<br>","\n","\r"," ");
			$replaceKeys = array(",",",",",");
			$pricelist = str_replace( $searchKeys , $replaceKeys , $this->setting('countryCodes'));
			while(strpos($pricelist,",,") !== false){$pricelist = str_replace( ",," , "," , $pricelist);}
			$pricelist = explode(',',$pricelist);
			$countryPrices = array();
			foreach($pricelist as $value) $countryPrices[] = explode('=',$value);
			$this->cPrices = $countryPrices;
		} else if(!empty($personalPrice)) {//process my personal price
			$searchKeys = array("<br>","\n","\r");
			$replaceKeys = array(",",",",",");
			$pricelist = str_replace( $searchKeys , $replaceKeys , $personalPrice);
			while(strpos($pricelist,",,") !== false){$pricelist = str_replace( ",," , "," , $pricelist);}
			$pricelist = explode(',',$pricelist);
			$countryPrices = array();
			foreach($pricelist as $value) $countryPrices[] = explode('=',$value);
			return $countryPrices;
		}
		return $this->cPrices;
	}// end of function countryPrices

	
	##############################################
	##	Database connection and query functions	## 
	##############################################
	function dbconnect($DB_NAME = ""){
		//This function connects to mysql and selects a database. 
		//It returns the connection string.
		$DB_NAME = (empty($DB_NAME)) ? $this->DB_NAME : $DB_NAME;
		$x = @mysql_connect ($this->DB_HOST,$this->DB_USER,$this->DB_PASS) or die('Error. Could not connect to database!');
		@mysql_select_db($DB_NAME, $x) or die('<br>Error. Could not select database!');
		return $x;
	}//end function dbconnect
	
	function cleanSQL ($sql){
		// useful for joomla type queries that use db prefix
		return str_replace("#__",$this->DB_PREFIX,$sql);
	}//end function cleanSQL
	
	function dbquery ($sql="",$DB_NAME = ""){
		/* 	This function connects and queries a database. It returns the query result identifier.	*/
		if(empty($sql)) return false;
		if($this->isAPI){
			$sql = $this->cleanSQL($sql);
			$result = @mysql_query($sql,$this->dbx);
		} else{			
			$db =& $this->dbo;
			$db->setQuery($sql);
			$result = $db->query();
		}
		return $result;
	}//end function dbquery
	
	function dbcount ($sql="",$DB_NAME = ""){
		/* 	This function connects and queries a database. It returns the number of selected rows.	*/
		if(empty($sql)) return false;
		if($this->isAPI){
			$sql = $this->cleanSQL($sql);
			$result = @mysql_query($sql,$this->dbx);
			$rowcount =@ mysql_num_rows($result);
		} else{			
			$db =& $this->dbo;
			$db->setQuery($sql);
			$db->query();
			$rowcount = $db->getNumRows();
		}
		return $rowcount;
	}//end function dbcount
	
	function dbcountchanges ($sql="",$DB_NAME = ""){
		/* 	This function connects and queries a database. It returns the number of insert/updated/deleted/replace rows.	*/
		if(empty($sql)) return false;
		if($this->isAPI){
			$sql = $this->cleanSQL($sql);
			$result = @mysql_query($sql,$this->dbx);
			$rowcount = @mysql_affected_rows($this->dbx);
		} else{			
			$db =& $this->dbo;
			$db->setQuery($sql);
			$db->query();
			$rowcount = $db->getAffectedRows();
		}
		return $rowcount;
	} //end function dbcountchanges
	
	
	function dbrow ($sql="",$DB_NAME = ""){
		/* 	This function connects and queries a database. It returns a single row from d db as a 1d array. */
		if(empty($sql)) return false;
		if($this->isAPI){
			$result = $this->dbquery($sql,$DB_NAME);
			$out = @mysql_fetch_assoc($result);
		} else{
			$db =& $this->dbo;
			@$db->setQuery($sql);
			$out = $db->loadAssoc();
		}
		return $out; 
	}//end function dbrow
	
	
	function dbarray ($sql="",$DB_NAME = ""){
		/* 	This function connects and queries a database. It returns all rows from d result as a 2d array. */
		if(empty($sql)) return false;
		if($this->isAPI){
			$result = $this->dbquery($sql,$DB_NAME);
			$arr = array();
			while($row = @mysql_fetch_assoc($result)){ $arr[]=$row;	};
		} else{
			$db =& $this->dbo;
			$db->setQuery($sql);
			$arr = $db->loadAssocList();
		}
		return $arr;
	}//end function dbarray
	
	
	######################################################
	##		Function to get ip address of a client		##
	######################################################
	function getIpAddress() {
		return (empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])? $_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP']);
	}//end function getIpAddress
	
	######################################################
	##	This function returns the extension of the file.	##
	######################################################
	function getExtension($str) {
			 $i = strrpos($str,".");
			 if (!$i) { return ""; }
			 $l = strlen($str) - $i;
			 $ext = substr($str,$i+1,$l);
			 return $ext;
	}//end function getExtension
	
	######################################################
	##	this function upload a file and return its path	##
	######################################################
	function uploadNewFile($fieldname, $allowedExt, $uploadsDirectory){
		// possible PHP upload errors
		$errors = array(1 => 'Selected file is too large!',//php.ini max file size exceeded!
                                2 => 'Selected file is too large!',//html form max file size exceeded!
                                3 => 'Incomplete file upload!',//file upload was only partial!
                                4 => 'No file was selected!');
	
		
		if(!($_FILES[$fieldname]['error'] == 0)) return 'Error - '.$errors[$_FILES[$fieldname]['error']];// check for PHP's built-in uploading errors
		// check that the file we are working on really was the subject of an HTTP upload
		if(!(@is_uploaded_file($_FILES[$fieldname]['tmp_name']))) return 'Error - File is not an HTTP upload!'; 
		if(!empty($allowedExt)){
			//Check if its in the allowed extension list
			$ext = $this->getExtension($_FILES[$fieldname]['name']);
			$pos = strripos($allowedExt,$ext);
			if ($pos === false) return 'Error - Invalid file type!';
		}
		//create unique filename
		$now = time();
		while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name'])){    
			$now++;
		}
		// now let's move the file to its final location
		if(!(move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename))) return 'Error - Unable to move file uploaded file';
		else return $uploadFilename;
	}//end function uploadNewFile
	
	######################################################################
	##	Function to display all messages logged during page generation	##
	##	the messages should be saved as array to $_SESSION['message']	##
	######################################################################
	function alert(){
		if(count(@$_SESSION['messageToAlert']) > 0){
			if($this->setting('alert') == 1) echo '<script type="text/javascript"> alert(\''.str_replace("'","\'",implode('\n',$_SESSION['messageToAlert'])).'\');</script>';
			echo '<div class="alert">'.implode("<br />",$_SESSION['messageToAlert'] ).'</div>';
			$_SESSION['messageToAlert'] = array();
		}
	}//end function alert
        
        function makeAlert($msg = ""){	
            if(empty($msg)) return;
            $_SESSION['messageToAlert'][] = $msg;
	}//end function alert
		
	
	#######################################################################################################
	##  The function to post a HTTP Request to the provided url passing the $_data array to the API	     ##
	#######################################################################################################
	 
	function URLRequest($url2, $protocol="GET") {
		try {
			$protocol = strtoupper($protocol);
			// parse the given URL
			$url = parse_url($url2);
			$port = (empty($url['port']))?false : true;
			if(!$port && $protocol=="GET") $content = file_get_contents($url2);
			else if(!$port && $protocol=="POST"){
				 $site = explode("?",$url2,2);
				 $content = file_get_contents ($site[0], false, stream_context_create (array ('http'=>array ('method'=>'POST', 'header'=>"Connection: close\r\nContent-Length: ".strlen($url['query'])."\r\n", 'content'=>$url['query']))));
			} else{ 
				if (!isset($url['port'])) {
				  if ($url['scheme'] == 'http') { $url['port']=80; }
				  elseif ($url['scheme'] == 'https') { $url['port']=443; }
				}
				$url['query']=empty($url['query'])?'':$url['query'];
				$url['path']=empty($url['path'])?'':$url['path'];
			
				$url['protocol']=$url['scheme'].'://';
				$eol="\r\n";
				$h="";$postdata_str="";$getdata_str="";
				if ($protocol == 'POST'){
					$h = "Content-Type: text/html".$eol.
					"Content-Length: ".strlen($url['query']).$eol;
					$postdata_str = $url['query'];
				} else	$getdata_str = "?".$url['query'];
				
				$headers =  "$protocol ".$url['protocol'].$url['host'].$url['path'].$getdata_str." HTTP/1.0".$eol.
							"Host: ".$url['host'].$eol.
							"Referer: ".$url['protocol'].$url['host'].$url['path'].$eol.$h.
							"Connection: Close".$eol.$eol.
							$postdata_str;
				$fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 60);
				if($fp) {
				  fputs($fp, $headers);
				  $content = '';
				  while(!feof($fp)) { $content .= fgets($fp, 128); }
				  fclose($fp);
				  //removes headers
				  $pattern="/^.*\r\n\r\n/s";
				  $content=preg_replace($pattern,'',$content);
				}
			}
			
		} catch (Exception $e) {
			$content = "";
		}
		return $content;
	}//end function URLRequest

	
	##############################################
	## 		correct gsm numbers					##
	##############################################
	function alterPhone($gsm) {
		$array = is_array($gsm);
		$gsm = ($array) ? $gsm : explode(",",$gsm);
		$homeCountry = $this -> setting("countryCode");
		$outArray = array();
		foreach($gsm as $item)
		{
			if(!empty($item)){
				//$item = (string)$item;
				$item = (substr($item,0,1) == "+") ? substr($item,1) : $item;
				$item = (substr($item,0,3) == "009") ? substr($item,3): $item;
				$outArray[] = (substr($item,0,1) == "0") ? $homeCountry.substr($item,1): $item;
			}
		}
		return ($array) ? $outArray : implode(",",$outArray);
	}//end function alterPhone
	
	
	##############################################
	## 		correct input csv numbers			##
	##############################################
	function correctCommas($csv) {
		$inpt= array("\r","\n",' ',';',':','"','.',"'",'`','\t','(',')','<','>','{','}','#',"\r\n",'-','_','?','+');
		$oupt= array(',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',');
		$csv = str_replace($inpt,$oupt,$csv);
		while(strpos($csv,',,') !== false){
			$csv = str_replace(',,',',',$csv);
		}
		return trim($csv,",");
	}//end function correctCommas
	
	##############################################
	## 		get unique array fields				##
	##############################################
	function uniqueArray($myArray) {
		$array = is_array($myArray);
		$myArray = ($array) ? $myArray: explode(",",$myArray);
		$myArray = array_flip(array_flip(array_reverse($myArray,true)));
		return ($array) ? $myArray : implode(',',$myArray);
	}//end function uniqueArray
	
	
	##############################################
	## 		correct input gsm numbers			##
	##############################################
	function filterNos($csv) {
		$array = is_array($csv);
		$csv = ($array) ? $csv : explode(",",$csv);
		$validArray = array();
		foreach($csv as $value){
			$l = strlen($value);
			if($l >= 7 && $l <= 15) $validArray[]= $value;
		}
		return ($array) ? $validArray : implode(',',$validArray);
	}//end function filterNos
	
	
	
	##############################################
	## 			Replace user parameters			##
	##############################################
	function customizeMsg($msg,$username='',$name='',$email='',$GSM='',$units='x',$orderAmt='',$orderUnits='') {
		$inpt= array('@@username@@','@@name@@','@@email@@','@@GSM@@','@@units@@','@@orderAmt@@','@@orderUnits@@');
		$oupt= array($username,$name,$email,$GSM,$units,$orderAmt,$orderUnits);
		$msg= str_ireplace($inpt,$oupt,$msg);
		return $msg;
	}//end function customizeMsg
	
	
	
	##############################################
	## 			Round up numbers				##
	## 		function ceil in php has			##
	## 	  a bug so this mceil was written		##
	##############################################
	function mceil($x) {
		$c = 1;
		return  ( ($y = $x/$c) == ($y = (int)$y) ) ? $x : ( $x>=0 ?++$y:--$y)*$c ; 
	}//end function mceil
	
	
	##############################################
	## 			Generate random characters		##
	##############################################
	function generatePassword($length=10,$case=0){
	   $characters = "qwertyup2346789lkjhgfdazxcvbnm";
	   if($case != 0) $characters = strtoupper($characters);
		$string = "";    
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
		return $string;
	}//end function generatePassword
	
	
	##############################################
	##		Validate an email address 			##
	##############################################
	function isValidEmail($email){
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
			return false; 
		} else {
			return true;
		}
	}//end function isValidEmail

	
	##############################################################################################
	##	Function to subtract two dates and return the difference in d= days, h=hours, m=minutes 	##
	##############################################################################################
	function datedsub($first_date,$second_date,$f="d"){
		$d1 = strtotime($first_date);
		$d2 = strtotime($second_date);
		$delta = $d2 - $d1;
		switch ($f)
		{
			case "d":
				$num = ($delta / 86400);
			break;
			case "h":
				$num = ($delta / (3600));;
			break;
			case "m":
				$num = ($delta / (60));;
			break;
			default:
				$num = ($delta / 86400);
		} 
		return round($num,0,PHP_ROUND_HALF_UP);
	}//end function datedsub
	
	
	###############################################
	##				Get page url				 ##
	###############################################
	function thisURL() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	}//end function thisURL
	
	
	###############################################
	##				Reload the current page 	 ##
	##		without resending POST variables	 ##
	###############################################
	function pageReload() {
		die('<meta http-equiv="refresh" content="0"/> <script type="text/javascript">window.location.href=window.location.href;</script><input type="button" value="      =>      " onClick="window.location.href=window.location.href">');
	}//end function pageReload
	
	
	##################################################
	##			Fetch files in a directory			##
	##################################################
	 function fetchFiles ($directory,$filter="") {
		// create an array to hold directory list
		$results = array();
		
		// create a handler for the directory
		$handler = opendir($directory);
		
		// open directory and walk through the filenames
		while ($file = readdir($handler)) {
			// if file isn't this directory or its parent,  and contains the filter or filter is empty, add it to the results
			if ($file != "." && $file != "..") {
			if((!empty($filter) && stripos($file,$filter) !== false) || empty($filter)) $results[] = $file;
			}
		}
		closedir($handler);
		return $results;
	 }//end function fetchFiles
	 
	 #####################################################
	 ##		Function to display datagrid contents		##
	 #####################################################
         function gridDisplay($query){
            $tableObject = $this -> dbarray($query);
            $n=0;
            $ttr = "<table class='table'>";
            for($i=0;$i<count($tableObject); $i++){
               $row = $tableObject[$i];
               //echo headers
               if($n == 0){
                    $th = array();
                    foreach($row as $key => $value)if(!is_numeric($key)) $th[] = ucwords($key);
                    $ttr .= "<tr><th class='th'>".implode("</th><th class='th'>",$th)."</th></tr>";
                    $n += 1;
                }
                //echo contents
                $th = array();
                foreach($row as $key => $value) {
                        if(!is_numeric($key))$th[]= $value;
                }
                if($n >= 2){ $ttr .= "<tr class='tr2'><td class='cell'>".implode("</td><td class='cell'>",$th)."</td></tr>"; $n=0;}
                else $ttr .= "<tr class='tr1'><td class='cell'>".implode("</td><td class='cell'>",$th)."</td></tr>";
                $n += 1;
            }
            $ttr .= "</table>";
            return $ttr;
         }//end function gridDisplay
		 
	
	 #####################################################
	 ##		Function to get datagrid size and links		##
	 #####################################################
	function gridSize($tablename,$condition=""){
		$output = array();
		$this_page = "";
		//parse_str($_SERVER['QUERY_STRING'], $url);
		$url = $_GET;
		// number of rows to show per page
		$rowsperpage = $this -> setting('rows_per_page');
		$rowsperpage = ((int)$rowsperpage > 0) ? (int)$rowsperpage : 10;
		// range of num links to show
		$range = 4;
		//add where to the condition if a condition has been set
		if(!empty($condition)) $condition = (stripos($condition,"WHERE ") === false) ? "WHERE $condition" : $condition;
		$countsql = "select count(*) as cnt from $tablename $condition";
		$numrows = $this -> dbrow($countsql);
		$numrows = $numrows['cnt'];
		// find out total pages
		$totalpages = $this->mceil($numrows / $rowsperpage);
		
		// get the current page or set a default
		$currentpage = @$_GET['currentpage'];
		$currentpage = ((int)$currentpage > 0) ? (int) $_GET['currentpage'] : 1 ;
		
		// if current page is greater than total pages...
		$currentpage = ($currentpage > $totalpages) ? $totalpages : $currentpage;
		
		// if current page is less than first page...
		$currentpage = ($currentpage < 1) ? 1 : $currentpage;
		// the offset of the list, based on current page 
		$offset = ($currentpage - 1) * $rowsperpage;
		$output['start'] = $offset+1;
		$output['size'] = $rowsperpage;	
		$output['total'] = $numrows;			
		$output['size'] = (($output['start']+$output['size'])>$output['total'])? ($output['total'] - $output['start']) + 1:$output['size'] ;
		/******  build the pagination links ******/	
		// if not on page 1, don't show back links
		$pagination = "";
		if ($currentpage > 1) {
		   // show << link to go back to page 1
			$url['currentpage'] = 1;//$currentpage;
		   $pagination .= " <a href='".$this->makeSefUrl($this_page."?".http_build_query($url))."'>[first]</a> ";
		   // get previous page num
		   $prevpage = $currentpage - 1;
		   // show < link to go back to 1 page
			$url['currentpage'] = $prevpage;
		   $pagination .= " <a href='".$this->makeSefUrl($this_page."?".http_build_query($url))."'>[prev]</a> ";
		} // end if 
		
		// loop to show links to range of pages around current page
		for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
		   // if it's a valid page number...
		   if (($x > 0) && ($x <= $totalpages)) {
			  // if we're on current page...
			$url['currentpage'] = $x;
			  $pagination .= ($x == $currentpage) ? " [<b>$x</b>] " : " <a href='".$this->makeSefUrl($this_page."?".http_build_query($url))."'>$x</a> ";
		   } // end if 
		} // end for
						 
		// if not on last page, show forward and last page links        
		if ($currentpage != $totalpages) {
		   // get next page
		   $nextpage = $currentpage + 1;
			// echo forward link for next page 
			$url['currentpage'] = $nextpage;
		   $pagination .= " <a href='".$this->makeSefUrl($this_page."?".http_build_query($url))."'>[Next]</a> ";
		   // echo forward link for lastpage
			$url['currentpage'] = $totalpages;
		   $pagination .= " <a href='".$this->makeSefUrl($this_page."?".http_build_query($url))."'>[Last]</a> ";
		} // end if
		/****** end build pagination links ******/
		$output['links'] = $pagination;
		return $output;
	}//end function gridSize($tablename,$condition="")
	
	 #####################################################
	 ##		Function to display datagrid search box		##
	 #####################################################
	function gridSearch($arr){
		if($_POST['search_now'] == 'Reset') { $_SESSION['query_condition'] = "1=1"; $_GET['currentpage']=1;}
		else if($_POST['search_now'] == 'Search'){ $_SESSION['query_condition'] = " ".$_POST['srch_field']." LIKE '%".$_POST['search_word']."%'";  $_GET['currentpage'] = 1;}
		else $_SESSION['query_condition'] = (!empty($_SESSION['query_condition'])) ? $_SESSION['query_condition'] : "1=1";
		if($_SESSION['last_page_visited'] != $_GET['p']) $_SESSION['query_condition']="1=1";
		$_SESSION['last_page_visited'] = $_GET['p'];
		$ttd = '<div class="full" align="center">
				<form name="searchForm" method="post" action="">
				<div class="full" align="center">
				<div class="left" align="right">
				Search For: 
				</div>
				<div class="right" align="left">
				<input type="text" name="search_word" value="';
		if($_POST['search_now'] != "Reset") $ttd .= $_POST['search_word'];
		$ttd .= '" />
				</div>
				</div>
				<div class="full" align="center">
				<div class="left" align="right">
				Within: 
				</div>
				<div class="right" align="left">
				<select name="srch_field">';
		foreach($arr as $key=>$value){
			$sel = ($_POST['srch_field'] == $key) ? ' selected="selected"' : "";
			$ttd .=  "<option value='$key' $sel > $value </option>";
		}
		$ttd .= '</select>
				</div>
				</div>
				<div class="clear"></div>
				<div class="full" align="center">
				<input type="submit" name="search_now" class="myButton" value="Search" />
				<input type="submit" name="search_now" class="myButton" value="Reset" />
				</div>
				</form>
				</div>';
		return $ttd;
	}//end function gridSearch($arr)
	
	 #####################################################
	 ##		Function to display pending messages		##
	 #####################################################
	function cacheInfo($smsClient,$data){
		$data = str_ireplace("@@date@@",date('Y-m-d h:i:s'),$data);
		$this->dbquery("UPDATE #__smsClient SET pendingNotifications = CONCAT(pendingNotifications,'#',$data) WHERE clientID = $smsClient");
	}//end function cacheInfo
	
	
	##########################################################
	##		Function to validate date						##
	##########################################################
	function validateDate( $date, $format='YYYY-MM-DD')
	{
		switch( $format )
		{
			case 'YYYY/MM/DD':
			case 'YYYY-MM-DD':
			list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date );
			break;
	
			case 'YYYY/DD/MM':
			case 'YYYY-DD-MM':
			list( $y, $d, $m ) = preg_split( '/[-\.\/ ]/', $date );
			break;
	
			case 'DD-MM-YYYY':
			case 'DD/MM/YYYY':
			list( $d, $m, $y ) = preg_split( '/[-\.\/ ]/', $date );
			break;
	
			case 'MM-DD-YYYY':
			case 'MM/DD/YYYY':
			list( $m, $d, $y ) = preg_split( '/[-\.\/ ]/', $date );
			break;
	
			case 'YYYYMMDD':
			$y = substr( $date, 0, 4 );
			$m = substr( $date, 4, 2 );
			$d = substr( $date, 6, 2 );
			break;
	
			case 'YYYYDDMM':
			$y = substr( $date, 0, 4 );
			$d = substr( $date, 4, 2 );
			$m = substr( $date, 6, 2 );
			break;
	
			default:
			throw new Exception( "Invalid Date Format" );
		}
		return checkdate( $m, $d, $y );
	}//end function validateDate
	
	#############################
    ###function GetBrowser
    function getBrowser()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
	
		
	######################################################################
	##	countdown function. Just provide a date to countdown to,		##
	##	it will then display the time left in days, hours and minutes.	##
	##	parameters: (year, month, day, hour, minute)					##
	##	Original author: Louai Munajim. website: www.elouai.com			##
	##	Modified by: Leke Ojikutu. website: www.lekeojikutu.com			##
	##	Note: Unix timestamp Date range is from 1970 to 2038			##
	######################################################################
	function countdown($year, $month, $day, $hour, $minute)
	{  
	  $the_countdown_date = mktime($hour, $minute, 0, $month, $day, $year, -1);// make a unix timestamp for the given date
	  $today = time();// get current unix timestamp
	  $difference = $the_countdown_date - $today;
	  if ($difference < 0) $difference = 0;
	  $days_left = floor($difference/60/60/24);
	  $hours_left = floor(($difference - $days_left*60*60*24)/60/60);
	  $minutes_left = floor(($difference - $days_left*60*60*24 - $hours_left*60*60)/60);
	  echo '<div id="countdowndiv"></div><script  language="javascript">dd='.$days_left.'; hh='.$hours_left.'; mm='.$minutes_left.'; ss=10;
			function cdtime(){
			ss--;
			if(ss<0){ss=59; mm--;}
			if(mm<0){mm=59; hh--;}
			if(hh<0){hh=23; dd--;}
			if(dd<0){dd=0; hh=0; mm=0; ss=0}
			document.getElementById("countdowndiv").innerHTML = dd+"days "+hh+"hrs "+mm+"mins "+ss+"secs";
			}
			setInterval ( "cdtime()", 1000 );
			</script>';
	}

	
	
		
	##########################################################################
	##		This function copies an entire folder and subfolder and files	##
	##########################################################################
	function copyFolder($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					copyFolder($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	} 
	
		
	######################################################################
	##	Function to resize an image and save it to a new destination	##
	######################################################################
	function resizeImage($inputFile,$outputFile,$newWidth,$newHeight,$percent,$constrain){
		$x = @getimagesize($inputFile); // get image size of input image
		$inputImageWidth = $x[0];// input image width
		$inputImageHeight = $x[1];// input image height
		if ($percent > 0) {// calculate resized height and width if percent is defined
			$percent = $percent * 0.01; $newWidth = $inputImageWidth * $percent; $newHeight = $inputImageHeight * $percent;
		} else {
			if (!empty($newWidth) AND empty($newHeight)) {// autocompute height if only width is set
				$newHeight = (100 / ($inputImageWidth / $newWidth)) * .01;	$newHeight = @round ($inputImageHeight * $newHeight);
			} elseif (empty($newHeight) AND !empty($newWidth)) {// autocompute width if only height is set
				$newWidth = (100 / ($inputImageHeight / $newHeight)) * .01;	$newWidth = @round ($inputImageWidth * $newWidth);
			} elseif (!empty($newHeight) AND !empty($newWidth) AND !empty($constrain)) {
				// get the smaller resulting image dimension if both height and width are set and $constrain is also set
				$newHeightx = (100 / ($inputImageWidth / $newWidth)) * .01; $newHeightx = @round ($inputImageHeight * $newHeightx);
				$newWidthx = (100 / ($inputImageHeight / $newHeight)) * .01;	$newWidthx = @round ($inputImageWidth * $newWidthx);
				if ($newHeightx < $newHeight) {	$newHeight = (100 / ($inputImageWidth / $newWidth)) * .01;	$newHeight = @round ($inputImageHeight * $newHeight);	} 
				else { $newWidth = (100 / ($inputImageHeight / $newHeight)) * .01; $newWidth = @round ($inputImageWidth * $newWidth); }
			}
		}
		$im = @ImageCreateFromJPEG ($inputFile) or // Read JPEG Image
		$im = @ImageCreateFromPNG ($inputFile) or // or PNG Image
		$im = @ImageCreateFromGIF ($inputFile) or // or GIF Image
		$im = false; // If image is not JPEG, PNG, or GIF
		
		if (!$im) {
			return copy($inputFile,$outputFile);// We get errors from PHP's ImageCreate functions so let's copy back the actual image.
		} else {
			$thumb = @ImageCreateTrueColor ($newWidth, $newHeight); // Create the resized image destination
			@ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $newWidth, $newHeight, $inputImageWidth, $inputImageHeight);// Copy from image source, resize it, and paste to image destination
			return ImageJPEG ($thumb,$outputFile);// Output resized image
		}
	}
	
	######################################################
	##	Function prevents copying page contents			##
	######################################################
	function preventCopy(){
		echo '<SCRIPT LANGUAGE="JavaScript">document.onselectstart=new Function(\'return false\');function ds(e){return false;}function ra(){return true;}document.onclick=ra;document.onmousedown=ds;</script>
		<script language="JavaScript1.2"> function disabletext(e){ return false; }
		function reEnable(){return true; }
		//if the browser is IE4+
		document.onselectstart=new Function ("return false")
		//if the browser is NS6
		if (window.sidebar){document.onmousedown=disabletext; document.onclick=reEnable; }  </script>';
	}
	
	##############################################
	##	Function to prevent printing of a page	##
	##############################################
	function preventPrint(){ echo '<style type="text/css"><!--@media print {body { display: none }}--></style>'; }
      
	
	##############################################
	##		Function to save all post data		##
	##############################################
	function savePost($tablename,$exclude,$action="INSERT"){
		if(!is_array($exclude))$exclude = @explode(",",$exclude);
		foreach ($_POST as $key => $value){
			if(!in_array($key,$exclude )){
				$cols[]=$key;
				$vals[]="'".addslashes($value)."'";
			}
        }

		$cols_final=implode(",",$cols);
		$vals_final=implode(",",$vals);
		
        $query=$action." INTO $tablename ( $cols_final ) values($vals_final)";
		echo $query;
        return $this -> dbcountchanges($query);
	}//end function savepost
	
	
	##############################################
	##		Function to update all post data	##
	##############################################
	function updatePost($tablename,$exclude,$condition){
		if(!is_array($exclude))@$exclude = explode(",",$exclude);
		$condition = (stripos("WHERE",$condition) === false) ? "WHERE ".$condition : $condition;
		foreach ($_POST as $key => $value){
			if(!in_array($key,$exclude )){
				$cols[]=$key . " = '".addslashes($value)."'";
			}
        }
		$cols_final=implode(",",$cols);
        $query="UPDATE $tablename SET $cols_final $condition";
        return $this -> dbcountchanges($query);
	}//end function updatePost
	
	##################################################################
	##		Function to covert url to search engine friendly url	##
	##################################################################
	function makeSefUrl($url){
		$strx = explode("?",$url,2);
		$str = explode("&", $strx[1]);
		$p="";
		foreach ($str as $pair) {
			$t = explode("=", $pair);
			if($t[0] == 'p') $p=str_replace("_","-",$t[1]);
			else $u[] = $t[0].'/'.str_replace("_","-",$t[1]);
		}
		if(!empty($p)) $p = $p.'/';
		return str_replace('index.php','',$strx[0]).$p.@implode('/',$u);
	
        return $url;
	} //end of function makeSefUrl($url)
	
	
	##############################################
	##		Function to redirect at frontend	##
	##############################################
		function clientRedirect($url)
	   {		
		$url=$this->makeSefUrl($url);
			die("<meta HTTP-EQUIV='REFRESH' content='0; url='$url'><script type='text/javascript'>window.location='$url';</script>");
		} // end of function clientRedirect($url)
	###########################################
	
    function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
        $mail->IsHTML(true); 
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		//$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		//$error = 'Message sent!';
		return true;
	}
}
####################################################
	
	 function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
####################################################storing an array inside the session
	function setSessionvariables($arrayValue)
    {
		foreach($arrayValue as $key=>$value)
         {
         $_SESSION['form'][$key]=addslashes($value);
         }
    }
	#################################################
	function upload()
		{
		/*** check if a file was uploaded ***/
		if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
		{
			/***  get the image info. ***/
			$size = getimagesize($_FILES['userfile']['tmp_name']);
			/*** assign our variables ***/
			$type = $size['mime'];
			$imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
			$size = $size[3];
			$name = $_FILES['userfile']['name'];
			$maxsize = 99999999;


			/***  check the file is less than the maximum file size ***/
			if($_FILES['userfile']['size'] < $maxsize )
			{
				
				/*** our sql query ***/
				$stmt = $this->dbquery("INSERT INTO testblob (image_type ,image, image_size, image_name) VALUES ('$type' ,'$imgfp',' $size','$name')");

			}
			else
			{
				$this->makeAlert('size unsupported');
			}
		}
		else
		{
			$this->makeAlert('image type not allowes');
		}
	}
	function cleanInput($input)
		{
		$input=addslashes($input);
		return $input;
		}
	function file_get_contents_curl($url) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_URL, $url);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}
	function viewSource($url)
		{
		$lines = file($url);
		foreach ($lines as $line_num => $line) {
			// loop thru each line and prepend line numbers
			echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n";
		}
			
		}
	function genPass($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength >= 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength >= 2) {
		$vowels .= "AEUY";
	}
	if ($strength >= 4) {
		$consonants .= '23456789';
	}
	if ($strength >= 8 ) {
		$vowels .= '@#$%';
	}

	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
	function whois_query($domain) {

		// fix the domain name:
		$domain = strtolower(trim($domain));
		$domain = preg_replace('/^http:\/\//i', '', $domain);
		$domain = preg_replace('/^www\./i', '', $domain);
		$domain = explode('/', $domain);
		$domain = trim($domain[0]);

		// split the TLD from domain name
		$_domain = explode('.', $domain);
		$lst = count($_domain)-1;
		$ext = $_domain[$lst];

		// You find resources and lists
		// like these on wikipedia:
		//
		// http://de.wikipedia.org/wiki/Whois
		//
		$servers = array(
			"biz" => "whois.neulevel.biz",
			"com" => "whois.internic.net",
			"us" => "whois.nic.us",
			"coop" => "whois.nic.coop",
			"info" => "whois.nic.info",
			"name" => "whois.nic.name",
			"net" => "whois.internic.net",
			"gov" => "whois.nic.gov",
			"edu" => "whois.internic.net",
			"mil" => "rs.internic.net",
			"int" => "whois.iana.org",
			"ac" => "whois.nic.ac",
			"ae" => "whois.uaenic.ae",
			"at" => "whois.ripe.net",
			"au" => "whois.aunic.net",
			"be" => "whois.dns.be",
			"bg" => "whois.ripe.net",
			"br" => "whois.registro.br",
			"bz" => "whois.belizenic.bz",
			"ca" => "whois.cira.ca",
			"cc" => "whois.nic.cc",
			"ch" => "whois.nic.ch",
			"cl" => "whois.nic.cl",
			"cn" => "whois.cnnic.net.cn",
			"cz" => "whois.nic.cz",
			"de" => "whois.nic.de",
			"fr" => "whois.nic.fr",
			"hu" => "whois.nic.hu",
			"ie" => "whois.domainregistry.ie",
			"il" => "whois.isoc.org.il",
			"in" => "whois.ncst.ernet.in",
			"ir" => "whois.nic.ir",
			"mc" => "whois.ripe.net",
			"to" => "whois.tonic.to",
			"tv" => "whois.tv",
			"ru" => "whois.ripn.net",
			"org" => "whois.pir.org",
			"aero" => "whois.information.aero",
			"nl" => "whois.domain-registry.nl"
			);

		if (!isset($servers[$ext])){
			die('Error: No matching nic server found!');
		}

		$nic_server = $servers[$ext];

		$output = '';

		// connect to whois server:
		if ($conn = fsockopen ($nic_server, 43)) {
			fputs($conn, $domain."\r\n");
			while(!feof($conn)) {
				$output .= fgets($conn,128);
			}
			fclose($conn);
		}
		else { die('Error: Could not connect to ' . $nic_server . '!'); }

		return $output;
	}
	
	function extract_emails($str){
		// This regular expression extracts all emails from a string:
		$regexp = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
		preg_match_all($regexp, $str, $m);

		return isset($m[0]) ? $m[0] : array();
	}
	function getExcelData($data){
		$retval = "";
		if (is_array($data)  && !empty($data))
		{
			$row = 0;
			foreach(array_values($data) as $_data){
				if (is_array($_data) && !empty($_data))
				{
					if ($row == 0)
					{
						// write the column headers
						$retval = implode("\t",array_keys($_data));
						$retval .= "\n";
					}
					//create a line of values for this row...
					$retval .= implode("\t",array_values($_data));
					$retval .= "\n";
					//increment the row so we don't create headers all over again
					$row++;
				}
			}
		}
		return $retval;
	}
	
} //end of class beloved_class
//global $host,$dbname,$user,$password,$dbprefix;
//$beloved = new beloved_class(@$host, @$dbname, @$user, @$password, @$dbprefix, @$db);
?>