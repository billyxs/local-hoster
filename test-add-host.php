<?php
require('autoloader.php');

$Config = new Config();
$projectPaths = $Config->data['projects-path'];

if(isset($_REQUEST['data']) ) {
	unset( $_REQUEST['data']['submit'] );

	$_REQUEST['data']['id'] = count( $Config->data['projects'] );
	$Config->data['projects'][] = $_REQUEST['data'];
	$Config->save($Config->data);
}

?>

<html>
<head>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" />
	<style>
	a {
		font-size: 20px;
	}
	</style>
</head>
<body>

	<div class="container">
		<h2>Local Hoster</h2>
		<hr />
		<a href="etc-hosts.php" class="btn btn-primary bt-lg">Hosts</a>
		<a href="add-host.php" class="btn btn-primary bt-lg">Add Host</a>
		<hr />
		<h3>Add Host</h3>
		<blockquote class="active">
			<p>Update your hosts and apache vhosts file by entering in the domain name and file path you would like to use to access your project.</p>
		</blockquote>
		<form role="form" method="POST">
			<div class="form-group">
				<label>Project Name</label>
				<input type="text" name="data[project-name]" class="form-control" placeholder="Project Name">
			</div>
			<div class="form-group">
				<label>Host Name</label>
				<input type="text" name="data[server-name]" class="form-control" placeholder="local.project.com">
			</div>

			<div class="form-group">
				<label>Project Path</label>
				<select id="selectProjectPath">
					<?php
					if(is_array($projectPaths) && count($projectPaths) > 1) {

						foreach($Config->data['projects-path'] as $key=>$val) { ?>
							<option value="<?php echo $val ?>"><?php echo $val ?></option>
					<?php
					  }
					}
					?>
				</select>
				<input type="text" class="form-control" value="" name="data[project-path]" id="projectPath" />
			</div>

			<button type="submit" name="data[submit]" class="btn btn-default">Add Project</button>
		</form>
	</div>

	<script src="/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript">
		var setProjectPath = function() {
			console.log("select path");
			var project = $('#selectProjectPath').val();
			console.log(project);
			$('#projectPath').val( project );
		}

		setProjectPath();
		$('#projectPath').on('change', setProjectPath);

	</script>
</body>
</html>
