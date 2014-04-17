<h3><?php echo $this->fileType; ?> File</h3>
<form method="POST">
  <div class="col-md-12">
    <p class="col-md-8">
      This is your current <?php echo $this->fileType; ?> file.
      Copy the data from the current file, that you would like to retain in your template file.
      All projects should be left out of this template.
    </p>
  </div>
  <br />
  <div class="col-md-6 alert bg-info">
    <h4>Your Current System <?php echo $this->fileType; ?> File</h4>
    <textarea disabled="disabled" class="form-control text-success lh-file"><?php echo $this->hostsFile; ?></textarea>
  </div>
  <div class="col-md-6 alert bg-success">
    <h4>Stored <?php echo $this->fileType; ?> Template</h4>
    <textarea class="form-control lh-file" name="data[FileTemplate]"><?php echo $this->template; ?></textarea>
  </div>
  <br />
  <button class="btn btn-primary btn-lg center-block"><i class="fa fa-edit fa-lg"></i> Save File Template</button>
</form>
