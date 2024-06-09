<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?= base_url()?>/public/assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url()?>/public/assets/css/bootstrap-icons.css" rel="stylesheet">

    <link href="<?= base_url()?>/public/assets/css/all.min.css" rel="stylesheet">

    <link href="<?= base_url()?>/public/assets/css/fontawesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url()?>/public/assets/css/swiper-bundle.min.css">

    <link href="<?= base_url()?>/public/assets/css/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url()?>/public/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/public/assets/css/jquery.fancybox.min.css">

    <link href="<?= base_url()?>/public/assets/css/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url()?>/public/assets/css/preloader.css">
    <link rel="stylesheet" href="<?= base_url()?>/public/assets/css/style2.css">

    <title>Quantum Brize</title>
    <link rel="icon" href="<?= base_url()?>/public/assets/img/sm-logo.svg" type="image/gif" sizes="20x20">

	

	<?php
	if (!empty($header_asset_link)) {
		foreach ($header_asset_link as $link) {
			echo "<link href='" . base_url() . 'public/' . $link . "' rel='stylesheet' type='text/css'>";
		}
	}

	if (!empty($header_link)) {
		foreach ($header_link as $link) {
			require_once ('css/' . $link);
		}
	}
	?>
	<style>
		body {
			overflow-x: hidden;
		}
	</style>
</head>