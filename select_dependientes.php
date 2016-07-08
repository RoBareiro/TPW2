<?php
function generaPaises()
{
	include 'conexion.php';
	conectar();
	$consulta=mysqli_query("SELECT id, opcion FROM lista_paises");
	desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysqli_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}
?>

