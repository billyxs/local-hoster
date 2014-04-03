<html>
<head>
	<link href="/css/bootstrap-3.1.0.min.css" rel="stylesheet" />
	<link href="/assets/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet" />

</head>
<body>

	<div class="container">
		<header>
			<h3>Local Hoster</h3>
			<a href="projects.php" class="btn btn-primary bt-lg"><i class="fa fa-th-list fa-lg"></i> Projects</a>
			<a href="projects.php?id=add" class="btn btn-success bt-lg"><i class="fa fa-plus fa-lg"></i> Add Project</a>
			<a href="project-import.php" class="btn btn-info bt-lg"><i class="fa fa-upload fa-lg"></i> Project Import</a>
			<a href="settings.php" class="btn btn-default bt-lg"><i class="fa fa-cog fa-lg"></i> Settings</a>
		</header>
		<hr />
		<div></div>
		<?php include( $content ) ?>
		<hr />
		<footer>
			<sub>Local Hoster 2014</sub>
		</footer>
		<hr />
	</div>

</body>
</html>
