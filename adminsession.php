<?php 
include("action.php");


if(isset($_SESSION['usertype']) && $_SESSION['usertype'] != "" && isset($_SESSION['userid']) && $_SESSION['userid'] != "")
	{
		
		$ipaddress = $obj->get_client_ip();
		$loginid = $_SESSION['userid']; 
	    $usertype = $_SESSION['usertype'];
		//$companyid = isset($_SESSION['companyid'])?$_SESSION['companyid']:'';
	    //$sessionid = $obj->getvalfield("m_session","sessionid","status=1");
		$createdate = date('Y-m-d H:i:s');		
		}
else
	echo "<script>location='../index.php?msg=Invalid' </script>" ;
	
?>