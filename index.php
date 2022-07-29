<?php // abre PHP

include('config/db_connect.php');

//Seleciona todos os registros da tabela PIZZA
//$sql = 'SELECT *FROM pizzas';
$sql = 'SELECT title, ingredientes, id FROM pizzas ORDER BY created_at';
//pega os resultados
$result=mysqli_query($conn, $sql);
//mostrar as linhas em um array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
//fecha conexão
mysqli_close($conn);
//print_r($pizzas);
//fecha php
?>


<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<h4 class="center grey-text">Pizzas</h4>
<div class="container">
	<div class="row">
		<?php foreach($pizzas as $pizza): ?>
		<div class="col s6 md3">
			<div class="card z-depth-1">
			<div class="card-content center">
			<div style='position:absolute; top:-40px; left:185px;'>
			<img src="img/pizza.svg" title="Pizza!" /> 
			</div>
			<div style='position:relative; top:30px; left:0px;'>		
			<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
			<ul class="grey-text">
				<?php foreach(explode(',', $pizza['ingredientes']) as $ing): ?>

					<li><?php echo htmlspecialchars($ing); ?> </li>
				<?php endforeach; ?> 
			</ul>
			</div>
			</div>	
			<div class="card-action right-align">
				<a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">Mais Info</a>	
			</div>
		</div>	
		</div>
		<?php endforeach; ?>
	</div>
</div>

<?php include('templates/footer.php');?>
</body>
</html>