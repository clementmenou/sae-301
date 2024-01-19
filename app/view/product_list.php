<p>Produits</p>
<form action="/regardez_nos_produits" method="POST">
    <button type="submit" name="price_asc" value="1">
        <div>Prix</div>
        <svg viewBox="0 0 24 24" focusable="false" class="">
            <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" class="" stroke-linecap="round"></path>
        </svg>
    </button>
    <button type="submit" name="price_desc" value="1">
        <div>Prix</div>
        <svg viewBox="0 0 24 24" focusable="false" class="">
            <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" class="" stroke-linecap="round"></path>
        </svg>
    </button>
    <button type="submit" name="quantity_asc" value="1">
        <div>Prix</div>
        <svg viewBox="0 0 24 24" focusable="false" class="">
            <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" class="" stroke-linecap="round"></path>
        </svg>
    </button>
    <button type="submit" name="quantity_desc" value="1">
        <div>Prix</div>
        <svg viewBox="0 0 24 24" focusable="false" class="">
            <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" class="" stroke-linecap="round"></path>
        </svg>
    </button>
    <button type="submit" name="promo_asc" value="1">
        <div>Prix</div>
        <svg viewBox="0 0 24 24" focusable="false" class="">
            <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" class="" stroke-linecap="round"></path>
        </svg>
    </button>
    <button type="submit" name="promo_desc" value="1">
        <div>Prix</div>
        <svg viewBox="0 0 24 24" focusable="false" class="">
            <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" class="" stroke-linecap="round"></path>
        </svg>
    </button>

</form>

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