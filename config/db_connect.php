<?php
//mysql connect
//conecta (servidor, usuario, senha, nome do banco)
$conn = mysqli_connect('localhost','root', '', 'pizza_santa');
//testa conexão
if(!$conn){
	echo 'Erro na conexão'.mysqli_connect_error();
}
?>
