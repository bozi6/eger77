<!DOCTYPE html>
<html lang="hu">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url('/assets/bootstrap/css/bootstrap.css'); ?>">
	<?php
	if ($nyelv == 'ar') {
		echo '<link rel="stylesheet" href="' . base_url('/css/bootstrap-rtl.css') . '">';
	}
	?>
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url('/assets/jquery-ui/themes/base/jquery-ui.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/sajat.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/font-awesome/css/all.css'); ?>">
	<link rel="stylesheet" media="screen" type="text/css"
		  href="<?php echo base_url('/assets/tablesorter/css/theme.metro-dark.min.css'); ?>">
	<link rel="stylesheet" media="print" type="text/css" href="<?php echo base_url('/css/media.css'); ?>">
	<title>
		<?= lang("Kezd.kezdTitle", [], $nyelv); ?>
	</title>
</head>
<body class="bg-info text-light rtl">
