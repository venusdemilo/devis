// ToolTip et PoPover fonctionnent pas sans ces lignes ...
$('[data-toggle=tooltip]').tooltip();
$('[data-toggle=popover]').popover();

function alertinfo(htm,cl){
  // cl = [ default, primary, info, warning, success,danger]
  $('#alertinfo').append('<span id="message" style="font-size:large;" class="label label-'+ cl +'">'+ htm +'</span>')
  .fadeOut(3000, function(){
    $('#message').remove();
    $('#alertinfo').css('display','inline');
  });
  return false;
  };
