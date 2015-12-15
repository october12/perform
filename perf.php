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
echo "{\"latency\":[".current($latency).",".next($latency)."]}";
}else if($_SERVER['REQUEST_METHOD']=="POST"){
exec("sudo sh WEB-INF/redo_unc.sh");
}
//echo "</p2>"
//echo "latency:[" + .latency[0] +", \""+ 
//echo $latency;
//echo "return   ".$retval[0];
?>
