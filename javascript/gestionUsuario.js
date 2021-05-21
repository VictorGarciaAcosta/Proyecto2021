"use strict";
$(document).ready(function () {
	
	comprobarUsuario(ar);
	function comprobarUsuario(oDatos) {
		alert(oDatos);
		if (oDatos[0] == "Ninguno") {
			document.getElementById('Perfil').style.display = 'none';
			document.getElementById('Comprar').style.display = 'none';
			document.getElementById('Eliminar').style.display = 'none';
			document.getElementById('Modificar').style.display = 'none';
			document.getElementById('ListaDeseados').style.display = 'none';
			document.getElementById('Login').style.display = 'initial';
		}
		else {
			document.getElementById('Login').style.display = 'none';
			document.getElementById('Perfil').style.display = 'initial';

			if (oDatos[1] == '0') {
				document.getElementById('Modificar').style.display = 'none';
				document.getElementById('Eliminar').style.display = 'none';
			}
			else {
				if (oDatos[1] == '1') {
					document.getElementById('ListaDeseados').style.display = 'none';
					document.getElementById('Comprar').style.display = 'none';
				}
			}
		}
	}
	//$.get("asignarUsuarios.php",comprobarUsuario,'json');

});