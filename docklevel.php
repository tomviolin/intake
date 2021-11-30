<html>
<head>
<title>Water Intake Monitoring</title>
<script language="Javascript">
<? if ($_REQUEST['timescale'] >= 2) {
	echo "regraphInterval = 600;\n";
} else {
	echo "regraphInterval = 60;\n";
}
   	$span[1] = "48 hours";
	$span[2] = "7 days";
	$span[3] = "1 month";
	echo "timeScale = '" . $span[$_REQUEST['timescale']] . "';\n";
?>

</script>
</head>
<body>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
   <td valign=middle><b><font size=+1>City Water Intake</font></b></td>
   <td width=10></td>
   <td valign=middle><?

	for ($i = 1; $i <= 3; ++$i) {
		if ($_REQUEST['timescale'] == $i || ($_REQUEST['timescale'] == "" && $i == 1)) {
			echo "<b>[".$span[$i]."]</b> ";
			$curspan = $span[$i];
		} else {
			echo "<a href=\"?timescale=".urlencode($i)."\">[".$span[$i]."]</a> ";
		}
	}
   ?></td></tr></table>
<? for ($i=1;$i<=3;++$i) { ?>
<img id="graph<?=$i?>" src="sensgraph.php?sensor=<?=$i?>&time=<?=time()?>&interval=<?=urlencode($span[$_REQUEST['timescale']])?>" width=700 height=200><br>
<p>
<? } ?>

<script language="Javascript">
doingRegraph = false;

function regraph() {
	x = new Date();
	if (!doingRegraph && x.getSeconds() % regraphInterval == 0) {
		doingRegraph = true;
		for (i = 1; i <= 3; ++i) {
			document.getElementById("graph"+i).src="sensgraph.php?sensor="+i+"&time="+x.valueOf()+"&interval="+escape(timeScale);
		}
	}
	if (x.getSeconds() % regraphInterval != 0) {
		doingRegraph = false;
	}
}
setInterval("regraph()", 500);
</script>

</body>
</html>
