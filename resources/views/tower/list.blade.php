<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    	<base href="<%=basePath%>">
        <title>铁塔发电统计平台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Styles -->
        <!-- Bootstrap CSS -->
        <link href="{{ URL::asset('/') }}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font awesome CSS -->
        <link href="{{ URL::asset('/') }}/assets//font-awesome/font-awesome.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ URL::asset('/') }}/assets/app/css/style.css" rel="stylesheet">
    	
    	<!-- 图片上传 -->

		<style type="text/css">

       #title{
           width:100%;
           height: 100px;
           background-color: #369;
           color: white;
           text-align: center;
           line-height: 100px;
       }
    </style>
    <link rel="stylesheet" href="<%=basePath %>resources/react_qiniu/base-min.css" />

    	<!-- 图片上传：结束 -->
		
</head>
<body>
<!-- ================================body================================== -->
<div class="container-fluid" style="margin:0; padding:0;">
	<div class="row">
		<div class="col-md-12">
            <h1 id="title">铁塔发电统计平台</h1>
			<p class="text-center"><a id="excel" href="http://114.215.81.196:8080/towers1122334/tower/excel?sid={5B149230-C8BF-7924-0150-6171E3715089}" + >导出excel</a></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">
		</div>

		<div class="col-md-10">
			<div class="row">
				<!-- 图片列表和分页 -->
				<br/>
				<div class="col-md-12">
					<table class="table table-bordered table-hover table-condensed" >
						<tbody id="photo_container">
							<!-- <tr>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
							</tr>
							<tr>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
							</tr>
							<tr>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
								<td>
									<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-thumbnail" />
								</td>
							</tr> -->
						</tbody>
					</table>
				</div>

				<!-- 图片列表和分页：结束 -->
			</div>
		</div>
			<!-- 图片上传：react，结束 -->
		<div class="col-md-1">
		</div>
	</div>
</div>

