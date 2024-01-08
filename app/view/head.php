<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title><?= $title ?></title>

    <link rel="stylesheet" href="./public/styles/setup.css">
    <link rel="stylesheet" href="./public/styles/variables/<?= $_SESSION['fragrance'] ?>.css">
    <?php foreach ($styles as $style) : ?>
        <link rel="stylesheet" href="./public/styles/<?= $style ?>">
    <?php endforeach; ?>
    <link rel="icon" href="./public/images/favicon.ico" type="image/x-icon">
</head>

<body>