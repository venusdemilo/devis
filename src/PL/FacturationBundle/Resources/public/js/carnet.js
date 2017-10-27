
 $('.btn-group button:not()').prop("disabled",true);

 var t = $('#tableauclient').DataTable(
    {
        
         "info":false,
         "scrollY":        '400px',
         "scrollCollapse": true,
         "paging":         false,
         "scrollx": false
     }
  );


//$('#alertinfo').html('<span class="label label-warning">coco</span>').fadeOut(10000);
 $('#modifierclient').click(function(){
   var id = $(this).data('idcarnet');
   var path = Routing.generate('pl_facturation_carnet_update',{'id':id});
  $(location).attr('href',path);
 });
$('#supprimerclient').click(function(){
  $('#modalsupprimerclient').modal('show');
  $('#confirmersupprimerclient').prop("disabled",false);
  $('#annulersupprimerclient').prop("disabled",false);
})
 $('#confirmersupprimerclient').click(function(){
    var id = $(this).attr('data-idcarnet');
    var path = Routing.generate('pl_facturation_carnet_delete',{'id':id});
    $.get(path)
       .done(function(){
         $('tr').css('opacity','1');
         $('tr[data-idcarnet='+id+']').fadeOut(300, function(){
           $(this).remove();
           var str = 'Client supprimé !' ;
           var cl = 'success';
           alertinfo(str,cl);
           $('.btn-group button').prop("disabled",true);
         });
       })
       .fail(function(xhr,status,error){
         var str = 'Suppression impossible : '+ error  ;
         var cl = 'warning';
         alertinfo(str,cl);
       });
       $('#modalsupprimerclient').modal('hide');
    });

    $('#annulersupprimerclient').click(function(){
      $('#modalsupprimerclient').modal('hide');
    })


 $('#creerdevis').click(function(){
   var id = $(this).attr('data-idcarnet');
   $(location).attr('href',Routing.generate('pl_facturation_devis_new',{'id' :id}));
 });




 function survolLigneTableau(){
		$('#tableauclient tr:not(:first)').on({
      'mouseover.superPL': function(){$(this).addClass('info');},
      'mouseleave.superPL': function(){$(this).removeClass('info');}
    });
	};

  function clickLigneTableau(){
    $('#tableauclient tr:not(:first)').on(
      'click.superPL', function(){
        $('#tableauclient tr').removeClass('danger');
        $('#tableauclient tr').css('opacity', '0.4');
        $(this).removeClass('info');
        $(this).addClass('danger');
        $(this).css('opacity','1');
        var id = $(this).data('idcarnet');
        var nomCar = $(this).data('nomcar');
        var prnCar = $(this).data('prncar');
        $('#modifierclient').prop("disabled",false).attr('data-idcarnet',id).removeClass('btn-default').addClass('btn-primary');
        $('#supprimerclient').prop("disabled",false).removeClass('btn-default').addClass('btn-danger');
        $('#creerdevis').prop("disabled",false).attr('data-idcarnet',id).removeClass('btn-default').addClass('btn-success');
        $('#confirmersupprimerclient').attr('data-idcarnet',id);
    });
  };

clickLigneTableau();
survolLigneTableau();

$('#nouveauclient').click(function(){
  $('#pl_facturationbundle_carnet_Enregistrer').prop("disabled",false);
  $('#modalnouveauclient').modal('show');
})

$("form[name=pl_facturationbundle_carnet]").submit(function(e) {
  e.preventDefault();
  var form = $(this);

  $.post(Routing.generate('pl_facturation_carnet_new'), form.serialize(),function(){},'json')
  .done(function(data) {
    var id = data.id;
    var str = 'Nouveau client enregistré !' ;
    var cl = 'success';
    $('#modalnouveauclient').modal('hide');
    var nomCar = $('#pl_facturationbundle_carnet_nomCar').val();
    var prnCar = $('#pl_facturationbundle_carnet_prnCar').val();
    var melCar = $('#pl_facturationbundle_carnet_melCar').val();
    var rueCar = $('#pl_facturationbundle_carnet_numerovoie').val() +' '+$('#pl_facturationbundle_carnet_typevoie').val() +' '+$('#pl_facturationbundle_carnet_nomvoie').val() +' '+$('#pl_facturationbundle_carnet_complement').val();
    var cdeCar = $('#pl_facturationbundle_carnet_cdeCar').val();
    var vilCar = $('#pl_facturationbundle_carnet_vilCar').val();
    var telCar = $('#pl_facturationbundle_carnet_tel1').val()+'.'+$('#pl_facturationbundle_carnet_tel2').val()+'.'+$('#pl_facturationbundle_carnet_tel3').val()+'.'+$('#pl_facturationbundle_carnet_tel4').val()+'.'+$('#pl_facturationbundle_carnet_tel5').val();
    $('input[type=text]').val(null);
    $('input[type=email]').val(null);
    var newTr = '<tr data-idcarnet="'+id+'" data-nomcar="'+nomCar+'" data-prncar="'+prnCar+'"><td style="text-transform:uppercase;" data-idcarnet="'+id+'"><b>'+ nomCar +'</b></td><td style="text-transform:capitalize;"><b>'+prnCar+'</b></td><td>'+melCar+'</td><td>'+rueCar+'</td><td>'+cdeCar+'</td><td style="text-transform:uppercase;">'+vilCar+'</td><td>'+telCar+'</td></tr>';
    $('#tableauclient tbody').prepend(newTr);

    $('#tableauclient tr:not(:first)').off('superPL');
    $('#tableauclient tr:not(:first)').removeClass('danger').css('opacity', '0.4');
    $("tr[data-idcarnet="+id+"]").addClass('danger').css('opacity','1');

    clickLigneTableau();
    survolLigneTableau();
    //$('#creerdevis').attr('data-idcarnet',id);
    //$('#supprimerclient').attr('data-idcarnet',id);

    //var path = Routing.generate('pl_facturation_carnet_client_new');
    //$('.btn-group').prepend('<a type="button" class="btn btn-info" href="'+path+'"><i class="fa fa-refresh" aria-hidden="true"></i> Rafraîchir la liste</a>');
     //$('.btn-group button').prop("disabled",false);
    alertinfo(str,cl);
    })
    .fail(function() {
    alert("ça marche pas...");
    });
  });
