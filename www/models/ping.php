<?php 
function ping($pingAddress=null,$pingCount=4,$pingSize=56){
	if(isset($_REQUEST['pingAddress'])&&!empty($_REQUEST['pingAddress'])){
		$pingAddress=$_REQUEST['pingAddress'];
	}
	if(isset($_REQUEST['pingCount'])&&!empty($_REQUEST['pingCount'])){
		$pingCount=$_REQUEST['pingCount'];
	}
	if(isset($_REQUEST['pingSize'])&&!empty($_REQUEST['pingSize'])){
		$pingSize=$_REQUEST['pingSize'];
	}
	
	// Check pingCount since we're going to put it into the command line
	if($pingAddress){
		exec("ping $pingAddress -c $pingCount -s $pingSize ", $output);
		
		$datalines = preg_filter("/^([0-9]*).*: seq=([0-9]*) ttl=([0-9]*) time=([0-9]*.[0-9]* ms)/","$1,$2,$3,$4", $output);

		$dataResult = array();
		
		foreach($datalines as $dl){
			$dl = explode(",", $dl);
			array_push($dataResult,array('bytes' => $dl[0],'count' => $dl[1],'ttl' => $dl[2],'time' => $dl[3]));
		}
		$info = array_shift(preg_filter("/^([0-9]+) packets transmitted, ([0-9]+) packets received, ([0-9]+)% packet loss$/","$1,$2,$3",$output));
		$statistics = array_shift(preg_filter("/^round-trip min\/avg\/max = ([.0-9]+)\/([.0-9]+)\/(.*)$/","$1,$2,$3",$output));
		$out = array(
				'pingResults' => $dataResult,
				'pingInfo' => $info,
				'pingStatistics' => $statistics
		);
		
		echo json_encode($out,JSON_PRETTY_PRINT);
		
	}else{
		echo 'Enter ping address';
	}
	
}
?>