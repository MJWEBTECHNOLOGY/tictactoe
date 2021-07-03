<?php session_start();
include("config.php");

class DataOperation extends Database
{
	public function pre($val){
		echo "<pre>";
		print_r($val);
		echo "</pre>";
	}
	
	public function getSequence($num) {
  		return sprintf("%'.06d\n", $num + 1);
	}

	public function encrypt($simple_string)
	{
	    $ciphering = "AES-128-CTR"; 
	    $iv_length = openssl_cipher_iv_length($ciphering); 
	    $options = 0; 
	    $encryption_iv = '1234567891011121'; 
	    $encryption_key = "GeeksforGeeks"; 
	    return $encryption = openssl_encrypt($simple_string, $ciphering, 
	            $encryption_key, $options, $encryption_iv); 
	}

	public function login_method($table,$username,$password)
	{	
		$password = $this->encrypt($password);
		$sql = "SELECT * from $table WHERE username='$username' AND password='$password'";
		
		// echo $sql;die;	
		$query = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows($query);
		if($count > 0)
		{
			//$_SESSION['usertype']="trinity";	
			$row = mysqli_fetch_array($query);
			
			$_SESSION['usertype'] = $row['usertype'];
			$_SESSION['userid'] = $row['userid'];
			
			
  			return $count;
		}
		
	}
	public function login_method1($username,$password)
        {
		//this code is for checking employee login 
		$sql1 = "SELECT * from user_profile WHERE (mobile ='$username') AND password='$password'";
		//echo $sql1;die;
		$query1 = mysqli_query($this->con,$sql1);
		//echo $query1
		$count1 = mysqli_num_rows($query1);
		//echo $count1;die;
		if($count1 > 0){
			$row1 = mysqli_fetch_array($query1);
			// echo "<pre>";
			// print_r($row1);die;
			//print_r($_SESSION);die;
			// $_SESSION['type'] = $row['type'];
				$_SESSION['usertype'] = $row1['usertype'];
				//$_SESSION['emp_name'] = $row1['emp_name'];
			// if($row1['type'] == 'admin' or $row['type'] == 'employee')
			// {
				
			// }
			// $employee_id = $_SESSION['employee_id'];
		
  			setcookie("username", $username, time() + (86400 * 30 * 30), "/"); // 30 days
  			setcookie("password", $password, time() + (86400 * 30 * 30), "/"); // 30 days
            //echo $sql1;die;	
  			$exist = 1;
		}

		//echo $exist;die;
		return $exist;

	}

