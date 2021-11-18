$(obtener_registros());

function obtener_registros(consulta){
  $.ajax({
    url:'views/admin/function/index_individual.php',
    type:'POST',
    dataType:'html',
    data:{consulta: consulta},
  })
  .done(function(resultado){
    $("#busquedaindividual").html(resultado);
  })
}

$(document).on('keyup','#caja_busqueda_individual',function(){
  var valor = $(this).val();
	if (valor != "") {
		obtener_registros(valor);
	}else{
		obtener_registros();
	}
});