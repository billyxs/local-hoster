<?php
  print_r($Controller->hostsStatus);
  echo BR;
  print_r($Controller->vhostsStatus);
?>


<div class="row">
  <form role="form" method="POST" class="col-md-6">
    <div class="form-group <?php echo ($Controller->hostsStatus['status'] === "good") ? 'has-success' : 'has-error' ?>">
      <label>Hosts Path</label>

      <?php if($Controller->hostsStatus['status'] === "good") { ?>
        <p class="alert bg-success">Hosts file is ready!</p>
      <?php } else {?>
        <p class="alert bg-danger"><?php echo $Controller->hostsStatus['message']; ?></p>
      <?php } ?>

      <input type="text" name="data[hosts-path]" value="<?php echo (isset($Controller->settings) ) ? $Controller->settings['hosts-path'] : ''; ?>" class="form-control" placeholder="/etc/hosts">
    </div>
    <div class="form-group <?php echo ($Controller->vhostsStatus['status'] === "good") ? 'has-success' : 'has-error' ?>">
      <label>Virtual Hosts Path</label>


      <?php if($Controller->vhostsStatus['status'] === "good") { ?>
        <p class="alert bg-success">VHosts file is ready!</p>
      <?php } else {?>
        <p class="alert bg-danger"><?php echo $Controller->vhostsStatus['message']; ?></p>
      <?php } ?>

      <input type="text" name="data[vhosts-path]" value="<?php echo (isset($Controller->settings) ) ? $Controller->settings['vhosts-path'] : ''; ?>" class="form-control" placeholder="/etc/apache2/extra/httpd-vhosts.conf">
    </div>

    <div class="form-group" id="projectsGroup">
      <label>Projects Folder</label><span id="addFolder" class="btn btn-sm btn-success">+ Add Folder</span>
      <?php foreach($Controller->projectPaths as $projectFolder) { ?>
        <input type="text" class="form-control project-folder" value="<?php echo $projectFolder; ?>" placeholder="/Projects"  name="data[projects-path][]" />
        <br />
      <?php } ?>

    </div>

    <button class="btn btn-success">Save Settings</button>
  </form>
</div>