<!-- ================================body================================== -->
<!-- Javascript files -->
<!-- jQuery -->
    <script src="{{ URL::asset('/') }}/assets/jquery/jquery.js"></script>
    <script src="{{ URL::asset('/') }}/assets/jquery/html5shiv.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ URL::asset('/') }}/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/') }}/assets/layer/layer.js"></script>
    <script src="{{ URL::asset('/') }}/assets/layer/extend/layer.ext.js"></script>

    <script src="{{ URL::asset('/') }}/assets/app/js/sbutils.js"></script>
    <script>
        var currentBucket = null;
        var currentAK, currentSK;
        var currentPage = 0;
        var currentPageIndicator;

        $(document).ready(function() {

//            $excel = $("#excel");
//            $excel.attr("href", "excel?sid=" + GetQueryString("sid"));

            $(".page_indicator").click(function(){
                var pageNow = $(this).text();
                if(pageNow === "Prev"){
                    pageNow = currentPage - 1;
                    if(pageNow < 0){
                        return false;
                    }
                }else if(pageNow === "Next"){
                    pageNow = currentPage + 1;
//			if(pageNow > 100){
//				return;
//			}
                }else{
                    pageNow = parseInt(pageNow) - 1;
                }
                loadImages(pageNow);
                currentPage = pageNow;
                var lastPageIndicator = currentPageIndicator;
                currentPageIndicator = $("#page_count_" + (currentPage+1));

                //---样式
                if(lastPageIndicator){
                    lastPageIndicator.css({
                        "color":"#337ab7",
                        "background­color":"#fff"
                    });
                }
                currentPageIndicator.css({
                    "color":"#994422",
                    "background­color":"#449922"
                });
                ///----

                return false;
            });
            ///默认分页的样式：color:#337ab7;text-decoration:none;background-color:#fff
            ///当前的样式：
            loadImages(0);
        });

        function loadImages(pageNow){
            currentPage = pageNow;
            $.get('listTask', {
                "pageNow": pageNow,
                "sid": GetQueryString("sid")
            }, function(data, status) {
                var res = data; //JSON.parse(data);
                if(status === "success"){
                    //layer.msg("成功了！");
                    //alert(res.result);
                    console.log(res.result);
                    fillPhotos(res.result);
                }else{
                    layer.alert("失败--" + res.message);
                }
            });
        }

        function onPageClick(pageNow){
            loadImages(pageNow);
            return false;
        }

        function fillPhotos(files){
            ///logger(JSON.stringify(files));
            var html = "";
            for (var i = 0; i < files.length; i++) {

                html += "<tr id=row_{id}>";
                html = html.replace("{id}", files[i].id);

                //任务基本信息 td
                html += "<td width='300px'>";
                html += '<p><span>{taskName}</span><br/><br/><span>{name}</span><br/><br/>发电时间：{range}</p>';
                html += "</td>";
                html = html.replace("{taskName}", "任务-" + files[i].id);
                html = html.replace("{name}", "" + files[i].sid);

                var rangeMilli = 0;
                var range = "";
                if(files[i].endTime == "0"){
                    range = "尚未结束";
                }else{
                    range = MillisecondToDate(files[i].endTime - files[i].startTime);
                }

                html = html.replace("{range}", range);

                //任务详细信息 td
                html += "<td width='300px'>{info}</td>";
                var content = "运营商：" + files[i].gongsi
                                + "<br />站点：" + files[i].stateName
                                + "<br />发电机型号：" + files[i].motorType
                                + "<br />开始时间：" + files[i].startTime
                                + "<br />结束时间：" + files[i].endTime
                        ;
                html = html.replace("{info}", content);

                //开始信息 td
                html += "<td width='300px'>";
                html += ''
                        +'<img style="width:150px;height:150px;" src="{thumbUrl}" class="img-thumbnail" onclick="openPhoto(\'{wholeUrl}\');" />'
                        + '<br/>'
                        +'<p>{content}</p>'
                        + "<br/>"
                    //+ "<input type='button' value='delete' class=\"btn btn-warning\" onclick='deleteById(\"{ddddid}\");'>"
                ;
                var content = "开始时间：" + files[i].startTime
                                + "<br />经度：" + files[i].lnt
                                + "<br />纬度：" + files[i].lat
                                + "<br />省市：" + files[i].city
                                + "<br />详细地址：" + files[i].addr;
                html += "</td>";
                html = html.replace("{thumbUrl}", files[i].thumbStart);
                html = html.replace("{wholeUrl}", files[i].thumbStart);
                html = html.replace("{content}", content);
                html = html.replace("{ddddid}", files[i].id);



                //结束信息 td
                if(files[i].endTime != "0"){
                    html += "<td width='300px'>";
                    html += ''
                            +'<img style="width:150px;height:150px;" src="{thumbUrl}" class="img-thumbnail" onclick="openPhoto(\'{wholeUrl}\');" />'
                            + '<br/>'
                            +'<p>{content}</p>'
                            + "<br/>"
                        //+ "<input type='button' value='delete' class=\"btn btn-warning\" onclick='deleteById(\"{ddddid}\");'>"
                    ;
                    var content = "结束时间：" + files[i].endTime
                            + "<br />经度：" + files[i].lnt
                            + "<br />纬度：" + files[i].lat
                            + "<br />省市：" + files[i].city
                            + "<br />详细地址：" + files[i].addr;
                    html += "</td>";
                    html = html.replace("{thumbUrl}", files[i].thumbEnd);
                    html = html.replace("{wholeUrl}", files[i].thumbEnd);
                    html = html.replace("{content}", content);
                    html = html.replace("{ddddid}", files[i].id);


                }else{
                    html += "<td width='300px'>尚未结束</td>";
                }

                //操作 td
                html += '<td><button type="button" class="btn btn-danger" onclick="deleteById(\'{id}\');">删除</button></td>';

                html = html.replace("{id}", files[i].id);

                html += "</tr>";

                //var url = files[i].thumb;
                //var url = files[i].thumb;




            }
            $("#photo_container").empty();
            $(html).appendTo($("#photo_container"));


        }

        function openPhoto(url){
            var img = '<img src="{wholeUrl}"  />';
            img = img.replace("{wholeUrl}", url);
            layer.open({
                type: 2,
                title: url,
                area: ['800px', '600px'],
                shade: 0.8,
                closeBtn: true,
                shadeClose: true,
                content: url
            });
        }

        function deleteById(id){

            layer.confirm('你确定要删除吗？',
                    {icon: 3},
                    function(index){
                        ///确认的回调
                        layer.close(index);
                        $.get('deleteTask', {
                            "taskId": id,
                            "sid": GetQueryString("sid")
                        }, function(data, status) {
                            var res = data; //JSON.parse(data);
                            if(status === "success"){
                                layer.msg("成功了！");
                                //location.reload();
                                loadImages(0);
                            }else{
                                layer.alert("失败--" + res.message);
                            }
                        });
                    },
                    function(index){
                        ///取消的回调
                        layer.close(index);
                    }
            );

        }


        function MillisecondToDate(msd) {
            msd = msd * 1000;
            var time = parseFloat(msd) / 1000;
            if (null != time && "" != time) {
                if (time > 60 && time < 60 * 60) {
                    time = parseInt(time / 60.0) + "分钟" + parseInt((parseFloat(time / 60.0) -
                                    parseInt(time / 60.0)) * 60) + "秒";
                }
                else if (time >= 60 * 60 && time < 60 * 60 * 24) {
                    time = parseInt(time / 3600.0) + "小时" + parseInt((parseFloat(time / 3600.0) -
                                    parseInt(time / 3600.0)) * 60) + "分钟" +
                            parseInt((parseFloat((parseFloat(time / 3600.0) - parseInt(time / 3600.0)) * 60) -
                                    parseInt((parseFloat(time / 3600.0) - parseInt(time / 3600.0)) * 60)) * 60) + "秒";
                }
                else {
                    time = parseInt(time) + "秒";
                }
            }
            return time;
        }



        function GetQueryString(name)
        {
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r!=null)return  unescape(r[2]); return null;
        }
    </script>



</body>
</html>
