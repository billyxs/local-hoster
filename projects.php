<?php
require('Classes/Config.class.php');
$Config = new Config();
$projects = $Config->data['projects'];
$tableKeys = array_keys($projects[0]);

// Delete Project
if(isset($_REQUEST['delete_project_id']) ) {
	unset( $Config->data['projects'][$_REQUEST['delete_project_id'] ] );
	print_r($Config->data['projects']);
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

	</div>

	<script src="/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript">
	</script>
</body>
</html>
