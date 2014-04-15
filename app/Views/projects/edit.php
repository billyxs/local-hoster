<div class="row">
	<form role="form" method="POST" class="col-md-6">

	<?php if(isset($this->project) ) { ?>
		<input type="hidden" value="<?php echo $this->project['id']; ?>" name="data[id]" />
	<?php } ?>

		<div class="form-group">
			<label>Project Group</label>
			<input type="text" name="data[Group]" value="<?php echo (isset($this->project) ) ? $this->project['Group'] : ''; ?>" class="form-control" placeholder="Project Group">
		</div>

		<div class="form-group">
			<label>Project Name</label>
			<input type="text" name="data[Name]" value="<?php echo (isset($this->project) ) ? $this->project['Name'] : ''; ?>" class="form-control" placeholder="Project Name">
		</div>
		<div class="form-group">
			<label>Project IP</label>
			<input type="text" name="data[ip]" value="<?php echo (isset($this->project) ) ? $this->project['ip'] : '127.0.0.1'; ?>"  class="form-control" placeholder="local.project.com">
		</div>
		<div class="form-group">
			<label>Host Name</label>
			<input type="text" name="data[ServerName]" value="<?php echo (isset($this->project) ) ? $this->project['ServerName'] : ''; ?>"  class="form-control" placeholder="local.project.com">
		</div>

		<div class="form-group">
			<label>Project Path</label>
			<select id="selectProjectPath" class="form-control">
				<?php
				$paths = $this->settings['projects-path'];
				if(is_array($paths) && count($paths) > 1) {
					foreach($paths as $key=>$val) {
				?>
				<option value="<?php echo $val ?>"><?php echo $val ?></option>
				<?php
				  }
				}
				?>
			</select>
			<input type="text" class="form-control" value="<?php echo (isset($this->project) ) ? $this->project['DocumentRoot'] : ''; ?>"  name="data[DocumentRoot]" id="projectPath" />
		</div>

		<button class="btn btn-default"><?php echo (isset($this->project) ) ? 'Edit' : 'Add'; ?> Project</button>
	</form>
</div>