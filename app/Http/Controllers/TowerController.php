<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Excel;

class TowerController extends Controller{



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
	
	
    public function listTasks(Request $request){
		$sid = $request->input('sid');
		$bywho = $request->has('bywho') ? $request->input('bywho') : 'user';
		$pageNow = $request->input('pageNow');
		$pageSize = $request->input('pageSize');

		if(empty($sid)){
			$result_arr = array(
					'code'=>'1',
					'msg'=>'未登录',
					'result' => "{}"
			);
			return response()->json($result_arr);
		}

		$pageNow = $request->input('pageNow');
		$offset = ($pageNow) * $pageSize;

		$tasks = array();
		if($bywho == "admin"){
			$tasks = DB::table('task')->orderBy('id','desc')->skip($offset)->take($pageSize)->get();
		}else{
			$tasks = DB::table('task')->where("sid", "=", $sid)->orderBy('id','desc')->skip($offset)->take($pageSize)->get();
		}

		$result_arr = array(
				'code'=>'0',
				'msg'=>'ok',
				'result' => $tasks
				);

    	//return response(json_encode($result_arr));
		return response()->json($result_arr);
		
    }

	public function addTask(Request $request){
		$sid = $request->input('sid');
		$taskId = $request->input('taskId');
		$gongsi = $request->input('gongsi');
		$stateName = $request->input('stateName');

		$city = $request->input('city');
		$lat = $request->input('lat');
		$lnt = $request->input('lnt');
		$addr = $request->input('addr');

		$motorType = $request->input('motorType');
		$photo = $request->input('photo');

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
			$taskId = DB::table('task')->insertGetId([
					'sid'=>$sid,
					'gongsi'=>$gongsi,
					'stateName'=>$stateName,
					'startTime'=>time() + "",
					'endTime'=>"0",
					'city' => $city,
					'addr' => $addr,
					'lat' => $lat,
					'lnt' => $lnt,
					'motorType' => $motorType,
					'thumbStart' => $photo,
					'thumbEnd' => "",

				]);
			$result_arr = array(
					'code'=>'0',
					'msg'=>'ok',
					'result'=>array(
							'taskId'=>$taskId
					)
			);

		}else{
			//update--结束
			DB::table('task')->where('id','=', $taskId)->update([
					'endTime'=>time() + "",
					'city2' => $city,
					'addr2' => $addr,
					'lat2' => $lat,
					'lnt2' => $lnt,
					'thumbEnd' => $photo,
			]);
			$result_arr = array(
					'code'=>'0',
					'msg'=>'ok',
					'result'=>array(
							'taskId'=>$taskId
					)
			);
		}

		return response()->json($result_arr);
	}

	public function deleteTask(Request $request){
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
			DB::table('task')->where('id','=', $taskId)->delete();
			$result_arr = array(
					'code'=>'0',
					'msg'=>'ok',
					'result'=>array()
			);
		}

		return response()->json($result_arr);
	}

	public function excel(Request $request){
		$sid = $request->input('sid');
		$result_arr = array();

		if(empty($sid)){
			$result_arr = array(
					'code'=>'1',
					'msg'=>'未登录，sid为空'
			);
			return response("未登录");
		}

		$cellData = [
				['学号','姓名','成绩'],
				['10001','AAAAA','99'],
				['10002','BBBBB','92'],
				['10003','CCCCC','95'],
				['10004','DDDDD','89'],
				['10005','EEEEE','96'],
		];
		Excel::create('学生成绩',function($excel) use ($cellData){
			$excel->sheet('score', function($sheet) use ($cellData){
				$sheet->rows($cellData);
			});
		})->export('xls');

	}


}

?>