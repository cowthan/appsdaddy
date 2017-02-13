
@extends('layouts.master')

@section('title', '任务管理')


@section('content')
    <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              任务管理&nbsp;&nbsp;&nbsp;&nbsp;
                              <a href="http://114.215.81.196:8080/towers1122334/tower/excel?sid={{$sid}}" target="_blank"><button type="button" class="btn btn-primary">添加管理员</button></a>
                          </header>
                          <table class="table table-striped border-top" id="sample_1">
                          <thead>
                          <tr>
                              <th>序号</th>
                              <th class="hidden-phone">姓名</th>
                              <th class="hidden-phone">发电机型号</th>
                              <th class="hidden-phone">站点</th>
                              <th class="hidden-phone">运营商</th>
                              <th class="hidden-phone">发电时间</th>
                              <th class="hidden-phone">开始</th>
                              <th class="hidden-phone">结束</th>
                              <th class="hidden-phone">操作</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ($tasks as $task)
                              <tr class="odd gradeX" style="cursor:pointer;" onclick="openPhoto('{{$task->id}}');">
                                  <td>{{$task->id}}</td>
                                  <td>{{$task->owner}}</td>
                                  <td>{{$task->motorType}}</td>
                                  <td>{{$task->stateName}}</td>
                                  <td>{{$task->gongsi}}</td>
                                  <td>{{ $task->status2 }}</td>
                                  <td >{!! date("Y-m-d H:i:s", $task->startTime) !!}</td>
                                  <td>{!! $task->endInfo2 !!}</td>
                                  <td>
                                      <button type="button" class="btn btn-danger" onclick="deleteById('{{$task->id}}');">删除</button>
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                          </table>
                      </section>
                  </div>
              </div>
@endsection

@section('script')


    <script type="text/javascript" src="{{ URL::asset('/') }}/assets/towers/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/') }}/assets/towers/assets/data-tables/DT_bootstrap.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/dynamic-table.js"></script>

    <script>

      $(document).ready(function(){

      });

      function openPhoto(taskId){
            layer.open({
              type: 2,
              title: "任务详情-" + taskId,
              area: ['630px', '560px'],
              shade: 0.8,
              closeBtn: true,
              shadeClose: true,
              content: 'task_info.html?id=' + taskId //http://player.youku.com/embed/XMjY3MzgzODg0
          });
        }

      function deleteById(id){
          console.log('{{$sid}}');
          console.log(id);
          layer.confirm('你确定要删除吗？',
                  {icon: 3},
                  function(index){
                      ///确认的回调
                      layer.close(index);
                      $.get('deleteTask', {
                          "taskId": id,
                          "sid": '{{$sid}}'
                      }, function(data, status) {
                          var res = data; //JSON.parse(data);
                          console.log(res);
                          if(status === "success"){
                              if(res.code == 0){
                                  layer.msg("成功了！");
                                  location.reload();
                              }else{
                                  layer.alert("失败--" + res.message);
                              }
                          }else{
                              layer.alert("失败--" + status);
                          }
                      });
                  },
                  function(index){
                      ///取消的回调
                      layer.close(index);
                  }
          );

      }


  </script>
@endsection