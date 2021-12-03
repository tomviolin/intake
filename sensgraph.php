<?php
	require_once('ereg.php');
	require_once('./SensorMonitor.php');
	// the -0 trick ensures that a number is passed, no trickery!
	$sensor = new SensorMonitor($_GET['sensor']-0, 'waterdata.glwi.uwm.edu', 'monitoru', 'sens56mon');
	$sensor->ShowGraph($_REQUEST['interval']);
?>
