<?php 
date_default_timezone_set('Asia/Kolkata');
class Database
{
	public $con;
	public function __construct(){

		//echo $_SERVER["SERVER_NAME"];
		
			//echo "asdfasd";die;
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$db = "tictactoe";

		    $this->con = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
			//$conn = mysqli_connect("$host_name","$db_user","$db_pwd","$db_name");
			//return $this->con;
		
		// else
		// {	
			
		// 	$dbhost = "localhost";
		// 	$dbuser = "spacefb1_cipsusr";
		// 	$dbpass = "vB$49im}#JDv";
		// 	$db = "spacefb1_hotelviproad";
		// 	$this->con = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
		// 	// print_r($this->con);
		// }

		//$this->con = mysqli_connect("$host_name","$db_user","$db_pwd","$db_name");
		if (!$this->con) {
			die('Could not connect:'. mysqli_connect_error());
		}
	}
}
?>