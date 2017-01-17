<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Excel;

class PageController extends Controller{

	public function pageLogin(Request $request){
		return view('towers.login');
	}

	public function pageIndex(Request $request){

		$sid = $request->input('sid');
		if(empty($sid)){
			return redirect('user/login.html');
		}

		$userCount = 0;
		$adminCount = 0;
		$taskCount = 0;
		$todayTaskCount = 0;

		$userCount = DB::table('users')->count();
		$adminCount = DB::table('admins')->count();
		$taskCount = DB::table('task')->count();
		//$todayTaskCount = DB::table(task)->count();

		return view('towers.index', [
				'userCount' => $userCount,
				'adminCount' => $adminCount,
				'taskCount' => $taskCount,
				'todayTaskCount' => $todayTaskCount,
				'sid' => $sid
		]);
	}

	public function pageAdminMgmr(Request $request){

		$sid = $request->input('sid');
		if(empty($sid)){
			return redirect('user/login.html');
		}

		$admins = DB::table('admins')->orderBy('id','asc')->get();

		return view('towers.admin_mgmr', [
				'admins' => $admins,
				'sid' => $sid
		]);
	}

	public function pageTaskMgmr(Request $request){

		$sid = $request->input('sid');
		if(empty($sid)){
			return redirect('user/login.html');
		}

		$tasks = DB::table('task')->orderBy('id','desc')->get();

		//插入姓名，时长，开始信息，结束信息
		foreach($tasks as $task){
			$task->owner = DB::table("users")->where("sid", "=", $task->sid)->pluck('realname');

			if($task->endTime == "0"){
				$task->status2 = "尚未结束";
			}else{
				$task->status2 = $this->time2second($task->endTime - $task->startTime);
				//echo $task->status2;
			}

			$task->startInfo2 = "开始时间:" . date("Y-m-d H:i:s", $task->startTime) . "<br/>"
						. "结束时间:" . date("Y-m-d H:i:s", $task->endTime) . "<br/>";

			if($task->endTime == "0"){
				$task->endInfo2 = "尚未结束";
			}else{
				$task->endInfo2 = date("Y-m-d H:i:s", $task->endTime);
				//echo $task->status2;
			}
			

			$task->addrInfo = "发点开始：<br/>" . "经度：" . $task->lnt . "<br/>维度: " . $task->lat
				. "<br/>地址：" . $task->addr
				. "<br/>发点结束：<br/>" . "经度：" . $task->lnt2 . "<br/>维度: " . $task->lat2
				. "<br/>地址：" . $task->addr2;
			// $task->startInfo = html_entity_decode($task->startInfo);
			
		}

		return view('towers.task_mgmr', [
				'tasks' => $tasks,
				'sid' => $sid
		]);

	}

	public function pageUserMgmr(Request $request){
		$sid = $request->input('sid');
		if(empty($sid)){
			return redirect('user/login.html');
		}

		$users = DB::table('users')->orderBy('id','asc')->get();

		return view('towers.user_mgmr', [
				'users' => $users,
				'sid' => $sid
		]);
	}

	public function pageAddAdmin(Request $request){
		$sid = $request->input('sid');
		if(empty($sid)){
			return redirect('user/login.html');
		}

		return view('towers.add_new_admin', ['sid' => $sid]);
	}

	public function pageAddUser(Request $request){
		return view('towers.add_new_user');
	}

	public function taskInfo(Request $request){
		$taskId = $request->input('id');
		

		$task = DB::table('task')->where("id", "=", $taskId)->first();
		if($task->endTime == "0"){
			$task->status2 = "尚未结束";
		}else{
			$task->status2 = '发电时间：' . $this->time2second($task->endTime - $task->startTime);
			//echo $task->status2;
		}

		return view('towers.task_info', [
				'task' => $task
		]);
	}


    public function pageList(Request $request){

		$bywho = $request->has('bywho') ? $request->input('bywho') : 'user';
		$sid = $request->input('sid');

		$sid = $request->input('sid');

		if(empty($sid)){
			return redirect('user/login.html');
		}

		$pageSize = 9;
		$pageNow = 0;

		$totalNum = 0;
		if($bywho == "admin"){
			$totalNum = DB::table('task')->count();
		}else{
			$totalNum = DB::table('task')->where("sid", "=", $sid)->count();
		}

		$left = $totalNum % $pageSize;
		$pageCount = ($totalNum - $left) / $pageSize;
		if($left == 0){

		}else{
			$pageCount += 1;
		}

		return view('tower.list',
				['pageSize' => $pageSize,
					'pageNow' => $pageNow,
					'totalNum' => $totalNum,
					'pageCount' => $pageCount
				]);
    }
	


    public function time2second($seconds){
		$seconds = (int)$seconds;

		//$seconds = 30;
		//$seconds = 10000;
		//echo $seconds . "---";
		$time = "0";
		if($seconds < 60){   //小于1分钟，显示秒
			$time = $seconds . "秒";
		}else if($seconds < 60 * 60){  //小于1小时，显示分秒
			$s = ($seconds % 60);// . "秒";
			$m = ($seconds - $s) / 60;
			$time = $m . "分" . $s . "秒";
		}else if($seconds < 60 * 60 * 24){ //小于1天，显示时分秒
			$remain = ($seconds % 3600);
			//echo $remain;
			$h = ($seconds - $remain) / (60 * 60);
			$time = $h . "小时" . $this->time2second($remain);

		}

		return $time;
	}


	
	
}

?>