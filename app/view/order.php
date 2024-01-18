<?php foreach ($datas['order_items'] as $item) : ?>
    <form action="/votre_panier" method="POST">
        <input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
        <div>Nom : <?= $item['name']; ?></div>
        <div>Image : <?= $item['image']; ?></div>
        <div>Quantité : <input type="text" name="quantity" value="<?= $item['quantity']; ?>"></div>
        <input type="submit" name="submit" value="Valider">
        <input type="submit" name="submit" value="Supprimer">
    </form>
<?php endforeach; ?>