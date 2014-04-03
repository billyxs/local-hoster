<div class="row">
	<form role="form" method="POST" class="col-md-6">
	<?php if(isset($project)) { ?>
		<input type="hidden" value="<?php echo $project['id'] ?>" name="data[id]" />
	<? } ?>

		<div class="form-group">
			<label>Project Name</label>
			<input type="text" name="data[Name]" value="<?php echo $project['Name'] ?>" class="form-control" placeholder="Project Name">
		</div>
		<div class="form-group">
			<label>Host Name</label>
			<input type="text" name="data[ServerName]" value="<?php echo $project['ServerName'] ?>"  class="form-control" placeholder="local.project.com">
		</div>

		<div class="form-group">
			<label>Project Path</label>
			<select id="selectProjectPath" class="form-control">
				<?php
				if(is_array($projectPaths) && count($projectPaths) > 1) {

					foreach($Config->data['projects-path'] as $key=>$val) {
				?>
				<option value="<?php echo $val ?>"><?php echo $val ?></option>
				<?php
				  }
				}
				?>
			</select>
			<input type="text" class="form-control" value="<?php echo $project['DocumentRoot'] ?>"  name="data[DocumentRoot]" id="projectPath" />
		</div>

		<button class="btn btn-default"><?php echo $buttonText; ?> Project</button>
	</form>
</div>