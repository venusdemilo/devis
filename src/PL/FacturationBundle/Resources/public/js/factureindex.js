$('.btn-group button').prop("disabled",true);

$('#tableaufacture').DataTable({
  "order": [[ 2, "desc" ]],
       "scrollY":        '400px',
       "scrollCollapse": true,
       "paging":         false,
       "scrollx": false,
       "info":false,
       select: true
});

function survolLigneTableau(){
   $('#tableaufacture tr:not(:first)').on({
     'mouseover.superPL': function(){$(this).addClass('info');},
     'mouseleave.superPL': function(){$(this).removeClass('info');}
   });
 };
 survolLigneTableau();

function clickLigneTableau(){
    $('#tableaufacture tr:not(:first)').on(
      'click.superPL', function(){
        $('#tableaufacture tr')
          .removeClass('danger')
          .css('opacity', '0.4');

        $(this).removeClass('info')
          .addClass('danger')
          .css('opacity','1');

        var iddevis = $(this).attr('data-iddevis');
        var idfacture = $(this).attr('data-idfacture');
        var nomcar = $(this).attr('data-nomcar');
        var prncar = $(this).attr('data-prncar');
        var datfac = $(this).attr('data-datfac');
        var vldfac = $(this).attr('data-vldfac');
        var darfac = $(this).attr('data-darfac');
        var email = $(this).attr('data-email');

        /*
        gestion boutons  validation, dévalidation, réglement
        */

        if( vldfac == ''){
          $('#valider')
           .prop("disabled",false)
           .removeClass('btn-default')
           .addClass('btn-success')
           .attr('data-idfacture',idfacture)
           .attr('data-email',email)
           ;

          $('#reglement')
            .prop("disabled",true)
            .removeClass('btn-primary')
            .addClass('btn-default')
            ;
            $('#devalider')
              .prop("disabled",true)
              .removeClass('btn-warning')
              .addClass('btn-default')
              ;
              $('#devispdf')
                .prop("disabled",false)
                .removeClass('btn-default')
                .addClass('btn-success')
                .attr('data-nomcar',nomcar)
                .attr('data-prncar',prncar)
                .attr('data-iddevis',iddevis)
                ;
                $('#facturepdf')
                            .prop("disabled",false)
                            .removeClass('btn-default')
                            .addClass('btn-success')
                            .attr('data-idfacture',idfacture)
                            .attr('data-nomcar',nomcar)
                            .attr('data-prncar',prncar)
                ;
                $('#archiver')
                  .prop("disabled",false)
                  .removeClass('btn-default')
                  .addClass('btn-primary')
                  .attr('data-idfacture',idfacture)
                ;
         } else {
           $('#valider')
            .prop("disabled",true)
            .removeClass('btn-success')
            .addClass('btn-default')
            .attr('data-idfacture',idfacture)
            .attr('data-email',email)
            ;
            $('#archiver')
              .prop("disabled",true)
              .removeClass('btn-primary')
              .addClass('btn-default')
              .attr('data-idfacture',idfacture)
            ;
          $('#reglement')
              .prop("disabled",false)
              .removeClass('btn-default')
              .addClass('btn-primary')
              .attr('data-idfacture',idfacture)
              ;
        $('#devalider')
                  .prop("disabled",false)
                  .removeClass('btn-default')
                  .addClass('btn-warning')
                  .attr('data-idfacture',idfacture)
                  ;
        $('#modifierfacture')
                   .prop("disabled",false)
                   .removeClass('btn-default')
                   .addClass('btn-info')
                   .attr('data-idfacture',idfacture)
                   ;
        $('#devispdf')
                     .prop("disabled",false)
                     .removeClass('btn-default')
                     .addClass('btn-success')
                     .attr('data-iddevis',iddevis)
                     .attr('data-nomcar',nomcar)
                     .attr('data-prncar',prncar)
                     ;
        $('#facturepdf')
                    .prop("disabled",false)
                    .removeClass('btn-default')
                    .addClass('btn-success')
                    .attr('data-idfacture',idfacture)
                    .attr('data-nomcar',nomcar)
                    .attr('data-prncar',prncar)
                    ;
        $('#facturearchiveepdf')
                                .prop("disabled",false)
                                .removeClass('btn-default')
                                .addClass('btn-success')
                                .attr('data-idfacture',idfacture)
                                .attr('data-nomcar',nomcar)
                                .attr('data-prncar',prncar)
                                .attr('data-darfac',darfac)
                                ;
         }
      });
};

