function areYouSureYouWantToLeave() {
  confirm("Are you absolutely sure you want to leave?\n(What... is the song annoying you?)");
}

jQuery(document).ready(function($) {
  $('a').on('click', function(){
    areYouSureYouWantToLeave();
  });
});