<?php 

$json= file_get_contents('https://xkcd.com/info.0.json');

$fdata= json_decode($json, true);

echo "<pre>";
print_r($fdata);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usando Api</title>
</head>
<body>
    
    <!-- Imprime los datos de la variable $fdata -->

    <h1><?= $fdata['title'];?></h1>

    <img src="<?= $fdata['img']; ?>" alt="<?= $fdata['alt']; ?>">

    <p><?= $fdata['alt']; ?> </p>

</body>
</html>