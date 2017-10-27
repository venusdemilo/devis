$('.btn-group button').prop("disabled",true);
$('#tableaudevis').DataTable({
  "order": [[ 4, "desc" ]],
       "scrollY":        '400px',
       "scrollCollapse": true,
       "paging":         false,
       "scrollx": false,
       "info":false,
       select: true
});
function survolLigneTableau(){
   $('#tableaudevis tr:not(:first)').on({
     'mouseover.superPL': function(){$(this).addClass('info');},
     'mouseleave.superPL': function(){$(this).removeClass('info');}
   });
 };
 survolLigneTableau();


function clickLigneTableau(){
   $('#tableaudevis tr:not(:first)').on(
     'click.superPL', function(){
       $('#tableaudevis tr').removeClass('danger');
       $('#tableaudevis tr').css('opacity', '0.4');
       $(this).removeClass('info');
       $(this).addClass('danger');
       $(this).css('opacity','1');
       var iddevis = $(this).data('iddevis');
       var idcarnet = $(this).data('idcarnet');
       var prncar = $(this).data('prncar');
       var nomcar = $(this).data('nomcar');
       var datdev = $(this).data('datdev');
       var email = $(this).data('email');


       $('#nouveaudevis')
        .prop("disabled",false)
        .attr('data-idcarnet',idcarnet)
        .removeClass('btn-default')
        .addClass('btn-info')
        ;

       $('#voirdevis')
        .prop("disabled",false)
        .attr('data-iddevis',iddevis)
        .attr('data-prncar',prncar)
        .attr('data-nomcar',nomcar)
        .attr('data-datdev',datdev)
        .removeClass('btn-default')
        .addClass('btn-success')
        ;

       $('#voirpdf')
         .prop("disabled",false)
         .attr('data-iddevis',iddevis)
         .attr('data-prncar',prncar)
         .attr('data-nomcar',nomcar)
         .attr('data-datdev',datdev)
         .removeClass('btn-default')
         .addClass('btn-success')
       ;

       $('#devistofacture')
         .prop("disabled",false)
         .attr('data-iddevis',iddevis)
         .attr('data-prncar',prncar)
         .attr('data-nomcar',nomcar)
         .attr('data-datdev',datdev)
         .removeClass('btn-default')
         .addClass('btn-success')
       ;
       if (email != ''){
       $('#email')
         .prop("disabled",false)
         .removeClass('btn-default')
         .addClass('btn-success')
         .attr('data-email',email);


         $('#confirmeremail')
           .prop("disabled",false)
           .attr('data-iddevis',iddevis)
           .attr('data-prncar',prncar)
           .attr('data-nomcar',nomcar)
           .attr('data-datdev',datdev)
           .attr('data-email',email);
       }
       ;

       $('#supprimerdevis')
         .prop("disabled",false)
         .attr('data-iddevis',iddevis)
         .attr('data-prncar',prncar)
         .attr('data-nomcar',nomcar)
         .attr('data-datdev',datdev)
         .removeClass('btn-default')
         .addClass('btn-warning')
       ;
       $('#confirmersupprimerdevis')
         .attr('data-iddevis',iddevis)
         .attr('data-prncar',prncar)
         .attr('data-nomcar',nomcar)
         .attr('data-datdev',datdev)
       ;

       $('#facacquittee')
        .prop("disabled",false)
        .removeClass('btn-default')
        .addClass('btn-warning')
      ;

       $('#confirmerfacacquittee')
         .attr('data-iddevis',iddevis)
         .attr('data-prncar',prncar)
         .attr('data-nomcar',nomcar)
         .attr('data-datdev',datdev)
       ;

//       $('#modifierdevis').prop("disabled",false).attr('data-iddevis',iddevis).removeClass('btn-default').addClass('btn-success');
//       $('#supprimerdevis').prop("disabled",false).attr('data-iddevis',iddevis).removeClass('btn-default').addClass('btn-warning');
   });
 };
clickLigneTableau();

$('#nouveaudevis').click(function(){
  var id = $(this).data('idcarnet');
  var path = Routing.generate('pl_facturation_devis_new',{
    'id':id});
  $(location).attr('href',path);
});

