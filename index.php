<?php

//see http://twitter.github.com/bootstrap/base-css.html#icons
$buttonConfig=array(
	'power-off'=>array('cmd'=>"/sbin/shutdown -h now",'icon'=>'off'),
	'shutdown30'=>array('cmd'=>'su -c "nohup shutdown -h +30 & "','label'=>'30'),
	'volume-up'=>array('cmd'=>"/usr/bin/mpc volume +5",'icon'=>'volume-up'),
	'volume-down'=>array('cmd'=>"/usr/bin/mpc volume -5",'icon'=>'volume-down'),
	'forward'=>array('cmd'=>"/usr/bin/mpc next",'icon'=>'fast-forward'),
	'backward'=>array('cmd'=>"/usr/bin/mpc prev",'icon'=>'fast-backward'),
	'stop'=>array('cmd'=>"/usr/bin/mpc stop",'icon'=>'stop'),
	'play'=>array('cmd'=>"/usr/bin/mpc play",'icon'=>'play'),
	'delete'=>array('cmd'=>"/home/pi/delete_current.sh",'icon'=>'trash'),
	'info'=>array('cmd'=>"/usr/bin/mpc",'icon'=>'info-sign'),
	'reboot'=>array('cmd'=>"/sbin/reboot",'icon'=>'refresh'),
	'favorite'=>array('cmd'=>"/home/pi/fav_current.sh",'icon'=>'heart'),
);

function createButton($configName){
	global $buttonConfig;
	if(isset($buttonConfig[$configName])){
		$_conf=$buttonConfig[$configName];
		return(sprintf('<a class="btn btn-info" title="%s" onclick="return doSendCMD(\'%s\');">%s</a>',
			$configName,$configName,isset($_conf['label']) ?$_conf['label']: sprintf('<i class="icon-%s"></i>',$_conf['icon'])));
	}	
}

if(isset($_REQUEST['button']) && !empty($_REQUEST['button']) ){
	$cmd=trim($_REQUEST['button']);
	if(isset($buttonConfig[$cmd])){
			echo system(escapeshellcmd($buttonConfig[$cmd]['cmd']));
	}
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link media="screen" rel="stylesheet" type="text/css" href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap.min.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://www.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>
	<style>
		body {
			padding-top: 15px; 
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2"><?=  createButton('volume-up'); ?></div>
		<div class="span10"></div>
	</div>
	<div class="row-fluid">
		<div class="span2"><?=  createButton('backward'); ?></div>
		<div class="span2"><?=  createButton('stop'); ?></div>
		<div class="span2"><?=  createButton('play'); ?></div>
		<div class="span2"><?=  createButton('forward'); ?></div>
		<div class="span2"><?=  createButton('info'); ?></div>
		<div class="span2"><?=  createButton('favorite'); ?></div>
	</div>
	<div class="row-fluid">
		<div class="span2"><?=  createButton('volume-down'); ?></div>
		<div class="span10"></div>
		</div>
	<div class="row-fluid"><div class="span12"></div></div>                 
	<div class="row-fluid">
		<div class="span3"><?=  createButton('power-off'); ?></div>
		<div class="span3"><?=  createButton('delete'); ?></div>
		<div class="span3"><?=  createButton('reboot'); ?></div>
		<div class="span3"><!-- <?=  createButton('shutdown30'); ?>--></div>
	</div>
	<div class="row-fluid"><div class="span12"></div></div>
	<div class="row-fluid"><div class="span12 alert alert-success" id="console"></div></div>
</div>
<script>
function doSendCMD(button) {
	$.post("/",{button: button},	function(data) {
		$('#console').html(data.replace(/([^>\r\n]?)(\n)/g, '$1' + '<br />' + '$2'));
	});
}
</script>
</body>
</html>
</pre>
