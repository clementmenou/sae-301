<p>Produits</p>
<?php
foreach ($datas['all_products'] as $product) : ?>
    <form action="/regardez_nos_produits" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <div><?= $product['name'] ?></div>
        <div><?= $product['description'] ?></div>
        <div><?= $product['price'] ?> €</div>
        <input type="number" name="quantity" value="1">
        <input type="submit" name="add_to_order" value="Ajouter au panier">
    </form>
<?php endforeach ?>