<form action="/informations_sur_le_produit" method="POST">
    <input type="hidden" name="product_id" value="<?= $datas['product_id'] ?>">
    <div><?= $datas['name'] ?></div>
    <div><?= $datas['description'] ?></div>
    <div><?= $datas['price'] ?> €</div>
    <input type="number" name="quantity" value="1">
    <input type="submit" name="add_to_order" value="Ajouter au panier">
</form>