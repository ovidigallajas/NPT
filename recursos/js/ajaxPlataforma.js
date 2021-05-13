function comprobarDuplicadoPlataforma(){
	var nombre=document.getElementsByName("nombre")[0].value
	$.ajax({
		url:   'ConsultaPlataforma.php?nombre='+nombre,
		type:  'get',
		datatype: 'php',
		async: 'true',
		success:  function (datos) {
			//document.getElementById("demo").innerHTML = datos;
			alert(datos);
		}
	});
}
