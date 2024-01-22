<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <link rel="stylesheet" href="./Public/Styles/setup.css">
    <link rel="stylesheet" href="./Public/Styles/variables/<?= $_SESSION['fragrance'] ?>.css">
    <?php foreach ($styles as $style) : ?>
        <link rel="stylesheet" href="./Public/Styles/<?= $style ?>">
    <?php endforeach; ?>
    <link rel="icon" href="./Public/Images/favicon.ico" type="image/x-icon">
</head>

<body>