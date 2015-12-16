<?php
/*	if(!empty($_GET))
		print("it's get<br/>");
	if(empty($_POST))
		echo "it's post<br>";
	if($_SERVER['REQUEST_METHOD']=='GET')
		echo "yeah, server works<br>";
	if($_SERVER['REQUEST_METHOD']=="POST")
		echo "now, post<br>";
*/
//echo "<p2>";
//echo passthru("ls");
//echo "<br>";
if($_SERVER['REQUEST_METHOD']=="GET"){
	$str = shell_exec("sudo sh WEB-INF/unc_read.sh");
	$latency = explode("\n",$str);
	$str = shell_exec("sh WEB-INF/mem.sh");
	$mem = explode(" ",$str);
	echo "{\"latency\":[".current($latency).",".next($latency).",".current($mem).",".next($mem)."]}";
}else if($_SERVER['REQUEST_METHOD']=="POST"){
	if(!empty($_POST['sid']))
		exec("sudo sh WEB-INF/setup_unc.sh");
	else if(!empty($_POST['clear'])){
		//exec("sudo sh WEB-INF/redo_unc.sh");
		exec("sudo sh WEN-INF/clear_bench.sh ".$_POST['clear']);
	}
}
//echo "</p2>"
//echo "latency:[" + .latency[0] +", \""+ 
//echo $latency;
//echo "return   ".$retval[0];
?>
