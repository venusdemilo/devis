$('.panel-footer').hide();
$('input[type=checkbox]').prop('checked',false);

var arr = new Array();
/////
function formatMoney(num , localize,fixedDecimalLength){
          num=num+"";
   var str=num;
          var reg=new RegExp(/(\D*)(\d*(?:[\.|,]\d*)*)(\D*)/g)
          if(reg.test(num)){
       var pref=RegExp.$1;
       var suf=RegExp.$3;
       var part=RegExp.$2;
             if(fixedDecimalLength/1)part=(part/1).toFixed(fixedDecimalLength/1);
      if(localize)part=(part/1).toLocaleString();
str= pref +part.match(/(\d{1,3}(?:[\.|,]\d*)?)(?=(\d{3}(?:[\.|,]\d*)?)*$)/g ).join(' ')+suf ;
     };
  return str;
}


//////
$('input[type=checkbox]').click(
function(){
//$('#tableau').dataTable();
  var produitId = $(this).attr('id');
  var id=$(this).attr('id');
  var value=$(this).attr('value');
  var refProd=$(this).attr('data-refprod');
  //value=Math.round(value*100)/100;
  value = formatMoney(value,false,2);
  //var label=$(this).parent().text();
  /////
  function calculTotal(){
    var sum = 0;
    $('#devis td.soustotal').each(function(){
        var maVar = $(this).text();
        sum += parseFloat(maVar);
      });
      sum = Math.round(sum*100)/100;
    //sum=formatMoney(sum,false,2);
      return sum;
  }
  //////
  function toggleFooter(){
    //nombre de lignes du tableau (1 par défaut)
    var tr = $('#tableau tr').length;
    if (tr > 1){
      $('.panel-footer').fadeIn(1000);
    }
    else{
      $('.panel-footer').hide();
    }
  }
  /////
  /* Uncomment for debug usage only

  function lireTableau(arr){
    text="";
    $.each(arr,function(k,l){
      text+= k +' => '+ l +'<br>' ;
    })
    $('#test').html(text);
  }
  */
  /////
  if($(this).prop('checked')){
    $('#devis').append('<tr class=\"'+id+'\"><td>'+refProd+'</td><td>'+value+'</td><td><input data-prixunitaire=\"'+value+'\" data-produitid=\"'+id+'\" class=\"input-sm\" type=\"number\" style="width:50px;"  value= \"1\"  min="1" max="9"></td><td class=\"'+id+' soustotal\">'+value+'</td></tr>');
    toggleFooter();

    arr[produitId]=1;
    /* Uncomment for debug usage only
    lireTableau(arr);
      $('#test').prepend('coucou !<br>');
      */


      var total = calculTotal();
      total = formatMoney(total);
      $('#total h3').text('Total = '+total+' €');

  }
  /////
  $('#devis input').change(function(){
    quantite = $(this).val();
    var value =$(this).data('prixunitaire');
    var sousTotal = value*quantite;
    var produitID = $(this).data('produitid');
    sousTotal = Math.round(sousTotal*100)/100;
    $(this).parent().next().html(sousTotal);
    var total = calculTotal();
    $('#total h3').text('Total = '+total+' €');
    arr[produitID]=quantite;
    /* Uncomment for debug usage only
    lireTableau(arr);
    $('#test').prepend('ID du produit : ' + produitID +' - Quantité : '+ quantite +'<br>');
    */
  });

  if(!$(this).prop('checked')){
    arr[produitId]='';
    $('#devis tr.'+id).remove();
    toggleFooter();
    var total = calculTotal();
    $('#total h3').text('Total = '+total+' €');
    /* Uncomment for debug usage only
    lireTableau(arr);
    */
  }
});

$('#datastoker').click(
  function(){
    var drtFam = $(this).data('drtfam');
    var idClient = $('#accordeon').data('carnetid');
    var donneesAenvoyer =JSON.stringify(arr);
    //$.post(Routing.generate('pl_facturation_devis_record'),{obj:donneesAenvoyer,idCar:idClient,drtFam:drtFam});
    $.post(
      Routing.generate('pl_facturation_devis_record'),
      {obj:donneesAenvoyer,idCar:idClient,drtFam:drtFam},
      function(data,status,xhr){},
      'json'
    )
    .done(

      $(location).attr('href',Routing.generate('pl_facturation_devis_index'))
    )
    .fail(function(xhr,status,error){
      var str = 'Echec création devis : '+ error  ;
      var cl = 'warning';
      alertinfo(str,cl);
    });


  });

  $('#raz').click(
    function(){
      arr.length=0;

      $('.panel-footer').hide();
      $('tr:not(:first)').remove();
      $('input[type=checkbox]').prop('checked',false);

    });
