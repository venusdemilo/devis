$( "#pl_facturationbundle_facture_dpfFac_date" ).datepicker($.datepicker.regional[ "fr" ]);
$('#pl_facturationbundle_facture_dtrFac_date').datepicker($.datepicker.regional[ "fr" ]);
$('#pl_facturationbundle_facture_drpFac_date').datepicker($.datepicker.regional[ "fr" ]);
$('#pl_facturationbundle_facture_drcFac_date').datepicker($.datepicker.regional[ "fr" ]);
$('#pl_facturationbundle_facture_dpfFac_time').hide();
$('#pl_facturationbundle_facture_dtrFac_time').hide();
$('#pl_facturationbundle_facture_drpFac_time').hide();
$('#pl_facturationbundle_facture_drcFac_time').hide(); //seule solution pour effacer les minutes et secondes
$('#pl_facturationbundle_facture_avantremise').attr('readonly','readonly');

function calculremisepourcent(a,b){
    //a = montant avant remise
    //b = montant apres remise
    if (b == 0){
      result = montantavantremise;
    }
    else {
     var result = (a - b)*100/a;
    //arrondi avec 2 virgules
     var result = Math.round((result*100))/100;
   }
    return result;
  }

  function calculremiseeuros(a,b){
      // a = montant avant remise
      // b = remise en %
      if (b == 0){
        result = montantavantremise;
      }
      else {
      var result = a - (a - ((b*a)/100));
      //arrondi avec 2 virgules
      var result = Math.round((result*100))/100;
    }
      return result;
  }

  function commadrop(str){

    if(typeof str == 'string' ){
      // seulement pour les chaînes, sinon plantage
      str =  str.split(',');
      str = str.join('.');
      floatnumber = parseFloat(str);
      // return float number
      return floatnumber;
    } else {
      // pas de TTT si pas une chaîne
      return str;
    }
  }
// variables init

  var montantavantremise = $('#pl_facturationbundle_facture_totFac').val();
// TTT chaine à virgule pour résultat attendu avec parseFloat()
montantavantremise =  commadrop(montantavantremise);


  $('#pl_facturationbundle_facture_avantremise').val(montantavantremise);
  var remiseeuros = $('#pl_facturationbundle_facture_remise').val();
  remiseeuros = commadrop(remiseeuros);
  if (remiseeuros == 0){
    $('#pl_facturationbundle_facture_remisepourcent').val(0);
    $('#pl_facturationbundle_facture_apresremise').val(montantavantremise);
  }
  if (remiseeuros > 0){
    var remise = remiseeuros;
    remise = commadrop(remise);
    console.log('Remise' + remise);

    console.log(' $montantavantremise' + montantavantremise )
    var apresremise = montantavantremise - remise;
    var remisepourcent = calculremisepourcent(montantavantremise,apresremise);
    $('#pl_facturationbundle_facture_remisepourcent').val(remisepourcent);
    $('#pl_facturationbundle_facture_apresremise').val(apresremise);
  }

//prog

//  console.log("montantavantremise" + montantavantremise );
  $('#pl_facturationbundle_facture_remise').change(function(){
    var remise = $(this).val();
    remise = commadrop(remise);
console.log("remise =" + remise + "Euros");
    var apresremise = montantavantremise - remise;
    var apresremise = Math.round((apresremise*100))/100;
console.log("apresremise =" + apresremise + "Euros");
    $('#pl_facturationbundle_facture_apresremise').val(apresremise);
    var remisepourcent = calculremisepourcent(montantavantremise,apresremise);
    $('#pl_facturationbundle_facture_remisepourcent').val(remisepourcent);
  }
);


$('#pl_facturationbundle_facture_remisepourcent').change(function(){
  var pourcent = $(this).val();
  if (pourcent == 0){
    $('#pl_facturationbundle_facture_apresremise').val(montantavantremise);
    $('#pl_facturationbundle_facture_remise').val(0);
  }else{
  pourcent = commadrop(pourcent);
  var remise = calculremiseeuros(montantavantremise,pourcent);
  var apresremise = montantavantremise - remise;
  //arrondi avec 2 virgules
  var apresremise = Math.round((apresremise*100))/100;
  $('#pl_facturationbundle_facture_apresremise').val(apresremise);
  $('#pl_facturationbundle_facture_remise').val(remise);
}
});

$('#lettrerappel').click(function(){
  var id = $(this).attr('data-id');
  var path = Routing.generate('pl_facturation_facture_lettre-rappel_pdf',{'id':id});
  $(location).attr('href',path);
  //window.open.attr('href',path);
});
$('#lettresimple').click(function(){
  var id = $(this).attr('data-id');
  var path = Routing.generate('pl_facturation_facture_lettre-rappel_pdf',{'id':id,'lettresimple':true});
  $(location).attr('href',path);
  //window.open.attr('href',path);
});

$('#facturepdf').click(function(){
  var id = $(this).attr('data-id');
  var path = Routing.generate('pl_facturation_facture_encours_pdf',{'id':id});
  $(location).attr('href',path);
});


$('#pl_facturationbundle_facture_rapFac').on('change',function(){
  var email = $('#confirmeremail').attr('data-email');
  var id = $('#confirmeremail').attr('data-id');
  var goemailrappel = true;
  if (($(this).is(':checked')) && (email != '') ){
      $('#preventemail').text('Souhaitez-vous envoyer le rappel à l\'adresse ' + email + ' ? ');
      $('#modalemail').modal('show');
      $('#confirmeremail').click(function(){
        var path = Routing.generate('pl_facturation_facture_encours_pdf',{
          'id':id,
          'goemailrappel':true,
          'email':email
        });

        $.get(path,goemailrappel,function(){},'json')
          .done(function(data) {
            var str = 'Email envoyé avec succès';
            var cl = 'success';
            alertinfo(str,cl);
          })
          .fail(function(xhr,status,error) {
            //var str = 'Erreur en production : '+ error  ;
            //var cl = 'warning';
          //alertinfo(str,cl);
          alert('Ca marche pas !');
          });

        $('#modalemail').modal('hide');
      });
  }
  if(($(this).is(':checked')) && (email == '') ) {
    $('#preventemail').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Impossible d\'envoyer le rappel par mail, pas d\'adresse.');
    $('#confirmeremail').hide();
    $('#modalemail').modal('show');
    $('#annuleremail').text('Ok');
  }
});

$('#annuleremail').click(function(){
  $('#modalemail').modal('hide');
});