clickLigneTableau();

$('#valider').click(function(){
  var email = $(this).attr('data-email');
  var idFacture = $(this).attr('data-idfacture');
  var prncar = $(this).attr('data-prncar');
  var nomcar = $(this).attr('data-nomcar');
  var path = Routing.generate('pl_facturation_mouvement_valid_facture',{'idFacture':idFacture});
  $.get(path, idFacture,function(){},'json')
    .done(function(data) {

      if (email != ''){
        $('#confirmeremail')
          .prop("disabled",false)
          .attr('data-idfacture',idFacture)
          .attr('data-email',email);
        $('#annuleremail').prop("disabled",false);
        $('#preventemail').text('Souhaitez-vous envoyer la facture à l\'adresse ' + email + ' ? ');
        $('#modalemail').modal('show');
        $('#confirmeremail').click(function(){
          var id = $(this).attr('data-idfacture');
          var email = $(this).attr('data-email');
          var path = Routing.generate('pl_facturation_facture_encours_pdf',{
            'id':id,
            'goemail':true,
            'email':email
          });
        $('#annuleremail').click(function(){
          $('#modalemail').modal('hide');
        });
        $(location).attr('href',path);
        });
      }
      else{
        var str = 'Facture validée.';
        var cl = 'success';
        alertinfo(str,cl);
        location.reload(true);}
    })
    .fail(function(xhr,status,error) {
      var str = 'Erreur en production : '+ error  ;
      var cl = 'warning';
      alertinfo(str,cl);
    });
});

$('#archiver').click(function(){
  // archivage direct d'une facture
  var idFacture = $(this).attr('data-idfacture');
  $('#modalarchiver').modal('show');
  $('#confirmerarchiver')
    .prop("disabled",false)
    .attr('data-idfacture',idFacture);
  $('#annulearchiver')
    .prop("disabled",false);
  $('#confirmerarchiver').click(function(){
    var path = Routing.generate('pl_facturation_facture_archive_direct',{'id':idFacture});
    $(location).attr('href',path);
  });
});

$('#annulearchiver').click(function(){
  $('#modalarchiver').modal('hide');
});



$('#devalider').click(function(){
  var idFacture = $(this).attr('data-idfacture');
  var path = Routing.generate('pl_facturation_mouvement_unvalid_facture',{'idFacture':idFacture});
  $.get(path, idFacture,function(){},'json')
    .done(function(data) {
      var str = 'Facture dévalidée.' ;
      var cl = 'warning';
      alertinfo(str,cl);
      location.reload(true);
    })
    .fail(function(xhr,status,error) {
      var str = 'Erreur en production : '+ error  ;
      var cl = 'warning';
    alertinfo(str,cl);
    });
});

$('#reglement').click(function(){
  var idFacture = $(this).attr('data-idfacture');
  var path = Routing.generate('pl_facturation_mouvement_reglement_facture',{'idFacture':idFacture});
  $(location).attr('href',path);
});

$('#modifierfacture').click(function(){
  var idFacture = $(this).attr('data-idfacture');
  var path = Routing.generate('pl_facturation_facture_update',{'id':idFacture});
  $(location).attr('href',path);
});
$('#devispdf').click(function(){
  var idDevis = $(this).attr('data-iddevis');
  var prncar = $(this).attr('data-prncar');
  var nomcar = $(this).attr('data-nomcar');
  var path = Routing.generate('pl_facturation_devis_pdf',{'id':idDevis,'nomcar':nomcar,'prncar':prncar});
  $(location).attr('href',path);
});

$('#facturepdf').click(function(){
  var idfacture = $(this).attr('data-idfacture');
  var path = Routing.generate('pl_facturation_facture_encours_pdf',{'id':idfacture});
  $(location).attr('href',path);
});

$('#facturearchiveepdf').click(function(){
  var idfacture = $(this).attr('data-idfacture');
  var prncar = $(this).attr('data-prncar');
  var nomcar = $(this).attr('data-nomcar');
  var darfac = $(this).attr('data-darfac');
  var path = Routing.generate('pl_facturation_facture_archivee_pdf',{'id':idfacture,'nomcar':nomcar,'prncar':prncar,'darfac':darfac});
  $(location).attr('href',path);
});