	public function login_method_app($table,$username,$password)
	{		
		
		
  			$sql = "SELECT * from $table WHERE mobile ='$username' AND password='$password'";
			$query = mysqli_query($this->con,$sql);
			//echo $query;die;
			$count = mysqli_num_rows($query);
			//print_r($count);die;
			if($count > 0){
			$row = mysqli_fetch_array($query);
			//print_r($row);die;
			//$_SESSION['customer_id'] = $row['manager_id'];
			//$_SESSION['type'] = $row['type'];
			$_SESSION['manager_id'] = $row['manager_id'];
  			setcookie("username", $username, time() + (86400 * 30 * 30), "/"); // 30 days
  			setcookie("password", $password, time() + (86400 * 30 * 30), "/"); // 30 days
           //echo $sql;die;
           	
  			$count = 1;
		}

		//echo $exist;die;
		return $count;

	}

function uploadImagename($imgpath,$docname)
{

     if(1==1)
	 {
		
		 $doc_name = $docname['name'];
		$tm="DOC";
		$tm.=microtime(true)*1000;
		$ext = pathinfo($doc_name, PATHINFO_EXTENSION);
		$doc_name=$tm.".".$ext;
		//echo $imgpath."$doc_name";die;
		if(move_uploaded_file($docname['tmp_name'],$imgpath."$doc_name"))
		{
           // echo ($imgpath.$doc_name);die;
			return($doc_name);
		}
		else
		{
			return("");
		}
			
   }
   else
   {
         return("0");
   }
}

function uploadImage($imgpath,$docname)
	{
		// echo "hello";die;
			
			 $doc_name = $docname['name'];
			$tm="DOC";
			$tm.=microtime(true)*1000;
			$ext = pathinfo($doc_name, PATHINFO_EXTENSION);
			$doc_name=$tm.".".$ext;
			//echo $imgpath."$doc_name";die;
			if(move_uploaded_file($docname['tmp_name'],$imgpath."$doc_name"))
			{
	           // echo ($imgpath.$doc_name);die;
				return($doc_name);
			}
			else
			{
				return("");
			}
	}

public function get_billno1($tablename,$tablepkey,$cond)
	{
		$currentdate = date('Y-m-d');
		$order_date = $this->getvalfield("order_entry_details","order_date","order_date='$currentdate'");
		$num =  $this->getvalfield($tablename,"max($tablepkey)","order_date='$order_date'");
		//if($num == NULL)
		//$num = 0;
	    ++$num; // add 1;
	    $len = strlen($num);
	    for($i=$len; $i< 5; ++$i) {
	        $num = '00'.$num;
	    }
	    return $num;
	}
function get_billno($tablename,$tablepkey,$cond)
{
	 $num =  $this->getvalfield($tablename,"max($tablepkey)",$cond);
	//if($num == NULL)
	//$num = 0;
    ++$num; // add 1;
    $len = strlen($num);
    for($i=$len; $i< 5; ++$i) {
        $num = '0'.$num;
    }
    return $num;
}

function get_booking_no($tablename,$tablepkey,$cond)
{
	 $num =  $this->getvalfield($tablename,"max($tablepkey)",$cond);
	//if($num == NULL)
	//$num = 0;
    ++$num; // add 1;
    $len = strlen($num);
    for($i=$len; $i< 5; ++$i) {
        $num = '0'.$num;
    }
    return $num;
}


// To decrypt data based on key //
public function decrypt($string, $key = ENCRYPTION_KEY)
{
	$result = '';
	$string = base64_decode($string);
	
	for($i=0; $i<strlen($string); $i++)
	{
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}
public function getcode_cardno($tablename,$tablepkey,$cond)
	{
		$num = 0;
		$num = $this->getvalfield($tablename,"max(card_no)","1=1");
		$num = sprintf("%'.06d\n", ++$num);
		return $num;		
	}
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	public function session_method($table,$username,$password)
	{		
		 $sql = "SELECT * from $table WHERE (mobile='$username' or username='$username') AND password='$password'";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row;
        
	}

	

	public function max_method($tbl_id,$date){
		$sql = "SELECT MAX(kotnumber) FROM kot_entry WHERE tbl_id=$tbl_id AND created_date = '$date'";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row['MAX(kotnumber)'];
	}	

	public function last_val($column1,$table,$column2){
		$sql = "SELECT $column1 FROM $table ORDER BY $column2 DESC LIMIT 1";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row['billnumber'];
	}


	public function gst_calculation($qty,$rate,$disc_per=0,$cgst,$sgst,$igst,$inc_or_exc='exclusive'){

        $total_value =  $qty * $rate;
        $disc_amt = $total_value * $disc_per/100;
        $taxable_value = $total_value - $disc_amt;

		if($inc_or_exc == 'exclusive')
		{
			if($sgst > 0)
			$sgst_amt = round(($taxable_value * $sgst/100),2);
			else
			$sgst_amt = 0;

			if($cgst > 0)
			$cgst_amt = round(($taxable_value * $cgst/100),2);
			else
			$cgst_amt = 0;

			if($igst > 0)
			$igst_amt = round(($taxable_value * $igst/100),2);
			else
			$igst_amt = 0;

			$final_price = $taxable_value + $sgst_amt + $cgst_amt + $igst_amt;

			$all_values = array('taxable_value'=>$taxable_value,'sgst_amt'=>$sgst_amt,'cgst_amt'=>$cgst_amt,'igst_amt'=>$igst_amt,'final_price'=>$final_price);
		}
		else
		{
			$final_price = $taxable_value;
			$taxable_value = round((100 * $final_price)/(100 + $sgst + $cgst + $igst),2);


			if($sgst > 0)
			$sgst_amt = round(($taxable_value * $sgst/100),2);
			else
			$sgst_amt = 0;

			if($cgst > 0)
			$cgst_amt = round(($taxable_value * $cgst/100),2);
			else
			$cgst_amt = 0;

			if($igst > 0)
			$igst_amt = round(($taxable_value * $igst/100),2);
			else
			$igst_amt = 0;


			$all_values = array('taxable_value'=>$taxable_value,'sgst_amt'=>$sgst_amt,'cgst_amt'=>$cgst_amt,'igst_amt'=>$igst_amt,'final_price'=>$final_price);


		}

		 return($all_values);
		// echo $all_values;
		
	}

	
	public function executequery($sql){
		$array = array();

		$query = mysqli_query($this->con,$sql);
		
		while ($row = mysqli_fetch_assoc($query))
        
		 {
			$array[] = $row;
		}
		return $array;

	}

	public function dbRowInsert($table_name, $form_data)
   {
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);

    // build the query
     $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";
	//echo $sql;
	//die;
    // run and return the query result resource
    return mysqli_query($this->con,$sql);
   // echo $sql;die;
    }

