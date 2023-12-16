<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <link rel="stylesheet" href="./public/styles/setup.css">
    <?php foreach ($styles as $style) : ?>
        <link rel="stylesheet" href="./public/styles/<?= $style ?>.css">
    <?php endforeach; ?>
</head>

<body>