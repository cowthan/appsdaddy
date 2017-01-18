<?php  
header("content-Type: text/html; charset=utf-8");//字符编码设置  

require_once("./config.php");

$page = extractParam("page", 1);
$count = extractParam("count", 30);

$skip = ($page-1) * $count;
$sql = "select * from top order by createAt desc limit {$skip},50;";
  
// 创建连接  
$conn =new mysqli($db_host, $db_user, $db_psw, $db_name);  
// 检测连接  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  
  

$result = $conn->query($sql);  
  
$arr = array();  
// 输出每行数据  
while($row = $result->fetch_assoc()) {  
    $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小  
    for($i=0;$i<$count;$i++){  
        unset($row[$i]);//删除冗余数据  
    }  
    array_push($arr,$row);  
  
}  
//print_r($arr);  
echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码  
$conn->close();  
  
?>  