<p>Produits</p>
<?php
foreach ($datas['all_products'] as $product) : ?>
    <form action="/regardez_nos_produits" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <button name="redirect_product_info" type="submit">
            <div><?= $product['name'] ?></div>
            <div><?= $product['description'] ?></div>
            <div><?= $product['price'] ?> €</div>
        </button>
    </form>
<?php endforeach ?>