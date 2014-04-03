<html>
<head>
	<link href="/assets/css/bootstrap-3.1.0.min.css" rel="stylesheet" />
	<link href="/assets/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet" />

</head>
<body>

	<div class="container">
		<header>
			<h3>Local Hoster</h3>
			<a href="/" class="btn btn-primary bt-lg"><i class="fa fa-th-list fa-lg"></i> Projects</a>
			<a href="?controller=projects&action=edit&id=add" class="btn btn-success bt-lg"><i class="fa fa-plus fa-lg"></i> Add Project</a>
			<a href="?controller=projects&action=import" class="btn btn-info bt-lg"><i class="fa fa-upload fa-lg"></i> Project Import</a>
			<a href="?controller=projects&action=settings" class="btn btn-default bt-lg"><i class="fa fa-cog fa-lg"></i> Settings</a>
		</header>
		<hr />
		<div></div>
		<?php include( $content ) ?>
		<hr />
		<footer>
			<sub>Local Hoster 2014</sub>
		</footer>
	</div>
	<script src="/assets/js/jquery-1.11.0.min.js"></script>

	<script type="text/javascript">
		/**
		 * Project Path
		 */
		var setProjectPath = function() {
			console.log("select path");
			var project = $('#selectProjectPath').val();
			console.log(project);
			$('#projectPath').val( project );
		}

		$('#selectProjectPath').on('change', setProjectPath);


		/**
		 * Settings
		 */
	  $('#addFolder').click(function() {
	    var project = $('.project-folder:last').clone();
	    console.log(project);
	    project.attr('name', 'data[ProjectPaths][]')
	    $("#projectsGroup").append("<br />").append(project);
	  });
	</script>

</body>
</html>
