/**
 * Add Project function
 * Update project path input from dropdown
 */
var setProjectPath = function() {
  var project = $('#selectProjectPath').val();
  $('#projectPath').val( project );
}

$('#selectProjectPath').on('change', setProjectPath);

/**
 * Settings functions
 *
 */
// bind trash can to delete project entry
$('#projectsGroup').delegate('.project-folder .btn', 'click', function() {
  $(this).parents('.project-folder').remove();
});

// add a new project for settings
$('#addFolder').click(function() {
  var project = $('.project-folder:last').clone();
  $(this).before(project);
});