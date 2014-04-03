
<div class="row">
  <form role="form" method="POST" class="col-md-6">
    <div class="form-group">
      <label>Hosts Path</label>
      <input type="text" name="data[HostsPath]" class="form-control" placeholder="/etc/hosts">
    </div>
    <div class="form-group">
      <label>Virtual Hosts Path</label>
      <input type="text" name="data[VirtualHostsPath]" class="form-control" placeholder="/etc/apache2/extra/httpd-vhosts.conf">
    </div>

    <div class="form-group" id="projectsGroup">
      <label>Projects Folder</label><span id="addFolder" class="btn btn-sm btn-success">+ Add Folder</span>
      <input type="text" class="form-control project-folder" value="/Projects" placeholder="/Projects"  name="data[ProjectPaths][]" />
    </div>

    <button class="btn btn-success">Save Settings</button>
  </form>
</div>