	public function insert_record($table, $fields)
	{
		//"INSERT INTO table_name ( , , ) VALUE ('', '')";
		$sql = "";
		$sql .= "INSERT INTO ".$table;
		$sql .= " (".implode(",", array_keys($fields)).") VALUE ";
		$sql .= "('".implode("','", array_values($fields))."')";
		$query = mysqli_query($this->con, $sql);

		// echo $sql;die;
		 
		if ($query) 
		{
			return 1;
			echo "<script>toastr.info('Delete feature will not work on demo project')</script>";
		}
	}
    public function sendsms_planet($message,$mobile)
{
	$xml_data ='<?xml version="1.0"?>
	<parent>
	<child>
	<user>planet</user>
	<key>e020062508XX</key>
	<mobile>'.$mobile.'</mobile>
	<message>'.$message.'</message>
	<accusage>1</accusage>
	<senderid>PLANET</senderid>
	</child>
	</parent>';
	
	$URL = "smsjust.com/sms/user/urllongsms.php"; 
	
				$ch = curl_init($URL);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
				curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$output = curl_exec($ch);
				curl_close($ch);
	
	return($output); 
}
    public function getcode_demand($tablename,$tablepkey,$cond)
	{
		$num =  $this->getvalfield($tablename,"max($tablepkey)",$cond);
		//if($num == NULL)
		//$num = 0;
	    ++$num; // add 1;
	    $len = strlen($num);
	    for($i=$len; $i< 10; ++$i) {
	        $num = '0'.$num;
	    }
	    return $num;
	}

	public function getcode($tablename,$tablepkey,$cond)
	{
		 $num =  $this->getvalfield($tablename,"max(billno)",$cond);
		//if($num == NULL)
		//$num = 0;
	    ++$num; // add 1;
	    $len = strlen($num);
	    for($i=$len; $i< 10; ++$i) {
	        $num = '0'.$num;
	    }
	    return $num;
	}

	public function getcodequotation($tablename,$tablepkey,$cond)
	{
		 $num =  $this->getvalfield($tablename,"max(quotation_no)",$cond);
		//if($num == NULL)
		//$num = 0;
	    ++$num; // add 1;
	    $len = strlen($num);
	    for($i=$len; $i< 10; ++$i) {
	        $num = '0'.$num;
	    }
	    return $num;
	}

	public function getcode_challan($tablename,$tablepkey,$cond)
	{
		$num =  $this->getvalfield($tablename,"max(billno)",$cond);
		//if($num == NULL)
		//$num = 0;
	    ++$num; // add 1;
	    $len = strlen($num);
	    for($i=$len; $i< 10; ++$i) {
	        $num = '0'.$num;
	    }
	    return $num;
	}


	public function get_overall_blls_amt($customer_id)
	{

		//opening balance
		//echo $customer_id; die;
		 $prev_balance = $this->getvalfield("master_customer","openingbal","customer_id='$customer_id'");
		//get all sale entry bill amt
		$sql_sale = "select * from purchaseentry where customer_id = '$customer_id' and type = 'saleentry'";
		$row_sale = $this->executequery($sql_sale);
		$total_sale = 0;
		
		if(sizeof($row_sale) > 0)
		{
			$sale_amt = 0;
			foreach ($row_sale as $saleinfo)
			{
				# code...

				$sale_amt = $this->getTotalPerchaseBillAmt1($saleinfo['purchaseid']);
				//$sale_amt = 0;
				$total_sale += $sale_amt; 
			}
		}//if close


		 $voucher_payment = $this->getvalfield("voucherentry","sum(paid_amt)","customer_id='$customer_id' and payment_type = 'Payment'");

		$overall_amt = $total_sale + $voucher_payment + $prev_balance;
		return($overall_amt);
		
	}

    public function getcode_bookingno($tablename,$tablepkey,$cond)
	{
		$num = $this->getvalfield($tablename,"max($tablepkey)","1=1");
		//if($num == NULL)
		//$num = 0;
		++$num; // add 1;
		$len = strlen($num);
		for($i=$len; $i< 5; ++$i) {
		$num = '0'.$num;
		}
		return $num;
	}


	public function get_product_total($product_id,$fromdate,$todate)
	{
		 $sql = "select A.*,  (qty * rate_amt) as totalamt, (((cgst + sgst + igst)/100) * (qty * rate_amt)) as gsttax_rs  from saleentry_details as A left join saleentry as B on A.saleid = B.saleid where sale_date between '$fromdate' and '$todate' and product_id='$product_id'";

		$query = mysqli_query($this->con, $sql);
		$total = 0;
		$nettotal = 0;
		$total_tax = 0;
		while($row = mysqli_fetch_assoc($query))
		{
		    $totalamt = $row['totalamt'];
			$gsttax_rs = $row['gsttax_rs'];


			//total value with tax
			$nettotal += ($totalamt + $gsttax_rs);

			
		}
		return $nettotal;

	}

