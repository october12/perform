<!Doctype html><html xmlns=http://www.3c.org/1999/xhtml>
<head><meta http-equiv=Content-Type content="text/html;charset=utf-8"/><meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1"/><meta content=always name=referrer/>
<title>内存策略性能展示</title>
<link rel="shortcut icon" href="images/logo.png" type="image/png"/>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"/>
<style type="text/css">
.novision{
	display:none;
}
#chart2{
	float: left;
	padding:1px;
}
#chart1{
	float: left;
	padding:1px;
}
</style>
<script src="js/jquery-2.1.4.js" type="text/javascript"></script>
<script src="js/Chart.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
    $(document).ready(function(){ 
    	$(".tablesorter").tablesorter();
    });
</script>
</head>
<body>
<?php 
$flag = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
	if($_POST["bench1"] != '0'){
		switch($_POST["bench1"]){
                        case '1': $param="1.milc";$milc=1; break;
                        case '2': $param="2.milc";$milc=2; break;
                        case '3': $param="3.milc";$milc=3; break;
                        case '4': $param="4.milc";$milc=4; break;
                        case '5': $param="5.milc";$milc=5; break;
                        case '6': $param="6.milc";$milc=6; break;
                        case '7': $param="7.milc";$milc=7; break;
                        case '8': $param="8.milc";$milc=8; break;
                }
		$flag = $flag . '1';
	}
	if($_POST["bench2"] != '0'){
                switch($_POST["bench2"]){
                        case '1': $param .=" 1.blic"; $blic=1;break;
                        case '2': $param .=" 2.astar"; break;
                        case '3': $param .=" 3.astar"; break;
                        case '4': $param .=" 4.astar"; break;
                        case '5': $param .=" 5.astar"; break;
                        case '6': $param .=" 6.astar"; break;
                        case '7': $param .=" 7.astar"; break;
                        case '8': $param .=" 8.astar"; break;
                }
		$flag = $flag . "2";
	}

}
?>
<header id="header">
	<hgroup>
		<h1 class="site_title">Performance Exhibition</h1>
		<h2 class="section_title"></h2><div class="btn_view_site"></div>
	</hgroup>
</header>
<section id="main" class="column">
<h4 class="alert_info">Welcome to the free MediaLoot admin panel template, this could be an informative message.</h4>
<div id="err_info" class="novision">
<h4 class="alert_error">The Chosen Benchmarks Are Too Many, 8 At Most!</h4>
</div>
<article class="module width_full">
<header><h3>Memory-Intense Access Bencmarks</h3></header>
<div style="display" class="module_content">
	<form id="benchform" name="benchform" action="show.php" method="post">
		<table cellspacing="0" class="tablesorter" border="0">
			<thead>
				<tr>
					<th>Name</th>
					<th>Astar</th>
					<th>Malic</th>
					<th>Bench3</th>
					<th>Bench4</th>
					<th>Bench5</th>
					<th colspan="2"><input type="submit" value="Clear" onclick="clearBench()"/></th>
				</tr>
			</thead>
			<tbody>
			<tr id="benchs">
			<td>Choice</td>
			<td><select name="bench1" class="choice">
				<?php for($i=0; $i<9; $i++){if($i==$milc)echo "<option value='".$i."' selected='selected'>".$i."</option>";
                   		else echo "<option value='".$i."'>".$i."</option>";}?>
			</td>
			<td><select name="bench2" class="choice">
				<?php for($i=0; $i<9; $i++){if($i==$milc)echo "<option value='".$i."' selected='selected'>".$i."</option>";
                        	else echo "<option value='".$i."'>".$i."</option>";}?>
			</td>
			<td><select name="bench3" class="choice">
				<?php for($i=0; $i<9; $i++){if($i==$milc)echo "<option value='".$i."' selected='selected'>".$i."</option>";
                        	else echo "<option value='".$i."'>".$i."</option>";}?>
			</td>
			<td><select name="bench4" class="choice">
				<?php for($i=0; $i<9; $i++){if($i==$milc)echo "<option value='".$i."' selected='selected'>".$i."</option>";
                        	else echo "<option value='".$i."'>".$i."</option>";}?>
			</td>
			<td><select name="bench5" class="choice">
				<?php for($i=0; $i<9; $i++){if($i==$milc)echo "<option value='".$i."' selected='selected'>".$i."</option>";
                        	else echo "<option value='".$i."'>".$i."</option>";}?>
			</td>
			<td><input type="submit" class="alt_btn" name="launch" value="Launch" onclick="return chooseBench()"/></td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
</article>
<div class="clear"></div>

<article class="module width_full">
<header><h3>Performance evaluation </h3></header>
<div style="display" class="module_content">
<fieldset style="width:48%; float:left; margin-right:3%;" >
	<label>access latency</label>
	<canvas id="chart1" style="height:90%; width:90%"></canvas>
</fieldset>
<fieldset style="width:48%; float:left;">
	<label>memory usage</label>
	<canvas id="chart2" style="height:90%; width:90%"></canvas>
