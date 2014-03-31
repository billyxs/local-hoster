<?php
require('Classes/Config.class.php');
$Config = new Config();
$projects = $Config->data['projects'];
$tableKeys = array_keys($projects[0]);

$projectPaths = $Config->data['projects-path'];

// Set project data
if(isset($_REQUEST['data']) ) {
	unset( $_REQUEST['data']['submit'] );

	$Config->addProject($_REQUEST['data']);
	$Config->save($Config->data);
}


// Delete Project
if(isset($_REQUEST['delete_project_id']) ) {
	// unset( $Config->data['projects'][$_REQUEST['delete_project_id'] ] );
	$Config->deleteProject( $_REQUEST['delete_project_id'] );
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
		<h3>Projects</h3>
		<form role="form" method="POST">
		<?php
			if(isset($_REQUEST['id']) ) {
				$id = $_REQUEST['id'];
				$id = is_numeric( $id ) ? intval($id) : null;
				if( is_int($id) && array_key_exists($id, $projects) ) {
					$project = $projects[$id];
		?>
					<input type="hidden" value="<?php echo $id ?>" name="data[id]" />
		<?php
				} else {
					unset($id);
				}
		?>

			<div class="form-group">
				<label>Project Name</label>
				<input type="text" name="data[project-name]" value="<?php echo $project['project-name'] ?>" class="form-control" placeholder="Project Name">
			</div>
			<div class="form-group">
				<label>Host Name</label>
				<input type="text" name="data[server-name]" value="<?php echo $project['server-name'] ?>"  class="form-control" placeholder="local.project.com">
			</div>

			<div class="form-group">
				<label>Project Path</label>
				<select id="selectProjectPath" class="form-control">
					<?php
					if(is_array($projectPaths) && count($projectPaths) > 1) {

						foreach($Config->data['projects-path'] as $key=>$val) { ?>
							<option value="<?php echo $val ?>"><?php echo $val ?></option>
					<?php
					  }
					}
					?>
				</select>
				<input type="text" class="form-control" value="<?php echo $project['project-path'] ?>"  name="data[project-path]" id="projectPath" />
			</div>

			<button type="submit" name="data[submit]" class="btn btn-default">Add Project</button>
		</form>

		<?php	} else {?>

		<blockquote class="active">
			<p>Your projects</p>
		</blockquote>
		<table class="table">
			<thead>
				<tr>
					<?php foreach($tableKeys as $key) {
						$name = ucwords( str_replace('-', ' ', $key) );
						echo "<th>$name</th>";
					}?>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($projects as $project) { ?>
					<tr>
					<?php foreach($tableKeys as $key) {
						echo "<td>$project[$key]</td>";
					}?>
					<td><form method="POST"><input type="hidden" name="delete_project_id" value="<?php echo $project['id']; ?>"><button class="btn btn-danger">Delete</button></form>
					<td><a href="projects.php?id=<?php echo $project['id']; ?>" class="btn btn-success">Edit</a></form>
				</tr>
				<?php }?>
			</tbody>
		</table>

	<?php
			}
		?>

	</div>

	<script src="/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript">
		var setProjectPath = function() {
			console.log("select path");
			var project = $('#selectProjectPath').val();
			console.log(project);
			$('#projectPath').val( project );
		}

		$('#projectPath').on('change', setProjectPath);

	</script>
</body>
</html>