	public function getcode_saleno($tablename,$tablepkey,$cond)
	{
		$num = 0;
		$sessionid = $this->getvalfield("m_session","sessionid","status=1");
		$company_id = $_SESSION['company_id'];
		$num = $this->getvalfield($tablename,"max(saleno)","company_id=$company_id and sessionid = $sessionid");
		$num = sprintf("%'.06d\n", ++$num);
		return $num;		
	}

	public function getcode_issueno($tablename,$tablepkey,$cond)
	{
		$sessionid = $this->getvalfield("m_session","sessionid","status=1");
	 	$company_id = $_SESSION['company_id'];
		 $num =  $this->getvalfield($tablename,"max(issueno)","company_id=$company_id and sessionid = $sessionid");
		//if($num == NULL)
		//$num = 0;
	    ++$num; // add 1;
	   
	    $len = strlen($num);
	    for($i=$len; $i< 6; ++$i) {
	        $num = '0'.$num;
	    }
	    return $num;
	}

	// public function getcode_issueno($tablename,$tablepkey,$cond)
	// {
	// 	$num = 0;
	// 	$sessionid = $this->getvalfield("m_session","sessionid","status=1");
	// 	$company_id = $_SESSION['company_id'];
	// 	$num = $this->getvalfield($tablename,"max(issueno)","company_id=$company_id and sessionid = $sessionid");
	// 	$num = sprintf("%'.06d\n", ++$num);
	// 	return $num;		
	// }

	public function getcode_jarbillno($tablename,$tablepkey,$cond)
	{
		$num = 0;
		$sessionid = $this->getvalfield("m_session","sessionid","status=1");
		$company_id = $_SESSION['company_id'];
		$num = $this->getvalfield($tablename,"max(jar_billno)","company_id=$company_id and sessionid = $sessionid");
		$num = sprintf("%'.06d\n", ++$num);
		return $num;		
	}

	function getvalMultiple($table,$field,$where)
	{
		$sql = "select $field from $table where $where";
		//echo $sql;
		$getvalue = mysqli_query($this->con, $sql);;
		while($row = mysqli_fetch_row($getvalue))
		{
			if($row[0]!="")
			$getval[] = $row[0];
		}
		return $getval;
	}

	public function getcode_voucher($tablename,$tablepkey,$cond)
	{
		$sessionid = $this->getvalfield("m_session","sessionid","status=1");
		$company_id = $_SESSION['company_id'];
		$num = $this->getvalfield($tablename,"max(voucher_no)","sessionid = '$sessionid' and company_id = '$company_id'");
		//if($num == NULL)
		//$num = 0;
		++$num; // add 1;
		$len = strlen($num);
		for($i=$len; $i< 5; ++$i) {
		$num = '0'.$num;
		}
		return $num;
	}

    public function insert_record_lastid($table, $fields)
	{
		//"INSERT INTO table_name ( , , ) VALUE ('', '')";
		$sql = "";
		$sql .= "INSERT INTO ".$table;
		$sql .= " (".implode(",", array_keys($fields)).") VALUE ";
		// echo $sql;die;
		$sql .= "('".implode("','", array_values($fields))."')";
		// echo $sql;die;
		$query = mysqli_query($this->con, $sql);
		 $keyvalue = mysqli_insert_id($this->con);
		if ($query) {
			return $keyvalue;
			//echo $query;die;
		}
	}
	
	public function insert_record_return_id($table, $fields)
	{
		//"INSERT INTO table_name ( , , ) VALUE ('', '')";
		$sql = "";
		$sql .= "INSERT INTO ".$table;
		$sql .= " (".implode(",", array_keys($fields)).") VALUE ";
		$sql .= "('".implode("','", array_values($fields))."')";
		$query = mysqli_query($this->con, $sql);
		$lastid = mysqli_insert_id($this->con);
		if ($query) {
			return $lastid;
		}
	}

	public function fetch_record($table)
	{
		$sql = "SELECT * FROM ".$table ;
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
	}
	

