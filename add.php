<?php

include('config/db_connect.php');

$email = $telefone = $title = $ingredientes= '';
$errors = array('email'=>'', 'telefone'=>'', 'title'=>'','ingredientes'=>'');
if(isset($_POST['submit'])){
//check email (caso o email estiver vazio exibe a mensagem)
	if(empty($_POST['email'])){
		$errors['email']= 'Um email é necessario para prosseguir</br>';
	}else{
		$email = $_POST['email']; 
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email']='O Email precisa ser valido';
		}
	}// Checagem de telefone
	if(empty($_POST['telefone'])){
		$errors['telefone']='O telefone precisa ser valido ';
	}else{
		$telefone=$_POST['telefone'];
		if(!preg_match("/[0-9]{10,11}/", $telefone)){
			$errors['telefone']='O telefone precisa ser valido';
		}
	}
	// check pizza(caso o campo nome da pizza esteja vazio exibe a mensagem)
	if (empty($_POST['title'])){
		$errors['title']= 'Um nome de Pizza é necessario </br>';
	}else{
		$title=$_POST['title'];
		if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
			$errors['title']='O Nome da Pizza deve conter somente letras e espaços';
		}
	}// Check ingredientes (caso o campo ingredientes for vazio exibe a mensagem)
	if(empty($_POST['ingredientes'])){
		$errors['ingredientes']=' Um ingrediente é necessario <br/>';
	}else{
	$ingredientes= $_POST['ingredientes'];
if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredientes)){
	$errors['ingredientes']= 'Os ingredientes devem ser colocados em lista e separados por virgula';
}
}
if (array_filter($errors)){
	//echo 'há erros no formulario';
}else{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$ingredientes = mysqli_real_escape_string($conn, $_POST['ingredientes']);
		//cria Sql
		$sql = "INSERT INTO pizzas(title, email, ingredientes, telefone) VALUES('$title', '$email', '$ingredientes',  '$telefone')";
		//salve no db e check
		if(mysqli_query($conn, $sql)){//Sucesso
			header('Location: index.php');

		}else{
			//erro
			echo 'query error:' .mysqli_error($conn);
		}

		//echo 'Formulario valido';
		//header('Location: index.php');
	}
}// final das checagens

?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php');?>
<section class="container grey-text">
	<h4 class="center">Adicione a Pizza</h4>
	<form class="white" action="add.php" method="POST">
		<label>Email:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>

		<label>Telefone:</label>
		<input type="text" name="telefone" value="<?php echo htmlspecialchars($telefone)?>">
		<div class="red-text"><?php echo $errors['telefone']; ?></div>
		<label>Nome da Pizza:</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
		<div class="red-text"><?php echo $errors['title']; ?></div>
		<label>Ingredientes:</label>
		<input type="text" name="ingredientes" value="<?php echo htmlspecialchars($ingredientes)?>">
		<div class="red-text"><?php echo $errors['ingredientes']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>
<?php include('templates/footer.php');?>
</body>
</html>