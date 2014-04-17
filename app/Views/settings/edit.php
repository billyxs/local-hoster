<form role="form" method="POST" class="row">

  <div class="col-md-4 col-md-push-2">
    <div class="form-group <?php echo ($this->hostsStatus['status'] === "good") ? 'has-success' : 'has-error' ?>">
      <label>Hosts Path</label>

      <?php if($this->hostsStatus['status'] === "good") { ?>
        <p class="alert bg-success">Hosts file is ready!</p>
      <?php } else {?>
        <p class="alert bg-danger"><?php echo $this->hostsStatus['message']; ?></p>
      <?php } ?>

      <input type="text" name="data[hosts-path]" value="<?php echo (isset($this->settings) ) ? $this->settings['hosts-path'] : ''; ?>" class="form-control" placeholder="/etc/hosts">
    </div>

    <div class="form-group <?php echo ($this->vhostsStatus['status'] === "good") ? 'has-success' : 'has-error' ?>">
      <label>Virtual Hosts Path</label>


      <?php if($this->vhostsStatus['status'] === "good") { ?>
        <p class="alert bg-success">VHosts file is ready!</p>
      <?php } else {?>
        <p class="alert bg-danger"><?php echo $this->vhostsStatus['message']; ?></p>
      <?php } ?>

      <input type="text" name="data[vhosts-path]" value="<?php echo (isset($this->settings) ) ? $this->settings['vhosts-path'] : ''; ?>" class="form-control" placeholder="/etc/apache2/extra/httpd-vhosts.conf">
    </div>
  </div>
  <div class="col-md-4 col-md-push-2">
    <div class="form-group" id="projectsGroup">
      <label>Projects Folder</label><span id="addFolder" class="btn btn-sm btn-success">+ Add Folder</span>
      <?php foreach($this->projectPaths as $projectFolder) { ?>
        <input type="text" class="form-control project-folder" value="<?php echo $projectFolder; ?>" placeholder="/Projects"  name="data[projects-path][]" />
        <br />
      <?php } ?>

    </div>
  </div>

  <button class="btn btn-success"><i class="fa fa-cog fa-lg"></i> Save Settings</button>

  </div>
</form>