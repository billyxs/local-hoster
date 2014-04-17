<html>
<head>
	<title>Local Hoster</title>
	<link href="/assets/css/bootstrap-3.1.0.min.css" rel="stylesheet" />
	<link href="/assets/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css/main.css" rel="stylesheet" />
</head>
<body>

	<div class="container">
		<header class="text-center">
			<h4>Local Hoster</h4>
			<div class="row">
				<div class="col-md-6">
					<a href="/" class="btn btn-primary bt-lg"><i class="fa fa-th-list fa-lg"></i> Projects</a>
					<a href="?controller=projects&action=edit&id=add" class="btn btn-primary bt-lg"><i class="fa fa-plus fa-lg"></i> Add Project</a>
					<a href="?controller=projects&action=import" class="btn btn-primary bt-lg"><i class="fa fa-upload fa-lg"></i> Project Import</a>
				</div>
				<div class="col-md-6">
					<a href="?controller=settings" class="btn btn-default bt-lg"><i class="fa fa-cog fa-lg"></i> Settings</a>
					<a href="?controller=settings&action=setupHosts" class="btn btn-default bt-lg"><i class="fa fa-edit fa-lg"></i> Hosts Template</a>
					<a href="?controller=settings&action=setupVhosts" class="btn btn-default bt-lg"><i class="fa fa-edit fa-lg"></i> Vhosts Template</a>
				</div>
			</div>

		</header>
		<hr />
		<?php if(isset($this->alert)) { ?>
		<div>
			<p class="alert bg-<?php echo $this->alert['class'] ?>"><?php echo $this->alert['message'] ?></p>
		</div>
		<?php } ?>
		<?php include( $this->content ) ?>
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

		$('.project-folder .btn').on('click', function() {
			$(this).parents('.project-folder').remove();
		});

		/**
		 * Settings
		 */
	  $('#addFolder').click(function() {
	    var project = $('.project-folder:last').clone();
	    console.log(project);
	    $(this).before(project);
	  });
	</script>

</body>
</html>
