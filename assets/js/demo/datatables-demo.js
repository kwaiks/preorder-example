// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.display').DataTable({
    "order": [[ 5, "desc" ]]
  });
});
