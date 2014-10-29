<?php
$myUrl = $_SERVER['REQUEST_URI'];
$backUrl = $myUrl . 'back/public/';
$wpUrl = $myUrl . 'wp/';
$psUrl = $myUrl . 'ps/';
$ucUrl = $myUrl . 'uc/';
?><!doctype html>
<html>
<head>
	<title>Demo</title>
	<link rel="stylesheet" href="<?=$backUrl ?>packages/semantic/css/semantic.min.css" />
	<script src="<?=$backUrl ?>packages/jquery/jquery.js"></script>
	<script src="<?=$backUrl ?>packages/semantic/js/semantic.min.js"></script>
</head>
<body>
	<div class="ui grid">
		<div class="row">
			<a class="ui red inverted button" href="<?=$backUrl ?>">
				<i class="settings icon"></i>
				Service
			</a>
		</div>
		<div class="row">
			<div class="ui buttons">
				<a class="ui fluid teal button" href="<?=$wpUrl ?>">
					<i class="angle right icon"></i>
					Wordpress
				</a>
				<a class="ui fluid green button" href="<?=$psUrl ?>">
					<i class="angle right icon"></i>
					PrestaShop
				</a>
				<a class="ui fluid blue button" href="<?=$ucUrl ?>">
					<i class="angle right icon"></i>
					UCommerce
				</a>
			</div>
		</div>
	</div>
</body>
</html>