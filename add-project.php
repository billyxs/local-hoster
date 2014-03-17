<?php
require_once('Classes/Hosts.class.php');
require_once('Classes/Vhosts.class.php');

if($_REQUEST['data']) {
	$Hosts = new Hosts( array('filePath'=>'/etc/hosts') );
	$Hosts->addDomain( $_REQUEST['data'] );

	$Vhosts = new Vhosts(array('filePath'=>'/etc/apache2/extra/httpd-vhosts.conf'));
	$Vhosts->addDomain( $_REQUEST['data'] );
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
		<header>
			<h2>Local Hoster</h2>
			<hr />
			<a href="etc-hosts.php" class="btn btn-primary bt-lg">Hosts</a>
			<a href="add-host.php" class="btn btn-warning bt-lg">Add Host</a>
			<a href="add-config.php" class="btn btn-default bt-lg">Add Config</a>
		</header>
		<hr />
		<h3>Add Host</h3>
			<blockquote class="active">
				<p>Update your hosts and apache vhosts file by entering in the domain name and file path you would like to use to access your project.</p>
			</blockquote>
			<form role="form" method="POST">
				<div class="form-group">
					<label>Host Name</label>
					<input type="text" name="data[domainName]" class="form-control" placeholder="local.project.com">
				</div>

				<div class="form-group">
					<label>Project Path</label>
					<input type="text" class="form-control" value="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>" name="data[domainPath]" />
				</div>

				<button type="submit" name="data[submit]" class="btn btn-default">Add Project</button>
			</form>
		<hr />
		<footer>
			<sub>Local Hoster 2014</sub>
		</footer>
		<hr />
	</div>

</body>
</html>
