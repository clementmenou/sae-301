<div class="page-content">
    <form action="/informations_sur_le_produit" method="POST" class="product-container">
        <input type="hidden" name="product_id" value="<?= $datas['product_id'] ?>">
        <div class="product-img-container"><img src="Public/Images/Products/<?= $datas['image'] ?>" alt="<?= $datas['name'] ?>"></div>
        <div class="product-info-container">
            <div class="product-info-title"><?= $datas['name'] ?></div>
            <div class="product-info-price"><?= $datas['price'] ?> €</div>
            <div class="product-info-input-container">
                <div class="input-label-area-extra-small">
                    <div id="button-quantity1" class="button-generic button-quantity">-</div>
                    <input type="text" name="quantity" value="1" id="input-quantity" class="input-generic product-info-quantity">
                    <div id="button-quantity2" class="button-generic button-quantity">+</div>
                </div>
                <input type="submit" name="add_to_order" value="Ajouter au panier" class="button-generic">
            </div>
            <div class="product-info-description"><?= $datas['description'] ?></div>
        </div>
    </form>

    <form action="/informations_sur_le_produit" method="POST" class="comment-insert-container">
        <?php if (!isset($_SESSION['user_id'])) : ?>
            <button name="redirect_login" type="submit" value="redirect" class="button-comment-redirect comment-insert-container">
            <?php endif; ?>
            <input type="hidden" name="product_id" value="<?= $datas['product_id'] ?>">

            <textarea name="text" class="input-generic" cols="30" rows="5"></textarea>
            <div class="comment-sub-container">
                <div class="comment-star-container-insert">
                    <label for="input-rating-1"><img class="comment-star-insert" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-2"><img class="comment-star-insert" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-3"><img class="comment-star-insert" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-4"><img class="comment-star-insert" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-5"><img class="comment-star-insert" src="Public/Images/icon-star.png" alt="image étoile"></label>
                </div>
                <input type="radio" name="rating" value="1" id="input-rating-1" class="input-rating-insert">
                <input type="radio" name="rating" value="2" id="input-rating-2" class="input-rating-insert">
                <input type="radio" name="rating" value="3" id="input-rating-3" class="input-rating-insert">
                <input type="radio" name="rating" value="4" id="input-rating-4" class="input-rating-insert">
                <input type="radio" name="rating" value="5" id="input-rating-5" class="input-rating-insert" checked>

                <input type="submit" value="Envoyer" class="button-small">
            </div>
            <?php if (!isset($_SESSION['user_id'])) : ?>
            </button>
        <?php endif; ?>
    </form>

    <?php foreach ($datas['all_reviews'] as $review) : ?>
        <form action="/informations_sur_le_produit" method="POST" class="comment-container-update">
            <input type="hidden" name="review_id" value="<?= $review['review_id'] ?>">
            <div class="comment-head">
                <div><?= $review['user'] ?></div>
                <div><?= $review['date'] ?></div>
                <?php if (!$review['display_modify']) : ?>
                    <div>
                        <?php for ($i = 1; $i <= $review['rating']; $i++) : ?>
                            <img class="comment-star-head" src="Public/Images/icon-star.png" alt="image étoile">
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!$review['display_modify']) : ?>
                <div>
                    <div><?= $review['text'] ?></div>
                </div>
            <?php else : ?>
                <div class="comment-star-container-update">
                    <label for="input-rating-6"><img class="comment-star-update" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-7"><img class="comment-star-update" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-8"><img class="comment-star-update" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-9"><img class="comment-star-update" src="Public/Images/icon-star.png" alt="image étoile"></label>
                    <label for="input-rating-10"><img class="comment-star-update" src="Public/Images/icon-star.png" alt="image étoile"></label>
                </div>
                <input type="radio" name="rating_modify" id="input-rating-6" value="1" class="input-rating-update">
                <input type="radio" name="rating_modify" id="input-rating-7" value="2" class="input-rating-update">
                <input type="radio" name="rating_modify" id="input-rating-8" value="3" class="input-rating-update">
                <input type="radio" name="rating_modify" id="input-rating-9" value="4" class="input-rating-update">
                <input type="radio" name="rating_modify" id="input-rating-10" value="5" class="input-rating-update" checked>
                <textarea name="text_modify" class="input-generic" cols="30" rows="5"><?= $review['text'] ?></textarea>
            <?php endif; ?>

            <?php if ($review['display_controls'] && !$review['display_modify']) : ?>
                <div class="comment-button-container">
                    <input type="submit" name="modify_review" value="Modifier" class="button-small">
                    <input type="submit" name="delete_review" value="Supprimer" class="button-small button-suppr">
                </div>
            <?php elseif ($review['display_controls']) : ?>
                <input type="submit" name="modify_review" value="Enregistrer" class="button-small">
            <?php endif; ?>
        </form>
    <?php endforeach; ?>
</div>