   public function opening_balance($customer_id,$lastdate)
   {
   	 
	//opening balance
	$openingbal = $this->getvalfield("master_customer","openingbal","customer_id = '$customer_id' and open_bal_date < '$lastdate'");

	//sum total bill of customer (monthly jar)
	$sql = "select sum(nettotal) as totalamt from monthly_jar_bill_details as A left join monthly_jar_bill As B on A.mjar_billid = B.mjar_billid where customer_id = '$customer_id' and jar_billdate < '$lastdate'";
	$res = $this->executequery($sql);
	$nettotal = 0;
	foreach($res as $row_get)
	{
		$nettotal += $row_get['totalamt'];
	}


	//sum total bill of customer (sale entry jar)
	$sql_sale = "select qty, rate_amt, disc, cgst, sgst, igst from saleentry_details as A left join saleentry As B on A.saleid = B.saleid where customer_id = '$customer_id' and sale_date < '$lastdate'";
	$res_sale = $this->executequery($sql_sale);
	$net_sale_total = 0;
	foreach($res_sale as $row_sale)
	{
		$qty = $row_sale['qty'];
		$rate_amt = $row_sale['rate_amt'];
		$cgst = $row_sale['cgst'];
		$sgst = $row_sale['sgst'];
		$igst = $row_sale['igst'];

		$total_amt = $qty * $rate_amt;
		if($total_amt > 0)
		{
			if($cgst > 0)
			{
				$cgst_amt = $total_amt * $cgst/100;
			}
			if($sgst > 0)
			{
				$sgst_amt = $total_amt * $sgst/100;
			}

			$net_amt = $total_amt + $cgst_amt + $sgst_amt;
		}

	 	$net_sale_total += $net_amt;
	}


	$total_payment = $this->getvalfield("voucherentry","amount","customer_id = '$customer_id' and vdate < '$lastdate' and paymt_id=3");

	$prev_balance = $openingbal + $nettotal + $net_sale_total - $total_payment;


	return $prev_balance; 
   }


	public function fetch_record_desc_condition($table,$where,$field)
	{
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition." ORDER BY ".$field." DESC";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
		
		
		// $sql = "SELECT * FROM ".$table." ORDER BY $field DESC LIMIT 10";
		// $array = array();
		// $query = mysqli_query($this->con,$sql);
		// while ($row = mysqli_fetch_assoc($query)) {
			// $array[] = $row;
		// }
		// return $array;
	}

	public function fetch_record_desc($table,$field)
	{
		$sql = "SELECT * FROM ".$table." ORDER BY $field DESC LIMIT 10";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
	}
	
	function getvalfield($tablename,$column,$condition)
	{
		$sql = "select $column  from $tablename where $condition";
        //echo $sql;  
		$res = mysqli_query($this->con,$sql);
		if(mysqli_num_rows($res) > 0)
		{
			$row = mysqli_fetch_assoc($res);
			//print_r($row);
		 	return $row[$column];
		}
		else
			return "";
	}
	
	function dateformatindia($date)
	{
		if($date != "")
		{
			$ndate = explode("-",$date);
			$year = $ndate[0];
			$day = $ndate[2];
			$month = $ndate[1];
			
			if($date == "0000-00-00" || $date =="")
			return "";
			else
		    return $day . "-" . $month . "-" . $year;
		}
		else
			return "";
		
	}

	
function dateDiffInDays($date1, $date2)  
{ 
    // Calulating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
} 




	function dateformatusa($date)
	{
		if($date != "")
		{
			$ndate = explode("-",$date);
			$year = $ndate[2];
			$day = $ndate[0];
			$month = $ndate[1];
			return $year . "-" . $month . "-" . $day;
		}
		else
			return "";
	}

	public function select_record($table,$where)
	{
		// id = '5' AND m_name = 'something'
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		//echo $sql; die;
		$row = mysqli_fetch_assoc($query);
		return $row;
          
	}
	

   public function InsertLog($pagename, $module, $submodule, $tablename, $tablekey, $keyvalue, $action)
{
  
	 $sessionid = $_SESSION['sessionid'];
	$userid = $_SESSION['userid'];
	$usertype = $_SESSION['usertype'];
	$activitydatetime  = date('Y-m-d H:m:s');
	
	 $sqlquery = "insert into activitylogreport(userid, usertype, module, submodule, pagename, primarykeyid ,tablename, activitydatetime, action,sessionid) values('$userid', '$usertype', '$module', '$submodule',  '$pagename', '$keyvalue','$tablename', '$activitydatetime', '$action','$sessionid')";
	//echo $sqlquery;die;
	mysqli_query($this->con,$sqlquery);
}
	public function select_record2($table,$where)
	{
		// id = '5' AND m_name = 'something'
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		//echo $query; die;
		while($row = mysqli_fetch_assoc($query))
		{
			$row1[]= $row;	
		}
		return $row1;
	}

