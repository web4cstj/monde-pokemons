<?php
include("../autoload.php");
if (!isset($_GET['id'])) {
	header("location:index.php");
	exit;
}
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="pokemon.css" />
	<title>Monde Pokémons</title>
</head>

<body>
	<div id="app">
		<header>
			<h1>Monde Pokémons</h1>
		</header>
		<footer>Intégration Web 3</footer>
		<nav><a href="index.php">Retour à la liste</a></nav>
		<div class="body">
			<?php echo Pokemon::html_details($id); ?>
		</div>
	</div>
</body>

</html>