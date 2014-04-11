
<div class="row">
  <form method="POST">
    <h3><?php echo $Controller->fileType; ?> File</h3>
    <div class="col-md-12">
      <p class="col-md-8">
        This is your current <?php echo $Controller->fileType; ?> file.
        Copy the data from the current file, that you would like to retain in your template file.
        All projects should be left out of this template.
      </p>
    </div>
    <br />
    <div class="col-md-6 alert bg-success">
      <h4>Template File</h4>
      <textarea class="form-control lh-file" name="data[FileTemplate]"><?php echo $Controller->template; ?></textarea>
    </div>
    <div class="col-md-6 alert bg-info">
      <h4>Current File</h4>
      <textarea disabled="disabled" class="form-control text-success lh-file"><?php echo $Controller->hostsFile; ?></textarea>
    </div>
    <br />
      <button class="btn btn-primary">Save File Template</button>
  </form>
</div>