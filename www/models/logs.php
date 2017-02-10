<?php 
function logs($act=null,$log=null,$detail=null){
	if(isset($_REQUEST['act'])&&!empty($_REQUEST['act'])){
		$act=$_REQUEST['act'];
	}
	if(isset($_REQUEST['log'])&&!empty($_REQUEST['log'])){
		$log=$_REQUEST['log'];
	}
	if(isset($_REQUEST['detail'])&&!empty($_REQUEST['detail'])){
		$detail=$_REQUEST['detail'];
	}
	
	if($act && $log){
		$logPath = '/var/log/';
		$validPath = $logPath.$log;
		$isZipped = (pathinfo($validPath, PATHINFO_EXTENSION) == 'gz');
		if($detail) $detail = escapeshellarg($detail);
		
		if ($log == "kernel") {
			if (file_exists($validPath)) {
				exec("dmesg >> \"". $validPath ."\"");
			} else {
				exec("dmesg > \"". $validPath ."\"");
			}
		}
		
		if (file_exists($validPath) && filesize($validPath)) {
			switch ($act) {
				case 'all':
					if ($isZipped){
						return passthru("gunzip -c $validPath");
					}else{
						return readfile($validPath);
					}
					break;
				case 'head':
				case 'tail':
					$detail = '-n '. $detail;
				case 'grep':
					//return preg_replace('#(\r\n?|\n)#', '<br>$1', passthru( $isZipped ? "gunzip -c $validPath | $act $detail" : "$act $detail $validPath" ));
					return '<pre>'.shell_exec( $isZipped ? "gunzip -c $validPath | $act $detail" : "$act $detail $validPath" ).'</pre>';
					break;
				case 'download':
					$pathToFile = "/configs/log/" . $log;
					if (file_exists("/configs/log/")) {
						copy($validPath, $pathToFile);
					} else {
						mkdir("/configs/log", 0700);
						copy($validPath, $pathToFile);
					}
					return $pathToFile;
					break;
				default:
					return "No log file was found.";
					break;
			}
		}
		
		
	}else{
		return 'Enter correct data';
	}
}
?>