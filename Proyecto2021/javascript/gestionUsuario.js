"use strict";
$(document).ready(function() {
	/*Peticion ajax con array de videojuegos*/
	//var ar = <?php echo json_encode($ar) ?>;
	comprobarUsuario(ar);

	function comprobarUsuario(oDatos) {

		if (oDatos[0] == "Ninguno") {
			document.getElementById('Perfil').style.display = 'none';
			document.getElementById('Carrito').style.display = 'none';
			document.getElementById('Lista').style.display = 'none';
			document.getElementById('Logout').style.display = 'none';
			document.getElementById('Add').style.display = 'none';
			document.getElementById('Signup').style.display = 'initial';
			document.getElementById('Login').style.display = 'initial';

			var comprar = document.getElementsByClassName("Comprar");
			var i;
			for (i = 0; i < comprar.length; i++) {
				comprar[i].style.display = "none";
			}
			var eliminar = document.getElementsByClassName("Eliminar");
			var i;
			for (i = 0; i < eliminar.length; i++) {
				eliminar[i].style.display = "none";
			}
			var Modificar = document.getElementsByClassName("Modificar");
			var i;
			for (i = 0; i < Modificar.length; i++) {
				Modificar[i].style.display = "none";
			}
			var ListaDeseados = document.getElementsByClassName("ListaDeseados");
			var i;
			for (i = 0; i < ListaDeseados.length; i++) {
				ListaDeseados[i].style.display = "none";
			}
		} else {
			document.getElementById('Login').style.display = 'none';
			document.getElementById('Perfil').style.display = 'initial';
			document.getElementById('Signup').style.display = 'none';

			if (oDatos[1] == '0') {
				var eliminar = document.getElementsByClassName("Eliminar");
				var i;
				for (i = 0; i < eliminar.length; i++) {
					eliminar[i].style.display = "none";
				}
				var Modificar = document.getElementsByClassName("Modificar");
				var i;
				for (i = 0; i < Modificar.length; i++) {
					Modificar[i].style.display = "none";
				}
				document.getElementById('Add').style.display = 'none';
			} else {
				if (oDatos[1] == '1') {
					document.getElementById('Lista').style.display = 'none';
					document.getElementById('Carrito').style.display = 'none';
					document.getElementById('Add').style.display = 'initial';

					var ListaDeseados = document.getElementsByClassName("ListaDeseados");
					var i;
					for (i = 0; i < ListaDeseados.length; i++) {
						ListaDeseados[i].style.display = "none";
					}
					var comprar = document.getElementsByClassName("Comprar");
					var i;
					for (i = 0; i < comprar.length; i++) {
						comprar[i].style.display = "none";
					}
				}
			}
		}
	}
});