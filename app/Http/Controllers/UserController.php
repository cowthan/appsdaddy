<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller{



    public function pageLogin(){
		return view('user.login', ['name' => 'seven']);
    }
	
	
	public function login(Request $request){
		$username = $request->input('username');
		$password = $request->input('password');

		$result_arr = array();

		if(empty($username) || empty($password)){
			$result_arr = array(
					'code'=>'2',
					'msg'=>'所有字段不能为空'
			);
		}else{
			$users = DB::table('users')->where("username", "=", $username)->get();
			if(count($users) == 0){
				$result_arr = array(
						'code'=>'1',
						'msg'=>'用户不存在',
						'result' => "{}"
				);
			}else{
				$user = $users[0];
				if($user->password != $password){
					$result_arr = array(
							'code'=>'2',
							'msg'=>'密码错误',
							'result' => "{}"
					);
				}else{
					$result_arr = array(
							'code'=>'0',
							'msg'=>'ok',
							'result'=>array(
									'username'=>$user->username,
									'realname'=>$user->realname,
									'company'=>$user->company,
									'sid'=>$user->sid
							)
					);
				}

			}
		}
		return response()->json($result_arr);
	}

    public function regist(Request $request){

    	$username = $request->input('username');
    	$password = $request->input('password');
		$company = $request->input('company');
		$realname = $request->input('realname');

		$result_arr = array();

		if(empty($username) || empty($password) || empty($company) || empty($realname)){
			$result_arr = array(
					'code'=>'2',
					'msg'=>'所有字段不能为空'
			);
		}else{
			$userCount = DB::table('users')->where("username", "=", $username)->count();
			if($userCount > 0){
				//用户名重复
				$result_arr = array(
						'code'=>'1',
						'msg'=>'用户名重复--'.$username
				);
			}else{
				$sid = $this->guid();
				DB::table('users')->insert([
						'username'=>$username,
						'password'=>$password,
						'company'=>$company,
						'realname'=>$realname,
						'sid' => $sid
				]);
				$result_arr = array(
						'code'=>'0',
						'msg'=>'ok',
						'result'=>array(
								'sid'=>$sid
						)
				);
			}
		}

    	//return response(json_encode($result_arr));
		return response()->json($result_arr);
		
    }


	public function delete(Request $request){
		$sid = $request->input('sid');
		$taskId = $request->input('taskId');
		$bywho = $request->input('bywho');

		$result_arr = array();

		if(empty($sid)){
			$result_arr = array(
					'code'=>'1',
					'msg'=>'未登录，sid为空'
			);
			return response()->json($result_arr);
		}

		if(empty($taskId)){
			//新建
			$result_arr = array(
					'code'=>'1',
					'msg'=>'必须指定要删除的id'
			);
			return response()->json($result_arr);

		}else{
			//update--结束
			DB::table('users')->where('id','=', $taskId)->delete();
			$result_arr = array(
					'code'=>'0',
					'msg'=>'ok',
					'result'=>array()
			);
		}

		return response()->json($result_arr);
	}

	function guid(){
		if (function_exists('com_create_guid')){
			return com_create_guid();
		}else{
			mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$hyphen = chr(45);// "-"
			$uuid = chr(123)// "{"
					.substr($charid, 0, 8).$hyphen
					.substr($charid, 8, 4).$hyphen
					.substr($charid,12, 4).$hyphen
					.substr($charid,16, 4).$hyphen
					.substr($charid,20,12)
					.chr(125);// "}"
			return $uuid;
		}
	}
}

?>