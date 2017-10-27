var tab = new Array();
$('#validerobservation').click(
  function(){
    $("#tableauproduitdevis input").each(
      function(){
        if ($(this).val() !== ''){
        tab[$(this).attr('id')] = $(this).val();
      }
      }
    );
    var idDev = $(this).attr('data-iddev');
    var donneesAenvoyer =JSON.stringify(tab);


  $.ajax({
    type:'POST',
    url:Routing.generate('pl_facturation_produit_devis_record'),
    data:{obj:donneesAenvoyer},
    dataType:'json',
    timeout:3000,
    success : function(){
      $(location).attr('href',Routing.generate('pl_facturation_produit_devis_show',{'id':idDev}));    
    }
    ,
    error: function(){
        alert ('il y a un problème');
    }
  });


  });