</fieldset>
<div class="clear"></div>
</div>
<footer>
	<label>&nbsp;&nbsp;&nbsp;&nbsp; Refresh Rate</label>
	<select name="refresh" onchange="setRate(this)" style="width:5%">
		<option vaule="0">0</option>
		<option vaule="1">1</option>
		<option vaule="2" selected="selected">2</option>
		<option vaule="3">3</option>
	</select>
</footer>
</article>
</section>
<input type="hidden" id='flag' value="<?php echo $flag;?>"/>
</body>
</html>
<script type="text/javascript">
var update = null;
var chart1, chart2;
var skt0 = [null,null,null,null,null,null,null];
var skt1 = [null,null,null,null,null,null,null];
var mem0 = [null,null,null,null,null,null,null];
var mem1 = [null,null,null,null,null,null,null];
var times = 0;
var num = 7;

function stopUpdate(){
	clearInterval(update);
}
function setRate(obj){
	stopUpdate();
	if(obj.value != 0) {update = setInterval(updateData, obj.value*1000);}
}
function updateData(){
	$.ajax({
		url: "perf.php",
		type:"GET",
		dataType:"json",
		success: function (data, textStatus){
			times=times%num;
			skt0[times] = data.latency[0];
			skt1[times] = data.latency[1];
			mem0[times] = data.latency[2];
			mem1[times] = data.latency[3];
			for(var j=times, i=0; i<num; i++,--j){
				if(skt0[(j+num)%num] == null) break;
				chart1.datasets[0].points[i].value = skt0[(j+num)%num];
				chart1.datasets[1].points[i].value = skt1[(j+num)%num];
				chart2.datasets[0].points[i].value = mem0[(j+num)%num];
				chart2.datasets[1].points[i].value = mem1[(j+num)%num];
			}
			chart1.update();
			chart2.update();
			times++;
		},
		error: function (request, texts, error){
			console.log(request.toString()+" status " + texts+ " err " + error);
		}
	});
}
$(document).ready(function(){
	var data = {
    labels: ["1", "2", "3", "4", "5", "6", "7"],
    datasets: [
        {
            label: "First dataset",
            fillColor: "rgba(255,255,255,0.2)",
            strokeColor: "rgba(0,255,0,1)",
            pointColor: "rgba(0,255,0,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(0,255,0,1)",
	    data:[null,null,null,null,null,null,null]
        },
        {
            label: "Second dataset",
            fillColor: "rgba(255,255,255,0.2)",
            strokeColor: "rgba(255,0,0,1)",
            pointColor: "rgba(255,0,0,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(255,0,0,1)",
	    data:[null,null,null,null,null,null,null]
        }
    ]
};
	Chart.defaults.global.animation=false;
	Chart.defaults.global.scaleOverride = true;
	Chart.defaults.global.scaleSteps = 10;
	Chart.defaults.global.scaleStepWidth = 40;
	Chart.defaults.global.scaleStartValue = 0;
	var options = {scaleGridLineWidth: 1,
		scaleGridLineColor: "rgba(0,0,0,0.1)"	
	};
	var ctx = document.getElementById("chart1").getContext("2d");
	chart1 = new Chart(ctx).Line(data, options);
	Chart.defaults.global.scaleSteps = 10;
	Chart.defaults.global.scaleStepWidth = 1;
	ctx = document.getElementById("chart2").getContext("2d");
	chart2 = new Chart(ctx).Line(data, options);
//	update = setInterval(updateData, 2000);
});
function clearBench(){
/*	var param = '';
	$('select.choice').each(function(){
		if($(this).val()!=0)
			param += $(this).attr('name')[5];	
	});*/
	if($('#flag').val()!=''){
	$.ajax({url:"perf.php",
		type:"POST",
		data:{clear:$('#flag').val()},
		dataType:"json"
	});
	$('#flag').val('');
	}
	$('select.choice').each(function(){$(this).val(0)});
}
/*window.onbeforeunload=clearBench;
window.onload = function(){
	var xmlhttp = null;
	try{
		xmlhttp = new XMLHttpRequest();
	}catch(e){
		try{xmlhttp = new ActiveXObeject("Msxml2.XMLHTTP");
		}catch(e){
		xmlhttp = new ActiveXObeject("Microsoft.XMLHTTP");
		}
	}
	if(xmlhttp == null){
		alert('Browser does not support HTTP request');
		return;
	}
	var url = "perf.php"
	url = url + "?sid=" + Math.random();
	xmlhttp.open("POST", "perf.php", true);
	xmlhttp.send(null);
}
*/
function chooseBench(){
	var count = 0;
	var benchs = $('#benchs').children();
	for(var i=1;i<benchs.length-1;i++)
		count += parseInt(benchs[i].children[0].value);
	if(count > 8){
		$('#err_info').addClass('active').show();
		return false;
	}else return true;
}	
</script>
