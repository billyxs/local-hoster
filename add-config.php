<?php
require_once('Classes/Config.class.php');

$Config = new Config();

if( isset($_REQUEST['data']) ) {
	echo 'nice';
	$result = $Config->save( $_REQUEST['data']['Config'] );
	echo $result;
}

?>

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
		<h2>Local Hoster</h2>
		<form role="form" method="POST">
		  <div class="form-group">
		    <label>Hosts File Path</label>
		    <input type="text" name="data[Config][hosts-path]" value="/etc/hosts" placeholder="/etc/hosts" class="form-control">
		  </div>

		  <div class="form-group">
		    <label>VHost File Path</label>
		    <input type="text" class="form-control" value="/etc/apache/extra/httpd-vhosts.conf" placeholder="/etc/apache/extra/httpd-vhosts.conf" name="data[Config][vhost-path]" />
		  </div>

			<div class="form-group" id="projectsGroup">
		    <label>Projects Folder</label><span id="addFolder" class="btn btn-sm btn-success">+ Add Folder</span>
		    <input type="text" class="form-control project-folder" value="/Projects" placeholder="/Projects"  name="data[Config][projects-path][0]" />
		  </div>

			<button type="submit" name="data[submit]" class="btn btn-default">Save Config</button>
		</form>
		<script src="/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript">
			$('#addFolder').click(function() {
				var project = $('.project-folder:last').clone();
				console.log(project);
				project.attr('name', 'data[Config][projects-path][1]')
				$("#projectsGroup").append("<br />").append(project);
			});
		</script>
	</div>
</body>
</html>
