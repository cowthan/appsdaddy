<?php
header("content-Type: text/html; charset=utf-8");

require_once("./config.php");

$page = extractParam("page", 1);
$county = extractParam("count", 30);

$skip = ($page-1) * $county;
$sql = "select * from top order by createAt desc limit {$skip}, 4;";
//

$mysqli=new mysqli();
$mysqli->connect($db_host, $db_user, $db_psw, $db_name);

if(mysqli_connect_errno()){ //检查是否可以正确打开数据库
	echo "<font color='red'>unable to connect to database!</font>";
	exit;
}

/////
$result=$mysqli->query($sql);
$arr = array();
if ($result){
	 if($result->num_rows>0){
	 	//echo json_encode($arr);
	 	while($row = $result->fetch_assoc()){ 
			$r = array();
			
			/*
			$r["title"] = $row[1];
			$r["coverImages"] = $row[2];
			$r["shortIntro"] = $row[3];
			$r["readCount"] = $row[4];
			$r["createAt"] = $row[5];
			$r["topUrl"] = $row[6];
			$r["authorName"] = $row[7];
			$r["authorUrl"] = $row[8];
			$r["authorHeadImg"] = $row[9];
			
			*/
			
			$r["title"] = $row["title"];
			$r["coverImages"] = $row["coverImages"];
			$r["shortIntro"] = $row["shortIntro"];
			$r["readCount"] = $row["readCount"];
			$r["createAt"] = $row["createAt"];
			$r["topUrl"] = $row["topUrl"];
			$r["authorName"] = $row["authorName"];
			$r["authorUrl"] = $row["authorUrl"];
			$r["authorHeadImg"] = $row["authorHeadImg"];
			echo $row["createAt"] . "---"  . $r["title"] .  "<br/>";
	        //$arr[] = $r; 
			array_push($arr, $r);
			//echo  . "<br/>---------<br/>";
        }
		
		//echo "dd";
		
		//print_r($arr);
		
		echo json_encode($arr);
		//echo "--dd2";
	 }else{
	 	
		echo json_encode($arr, JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_NUMERIC_CHECK, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES, JSON_FORCE_OBJECT, JSON_UNESCAPED_UNICODE);
	 }
	
}else{
	echo "error in query: $sql " . $mysqli->error;
	exit;
}


$result->close();
$mysqli->close(); //关闭数据库连接


?>