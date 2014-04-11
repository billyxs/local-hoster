
<div>
  <form method="POST">
    <h3><?php echo $Controller->fileType; ?> File</h3>
    <p class="col-md-8">
      This is your current <?php echo $Controller->fileType; ?> file.
      Remove all current projects and comments and leave a template of what you would like your base file to look like.
      Local hoster will take care of all the project details.
    </p>
    <textarea class="form-control lh-file" name="data[FileTemplate]"><?php echo $Controller->hostsFile; ?></textarea>
    <br />
    <button class="btn btn-primary">Save File Template</button>
  </form>
</div>