$('#voirdevis').click(function(){
  var id = $(this).data('iddevis');
  var prncar = $(this).data('prncar');
  var nomcar = $(this).data('nomcar');
  var datdev = $(this).data('datdev');
  var path = Routing.generate('pl_facturation_produit_devis_show',{
    'id':id,
    });
  $(location).attr('href',path);
});

$('#voirpdf').click(function(){
  var id = $(this).data('iddevis');
  var prncar = $(this).data('prncar');
  var nomcar = $(this).data('nomcar');
  var datdev = $(this).data('datdev');
  var path = Routing.generate('pl_facturation_devis_pdf',{
    'id':id,
    'prncar':prncar,
    'nomcar':nomcar,
    'datdev':datdev
    });
  $(location).attr('href',path);
});



$('#devistofacture').click(function(){
  var id = $(this).data('iddevis');
  var prncar = $(this).data('prncar');
  var nomcar = $(this).data('nomcar');
  var datdev = $(this).data('datdev');
  var path = Routing.generate('pl_facturation_devis_to_facture',{
    'id':id,
    'prncar':prncar,
    'nomcar':nomcar,
    'datdev':datdev
    });
  $(location).attr('href',path);
});

$('#email').click(function(){
  var email = $(this).attr('data-email');
  console.log(email);
  $('#confirmeremail').prop("disabled",false);
  $('#annuleremail').prop("disabled",false);
  $('#preventemail').text('Souhaitez-vous envoyer le devis à l\'adresse ' + email + ' ? ');
  $('#modalemail').modal('show');
});

$('#confirmeremail').click(function(){
   var id = $(this).attr('data-iddevis');
   var prncar = $(this).attr('data-prncar');
   var nomcar = $(this).attr('data-nomcar');
   var datdev = $(this).attr('data-datdev');
   var email = $(this).attr('data-email');
   var path = Routing.generate('pl_facturation_devis_pdf',{
     'id':id,
     'prncar':prncar,
     'nomcar':nomcar,
     'datdev':datdev,
     'goemail': true,
     'email': email
      });
   $(location).attr('href',path);
 });

 $('#annuleremail').click(function(){
   $('#modalemail').modal('hide');
 });



$('#supprimerdevis').click(function(){
  $('#modalsupprimerdevis').modal('show');
  $('#confirmersupprimerdevis').prop("disabled",false);
  $('#annulersupprimerdevis').prop("disabled",false);
});

$('#confirmersupprimerdevis').click(function(){
   var id = $(this).attr('data-iddevis');
   var path = Routing.generate('pl_facturation_devis_delete',{'id':id});
   $(location).attr('href',path);
   $.get(path)
   .done(function(){
     $('tr').css('opacity','1');
     $('tr[data-iddevis='+id+']').fadeOut(300, function(){
       $(this).remove();
       var str = 'Devis supprimé !' ;
       var cl = 'warning';
       alertinfo(str,cl);
       $('.btn-group button').prop("disabled",true);
     });
   })
   .fail(function(xhr,status,error){
     var str = 'Suppression impossible : '+ error ;
     var cl = 'warning';
     alertinfo(str,cl);
   });
   $('#modalsupprimerdevis').modal('hide');

});
$('#annulersupprimerdevis').click(function(){
$('#modalsupprimerdevis').modal('hide');
});
$('#facacquittee').click(function(){
  $('#modalfacacquittee').modal('show');
  $('#confirmerfacacquittee').prop("disabled",false);
  $('#annulerfacacquittee').prop("disabled",false);
});
$('#confirmerfacacquittee').click(function(){
  var id = $(this).attr('data-iddevis');
  var prncar = $(this).attr('data-prncar');
  var nomcar = $(this).attr('data-nomcar');
  var datdev = $(this).attr('data-datdev');
  var path = Routing.generate('pl_facturation_facacquittee_pdf',{
    'id':id,
    'prncar':prncar,
    'nomcar':nomcar,
    'datdev':datdev
    });
  $(location).attr('href',path);
  $('#modalfacacquittee').modal('hide');
});
$('#annulerfacacquittee').click(function(){
$('#modalfacacquittee').modal('hide');
});