	public function select_data($table,$where)
	{
		// id = '5' AND m_name = 'something'
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
        // echo $sql;die;
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
	}
	
	
	public function select_crit($table,$field,$method,$date1,$date2){
		$sql="SELECT * FROM $table WHERE $field $method '$date1' AND '$date2'";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
	}
	
	
	public function select_data_orderby($table,$where,$orderby)
	{
		// id = '5' AND m_name = 'something'
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition." order by ".$orderby;
//		echo $sql;
		//die;
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
	}
	
	public function select_data_condition_orderby($table,$field,$val,$orderby)
	{
		$sql="";
		$sql .= "SELECT * FROM ".$table." WHERE ".$field."  != ".$val." ORDER BY ".$orderby." DESC ";
		//echo $sql ;die;
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
		$array[] = $row;
		}
		return $array;
        
	}

	public function count_method($table,$where)
	{
		// id = '5' AND m_name = 'something'
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows($query);
           //echo $count ;die;
		return $count;
	}
    

	public function count_method2($table)
	{
		$sql = "SELECT * FROM ".$table;
		$query = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows($query);
		return $count;
	}

	
	
	public function check_duplicate($table,$fields,$where)
	{
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT ".$fields." FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		$duplicate = mysqli_num_rows($query);
          // echo $count ;die;
		return $sql;


	}

	public function check_duplicatep($table_name,$where)
{
	 $sqledit = mysqli_query($this->con,"SET NAMES utf8");
	//echo "select * from $table_name where $where";die;
	$sql = "select * from $table_name where $where";
	$res = mysqli_query($this->con,$sql);
	$cnt = mysqli_num_rows($res);
	return $cnt;
}
	public function update_record($table,$where,$fields)
	{
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			// id = 5 AND m_name = 'something'
			$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		foreach ($fields as $key => $value) {
			// UPDATE table SET m_name = '', qty = '' WHERE id = '';
			$sql .= $key . "='".$value."', ";
		}
		$sql = substr($sql, 0, -2);
	    $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
    	//echo $sql;die;
		if (mysqli_query($this->con,$sql))
		{
			return mysqli_insert_id($this->con);
			
		}
	}
	
	public function delete_record($table, $where){
		$sql = '';
		$condition = '';
		foreach ($where as $key => $value) {
		$condition .= $key . "='" . $value ."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql = "DELETE FROM ".$table." WHERE ".$condition;
		//echo $sql; die;
		if (mysqli_query($this->con, $sql)) {
			return mysqli_insert_id($this->con);
		}
	} 


	function add3dots($string, $repl, $limit) 
{
  if(strlen($string) > $limit) 
  {
    return substr($string, 0, $limit) . $repl; 
  }
  else 
  {
    return $string;
  }
}
	public function checkmenu($mudule_setting,$loginid)
	{
	
	$sql=mysqli_query($this->con,"SELECT B.* FROM privilage_setting AS A LEFT JOIN m_userprivilege AS B ON A.page_id = B.page_id where B.menuname='$mudule_setting' and A.userid='$loginid'");	
	$numrows=mysqli_num_rows($sql);
	
	return $numrows;	
	}

	public function check_menuname($location,$loginid)
	{
	
	$sql=mysqli_query($this->con,"select * from privilage_setting as A left join m_userprivilege as B on A.page_id = B.page_id  where A.userid='$loginid' && B.pagelink='$location'");
	$numrows=mysqli_num_rows($sql);		
	
	return $numrows;	
	}




function getTotalPerchaseBillAmt($id)
{
	
	$rate_amt = 0;
	$amount=0;
	$totgst=0;
	$totalamount=0;
	$totsgst=0;
	$totigst=0;
 
	$sql = mysqli_query($this->con,"Select * from purchasentry_detail where purchaseid = '$id'");
	if($sql )
	{
       
		
		while($row = mysqli_fetch_array($sql))
		{
            $total = 0;
			$qty = $row['qty'];
			$rate_amt = $row['rate_amt'];
			$cgst=$row['cgst'];
			$sgst=$row['sgst'];
			$igst=$row['igst'];
            $total =	$qty * $rate_amt;
		    $totalc = ($total * $cgst)/100;
			$totals= ($total * $sgst)/100;
			$totali= ($total * $igst)/100;
			
		    $amount += $total;
			$totgst += $totalc;
			$totigst += $totali;
			$totsgst += $totals;
			$totalgst = $totgst + $totsgst + $totigst;
			$totalamount = $amount + $totalgst;
		}
	}
	
	
	return $totalamount;
   
}

function getTotalPerchaseBillAmt1($id)
{
	
	$rate_amt = 0;
	$amount=0;
	$totgst=0;
	$totalamount=0;
	$totsgst=0;
	$totigst=0;
 
	$sql = mysqli_query($this->con,"Select * from purchasentry_detail where purchaseid = '$id' and sale_pur_type = 'sale'");
	if($sql )
	{
       
		
		while($row = mysqli_fetch_array($sql))
		{
            $total = 0;
            //$purchaseid = $row['purchaseid'];
			$qty = $row['qty'];
			$rate_amt = $row['rate_amt'];
			$cgst=$row['cgst'];
			$sgst=$row['sgst'];
			$igst=$row['igst'];
			$cgst_amt=$row['cgst_amt'];
			$sgst_amt=$row['sgst_amt'];
			$igst_amt=$row['igst_amt'];
			//$net_amount = $obj->getvalfield("purchaseentry","net_amount","purchaseid='$purchaseid'");
			$taxable_value=$row['taxable_value'];
			
		    $amount += $taxable_value;
			$totgst += $cgst_amt;
			$totigst += $igst_amt;
			$totsgst += $sgst_amt;
		    $totalgst = $totgst + $totsgst + $totigst;
			$totalamount = $amount + $totalgst;
		}
	}
	
	
	return $totalamount;
   
}



function getTotalSaleentryBillAmt($id)
{
	
	$rate_amt = 0;
	$amount=0;
	$totgst=0;
	$totalamount=0;
	$totsgst=0;
	$totigst=0;
 
	$sql = mysqli_query($this->con,"Select * from saleentry_details where saleid = '$id'");
	if($sql )
	{
       
		
		while($row = mysqli_fetch_array($sql))
		{
            $total = 0;
			$qty = $row['qty'];
			$rate_amt = $row['rate_amt'];
			$cgst=$row['cgst'];
			$sgst=$row['sgst'];
			$igst=$row['igst'];
            $total = $qty * $rate_amt;
		    $totalc = ($total * $cgst)/100;
			$totals= ($total * $sgst)/100;
			$totali= ($total * $igst)/100;
			
		    $amount += $total;
			$totgst += $totalc;
			$totigst += $totali;
			$totsgst += $totals;
			$totalgst = $totgst + $totsgst + $totigst;
			$totalamount = $amount + $totalgst;
		}
	}
	
	
	return $totalamount;
   
}

function getTotalBookingBillAmt($id)
{
	
	$rate_amt = 0;
	$amount=0;
	$totgst=0;
	$totalamount=0;
	$totsgst=0;
	$totigst=0;
 
	$sql = mysqli_query($this->con,"Select * from booking_order_detail where booking_order_id = '$id'");
	if($sql )
	{
       
		
		while($row = mysqli_fetch_array($sql))
		{
            $total = 0;
			$qty = $row['qty'];
			$rate_amt = $row['rate_amt'];
			$cgst=$row['cgst'];
			$sgst=$row['sgst'];
			$igst=$row['igst'];
            $total =	$qty * $rate_amt;
		    $totalc = ($total * $cgst)/100;
			$totals= ($total * $sgst)/100;
			$totali= ($total * $igst)/100;
			
		    $amount += $total;
			$totgst += $totalc;
			$totigst += $totali;
			$totsgst += $totals;
			$totalgst = $totgst + $totsgst + $totigst;
			$totalamount = $amount + $totalgst;
		}
	}
	
	return $totalamount;
}


function getTotalMonthlyJarBillAmt($id)
{
	
 	$totalamount = 0;
	$sql = mysqli_query($this->con,"Select * from monthly_jar_bill_details where mjar_billid = '$id'");
	if($sql)
	{
		while($row = mysqli_fetch_array($sql))
		{
			$totalamount += $row['nettotal'];
		}
	}
	return $totalamount;
}

function convert_image($fname,$path,$wid,$hei)
{
    $wid = intval($wid); 
    $hei = intval($hei); 
    //$fname = $sname;
    $sname = "$path$fname";
    //echo $sname;
    //header('Content-type: image/jpeg,image/gif,image/png');
    //image size
    list($width, $height) = getimagesize($sname);
    
    if($hei == "")
    {
        if($width < $wid)
        {
            $wid = $width;
            $hei = $height;
        }
        else
        {
            $percent = $wid/$width;  
            $wid = $wid;
            $hei = round ($height * $percent);
        }
    }
    
    //$wid=469;
    //$hei=290;
    $thumb = imagecreatetruecolor($wid,$hei);
    //image type
    $type=exif_imagetype($sname);
    //check image type
    switch($type)
    {
    case 2:
    $source = imagecreatefromjpeg($sname);
    break;
    case 3:
    $source = imagecreatefrompng($sname);
    break;
    case 1:
    $source = imagecreatefromgif($sname);
    break;
    }
    // Resize
    imagecopyresized($thumb, $source, 0, 0, 0, 0,$wid,$hei, $width, $height);
    //echo "converted";
    //else
    //echo "not converted";
    // source filename
    $file = basename($sname);
    //destiantion file path
    //$path="uploaded/flashgallery/";
    $dname=$path.$fname;
    //display on browser
    //imagejpeg($thumb);
    //store into file path
    imagejpeg($thumb,$dname);
}

function get_client_ip() 
{
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress; 
}

function test_input($data) 
{
  $data = trim($data);
  $data = addslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function check_editBtn($location,$loginid)
{
	
	$sql=mysqli_query($this->con,"select * from privilage_setting as A left join m_userprivilege as B on A.page_id = B.page_id  where A.userid='$loginid' && B.pagelink='$location'");
	$rowedit=mysqli_fetch_array($sql);				
	return $rowedit['pagedit'];	
}

function check_delBtn($location,$loginid)
{
	
	$sql=mysqli_query($this->con,"select * from privilage_setting as A left join m_userprivilege as B on A.page_id = B.page_id  where A.userid='$loginid' && B.pagelink='$location'");
	$rowedit=mysqli_fetch_array($sql);				
	return $rowedit['pagedel'];	
}

function check_pageview($location,$loginid)
{
	
	$sql=mysqli_query($this->con,"select * from privilage_setting as A left join m_userprivilege as B on A.page_id = B.page_id  where A.userid='$loginid' && B.pagelink='$location'");
	$rowedit=mysqli_fetch_array($sql);				
	return $rowedit['pageview'];	
}

function sendsmsGET($username,$pass,$senderid,$message,$serverUrl,$mobile)
{
//    echo $authKey; die;
//username=beyondcg&pass=welcome@123&senderid=BEYOND&message=Testt&dest_mobileno=9179432534&response=Y
    $getData = 'username='.$username.'&pass='.$pass.'&senderid='.$senderid.'&message='.urlencode($message).'&dest_mobileno='.$mobile.'&response=Y';

    //API URL
        $url="http://".$serverUrl."?".$getData; 

     

    // init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0

    ));

    //get response
    $output = curl_exec($ch);  
    
    //Print error if any
      
    if(curl_errno($ch))
    {
       // echo 'error:' . curl_error($ch);
    }

    curl_close($ch);

    return 1;
}

	function selectMultiple($table,$where)
	{
	$table = "SELECT * FROM `$table` WHERE product_id=1 and ratefrmplant=ratefrmplant";	
	}


	function get_opening_stock($product_id,$from_date)
	{

		//opening stock form product master
		 $opening_stock_master = $this->getvalfield("m_product","opening_stock","product_id = '$product_id' and stock_date <= '$from_date'");
		//count purchaseentry
		$sale_ret = 0;
        $sale = 0;
        $purchase_ret = 0;
        $purchase = 0;
        $purchasequery = "select qty, sale_pur_type, ret_qty from purchasentry_detail left join purchaseentry on  purchasentry_detail.purchaseid = purchaseentry.purchaseid 
        where product_id = '$product_id' and purchaseentry.bill_date < '$from_date'";
           $res = $this->executequery($purchasequery);
           foreach($res as $row_get)
           {
           	  $sale_pur_type = $row_get['sale_pur_type'];
              if($sale_pur_type == 'purchase')
              {
                $purchase += (float)$row_get['qty'];
                $purchase_ret += (float)$row_get['ret_qty'];
              }
             
              if($sale_pur_type == 'sale')
              {
                $sale += (float)$row_get['qty'];
                $sale_ret += (float)$row_get['ret_qty'];
              }
           }


           // issue and return
           $issue = 0;
           $issue_ret = 0;
           $sql_issue = "select sum(qty) as issue, sum(ret_qty) as issue_ret from issue_entry_details left join issue_entry on  issue_entry_details.issueid = issue_entry.issueid 
        where product_id = '$product_id' and issue_entry.issuedate < '$from_date'";
           $res1 = $this->executequery($sql_issue);
           foreach($res1 as $row_get1)
           {
              
                $issue = (float)$row_get1['issue'];
                $issue_ret = (float)$row_get1['issue_ret'];
           }

		

		 $open_stock = $opening_stock_master + $purchase - $purchase_ret - $sale + $sale_ret - $issue + $issue_ret;
		return $open_stock;
	}

}



$obj = new DataOperation;


?>