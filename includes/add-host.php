<h3>Add Host</h3>
<blockquote class="active">
	<p>Update your hosts and apache vhosts file by entering in the domain name and file path you would like to use to access your project.</p>
</blockquote>
<form role="form" method="POST">
	<div class="form-group">
		<label>Host Name</label>
		<input type="text" name="data[server-name]" class="form-control" placeholder="local.project.com">
	</div>

	<div class="form-group">
		<label>Project Path</label>
		<input type="text" class="form-control" value="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>" name="data[document-root]" />
	</div>

	<button type="submit" name="data[submit]" class="btn btn-default">Add Project</button>
</form>