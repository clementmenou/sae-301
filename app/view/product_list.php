<p>Produits</p>
<?php
foreach ($datas['all_products'] as $product) : ?>
    <div>
        <div><?= $product['name'] ?></div>
        <div><?= $product['description'] ?></div>
        <div><?= $product['price'] ?> €</div>
    </div>
<?php endforeach ?>