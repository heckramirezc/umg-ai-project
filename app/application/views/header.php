<!DOCTYPE html>
<html lang="es-GT" <?php echo implode(' ', array_map(function($prop, $value) {
			return $prop.'="'.$value.'"';
		}, array_keys($page_html_prop), $page_html_prop)) ;?>>
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> <?php echo $page_title != "" ? $page_title." - " : ""; ?>@UMG_Bot_AI </title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">	
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>font-awesome.min.css">		
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>smartadmin-skins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>smartadmin-skins.min.css">				
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>smartadmin-rtl.min.css">
		<?php

			if ($page_css) {
				foreach ($page_css as $css) {
					echo '<link rel="stylesheet" type="text/css" media="screen" href="'.CSS.$css.'">';
				}
			}
		?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS; ?>demo.min.css">		
		<link rel="shortcut icon" href="<?php echo IMG; ?>favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo IMG; ?>favicon/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">			
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo JS; ?>libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo JS; ?>libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>
	</head>
	<body <?php echo implode(' ', array_map(function($prop, $value) {
			return $prop.'="'.$value.'"';
		}, array_keys($page_body_prop), $page_body_prop)) ;?>>
		<?php
			if (!$no_main_header) {
		?>				
		<div id="shortcut">
			<ul>
				<li>
					<a href="<?php echo URL; ?>">Información de @UMG_Bot_AI - Plataforma Twitter </span> </span> </a>
				</li>
			</ul>
		</div>				

		<?php
			}
		?>