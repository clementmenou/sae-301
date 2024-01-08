<form action="/informations_sur_le_produit" method="POST">
    <input type="hidden" name="product_id" value="<?= $datas['product_id'] ?>">
    <div><?= $datas['name'] ?></div>
    <div><?= $datas['description'] ?></div>
    <div><?= $datas['price'] ?> €</div>
    <input type="number" name="quantity" value="1">
    <input type="submit" name="add_to_order" value="Ajouter au panier">
</form>

<form action="/informations_sur_le_produit" method="POST">
    <?php if (!isset($_SESSION['user_id'])) : ?>
        <button name="redirect_login" type="submit" value="redirect">
        <?php endif; ?>
        <input type="hidden" name="product_id" value="<?= $datas['product_id'] ?>">
        <input type="radio" name="rating" value="1">
        <input type="radio" name="rating" value="2">
        <input type="radio" name="rating" value="3">
        <input type="radio" name="rating" value="4">
        <input type="radio" name="rating" value="5" checked>
        <textarea name="text" cols="30" rows="10"></textarea>
        <input type="submit" value="Envoyer">
        <?php if (!isset($_SESSION['user_id'])) : ?>
        </button>
    <?php endif; ?>
</form>

<?php foreach ($datas['all_reviews'] as $review) : ?>
    <form action="/informations_sur_le_produit" method="POST">
        <input type="hidden" name="review_id" value="<?= $review['review_id'] ?>">
        <div><?= $review['user'] ?></div>
        <div><?= $review['date'] ?></div>

        <?php if (!$review['display_modify']) : ?>
            <div><?= $review['text'] ?></div>
            <div><?= $review['rating'] ?></div>
        <?php else : ?>
            <textarea name="text_modify" cols="30" rows="10"><?= $review['text'] ?></textarea>
            <input type="radio" name="rating_modify" value="1">
            <input type="radio" name="rating_modify" value="2">
            <input type="radio" name="rating_modify" value="3">
            <input type="radio" name="rating_modify" value="4">
            <input type="radio" name="rating_modify" value="5" checked>
        <?php endif; ?>

        <?php if ($review['display_controls'] && !$review['display_modify']) : ?>
            <input type="submit" name="modify_review" value="Modifier">
            <input type="submit" name="delete_review" value="Supprimer">
        <?php elseif ($review['display_controls']) : ?>
            <input type="submit" name="modify_review" value="Enregistrer">
        <?php endif; ?>
    </form>
<?php endforeach; ?>