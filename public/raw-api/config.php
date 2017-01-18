<?php

$db_host="localhost";                                           //连接的服务器地址
$db_user="root";                                                  //连接数据库的用户名
$db_psw="1234321";                                                  //连接数据库的密码
$db_name="spider";


function extractParam($name, $defaultValue){
	
	
	if(is_array($_GET)&&count($_GET)>0)//判断是否有Get参数 
	{ 
		if(isset($_GET[$name]))//判断所需要的参数是否存在，isset用来检测变量是否设置，返回true or false 
		{ 
			$para=$_GET[$name];//存在 
		}else{
			return $defaultValue;
		}
	}else{
		return $defaultValue;
	}
}