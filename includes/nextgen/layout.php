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
			<a href="project-domains.php" class="btn btn-primary bt-lg">Project Domains</a>
			<a href="projects.php" class="btn btn-info bt-lg">Projects</a>
			<a href="projects.php?id=add" class="btn btn-warning bt-lg">Add Project</a>
			<a href="project-import.php" class="btn btn-default bt-lg">Project Import</a>
			<a href="settings.php" class="btn btn-info bt-lg">Settings</a>
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
