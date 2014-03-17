<html>
<head>
	<link href="/css/bootstrap-3.1.0.min.css" rel="stylesheet" />
	<style>
	a {
		font-size: 20px;
	}
	</style>
</head>
<body>

	<div class="container">
		<header>
			<h2>Local Hoster</h2>
			<hr />
			<a href="etc-hosts.php" class="btn btn-primary bt-lg">Hosts</a>
			<a href="add-host.php" class="btn btn-warning bt-lg">Add Host</a>
			<a href="add-config.php" class="btn btn-default bt-lg">Add Config</a>
		</header>
		<hr />
		<?php include( $content ) ?>
		<hr />
		<footer>
			<sub>Local Hoster 2014</sub>
		</footer>
		<hr />
	</div>

</body>
</html>
