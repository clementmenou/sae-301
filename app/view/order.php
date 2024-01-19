<div class="page-content">
    <?php
    if ($datas['order_items']) {
        foreach ($datas['order_items'] as $item) : ?>
            <form action="/votre_panier" method="POST" class="product-container">
                <input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
                <div><img src="Public/Images/Products/<?= $item['image']; ?>" class="product-image" alt="<?= $item['name']; ?>"></div>
                <div class="product-sub-container">
                    <div><?= $item['name']; ?></div>
                    <div class="input-quantity">
                        <div id="button-quantity1" class="button-generic button-quantity">-</div>
                        <input type="text" name="quantity" value="<?= $item['quantity']; ?>" id="input-quantity" class="input-generic product-info-quantity">
                        <div id="button-quantity2" class="button-generic button-quantity">+</div>
                    </div>
                </div>
                <div class="product-sub-container">
                    <div><?= $item['price']; ?> €</div>
                    <input type="submit" name="submit" value="Modifier" class="button-modifier">

                    <input type="submit" name="submit" value="Supprimer" class="button-small button-suppr">
                </div>
            </form>
        <?php endforeach; ?>
        <a href="/votre_lieu_de_livraision" class="link-address">Passer la commande</a>
    <?php
    } else { ?>
        <div>
            Panier vide
        </div>
    <?php } ?>
</div>