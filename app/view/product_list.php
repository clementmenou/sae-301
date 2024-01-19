<form action="/regardez_nos_produits" method="POST" class="product-sort-container">
    <?php if ($datas['sort']['prix']) : ?>
        <button type="submit" name="price_asc" value="1" class="product-sort-button">
            <div>Prix</div>
            <svg viewBox="0 0 24 24" focusable="false" class="product-sort-svg">
                <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" stroke-linecap="round"></path>
            </svg>
        </button>
    <?php else : ?>
        <button type="submit" name="price_desc" value="1" class="product-sort-button">
            <div>Prix</div>
            <svg viewBox="0 0 24 24" focusable="false" class="product-sort-svg product-sort-svg-inverted">
                <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" stroke-linecap="round"></path>
            </svg>
        </button>
    <?php endif;
    if ($datas['sort']['quantity']) : ?>
        <button type="submit" name="quantity_asc" value="1" class="product-sort-button">
            <div>Quantité</div>
            <svg viewBox="0 0 24 24" focusable="false" class="product-sort-svg">
                <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" stroke-linecap="round"></path>
            </svg>
        </button>
    <?php else : ?>
        <button type="submit" name="quantity_desc" value="1" class="product-sort-button">
            <div>Quantité</div>
            <svg viewBox="0 0 24 24" focusable="false" class="product-sort-svg product-sort-svg-inverted">
                <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" stroke-linecap="round"></path>
            </svg>
        </button>
    <?php endif;
    if ($datas['sort']['promo']) : ?>
        <button type="submit" name="promo_asc" value="1" class="product-sort-button">
            <div>Promotions</div>
            <svg viewBox="0 0 24 24" focusable="false" class="product-sort-svg">
                <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" stroke-linecap="round"></path>
            </svg>
        </button>
    <?php else : ?>
        <button type="submit" name="promo_desc" value="1" class="product-sort-button">
            <div>Promotions</div>
            <svg viewBox="0 0 24 24" focusable="false" class="product-sort-svg product-sort-svg-inverted">
                <path d="M 3,9 12,18 21,9" stroke="black" stroke-width="3" fill="none" stroke-linecap="round"></path>
            </svg>
        </button>
    <?php endif; ?>
</form>

<div class="product-list-container">
    <?php foreach ($datas['all_products'] as $product) : ?>
        <form action="/regardez_nos_produits" method="POST">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <button name="redirect_product_info" type="submit" class="product-container">
                <img src="Public/Images/Products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <div class="product-info">
                    <div class="product-name"><?= $product['name'] ?></div>
                    <div class="product-price"><?= $product['price'] ?> €</div>
                </div>
            </button>
        </form>
    <?php endforeach ?>
</div>