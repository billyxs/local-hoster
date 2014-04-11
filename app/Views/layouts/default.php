<html>
<head>
	<title>Local Hoster</title>
	<link href="/assets/css/bootstrap-3.1.0.min.css" rel="stylesheet" />
	<link href="/assets/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css/main.css" rel="stylesheet" />
</head>
<body>

	<div class="container">
		<header>
			<h3>Local Hoster</h3>
			<?php
				$controllerName = str_replace('Controller', '', get_class($Controller) );
				if( $controllerName === 'Settings' ) {
					include(ELEMENT . 'nav/settings.php');
				} else {
					include(ELEMENT . 'nav/projects.php');
				}
			?>
		</header>
		<hr />
		<?php if(isset($Controller->alert)) { ?>
		<div>
			<p class="alert bg-<?php echo $Controller->alert['class'] ?>"><?php echo $Controller->alert['message'] ?></p>
		</div>
		<?php } ?>
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
	    $("#projectsGroup").append(project).append('<br />');
	  });
	</script>

</body>
</html>
