<?php
function conectar()
{
	mysql_connect("localhost", "root", "");
	mysql_select_db("revista");
}

function desconectar()
{
	mysql_close();
}
?>