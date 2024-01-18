<div class="page-content-center">

    <form action="/votre_lieu_de_livraision" method="POST" class="form-container form-choice-address">
        <div class="form-title">Choisir l'adresse de livraison</div>
        <?php foreach ($datas['user_addresses'] as $address) : ?>
            <label class="address-order-choice" for="address-order-<?= $address['address_id'] ?>">
                <input type="radio" name="address_order" id="address-order-<?= $address['address_id'] ?>" value="<?= $address['address_id'] ?>">
                <div><?= $address['street'] ?> - <?= $address['city'] ?> - <?= $address['country'] ?></div>
                <div class="button-small button-adress-choice" data-address-id="<?= $address['address_id'] ?>">Modifier</div>
            </label>
        <?php endforeach; ?>
        <div class="address-add">+</div>
        <input type="submit" value="Continuer" class="button-generic">
    </form>
    <form action="/votre_lieu_de_livraision" method="POST" class="form-container form-add-address">
        <div class="form-go-back">←</div>
        <div class="form-title">Ajouter un lieu de livraison</div>

        <div class="input-label-area">
            <input type="text" class="input-generic" name="insert_street" placeholder="" value="<?= $datas['insert']['street'] ?>">
            <label class="label-generic">Adresse</label>
        </div>
        <div class="form-sub-container">
            <div class="input-label-area-medium ">
                <input type="text" class="input-generic" name="insert_city" placeholder="" value="<?= $datas['insert']['city'] ?>">
                <label class="label-generic">Ville</label>
            </div>
            <div class="input-label-area-small">
                <input type="text" class="input-generic" name="insert_zip_code" placeholder="" value="<?= $datas['insert']['zip_code'] ?>">
                <label class="label-generic">Code postal</label>
            </div>
        </div>
        <div class="input-label-area">
            <input type="text" class="input-generic" name="insert_country" placeholder="" value="<?= $datas['insert']['country'] ?>">
            <label class="label-generic">Pays</label>
        </div>
        <input type="submit" name="insert" value="Ajouter" class="button-generic">
    </form>

    <?php foreach ($datas['user_addresses'] as $address) : ?>
        <form action="/votre_lieu_de_livraision" method="POST" class="form-container form-modif-address form-modif-address<?= $address['address_id'] ?>">
            <div class="form-title">Modifier</div>

            <input type="hidden" name="address_id" placeholder="" value="<?= $address['address_id'] ?>">
            <div class="form-go-back">←</div>

            <div class="input-label-area">
                <input type="text" class="input-generic" name="street" placeholder="" value="<?= $address['street'] ?>">
                <label class="label-generic">Adresse</label>
            </div>

            <div class="form-sub-container">
                <div class="input-label-area-medium">
                    <input type="text" class="input-generic" name="city" placeholder="" value="<?= $address['city'] ?>">
                    <label class="label-generic">Ville</label>
                </div>
                <div class="input-label-area-small">
                    <input type="text" class="input-generic" name="zip_code" placeholder="" value="<?= $address['zip_code'] ?>">
                    <label class="label-generic">Code postal</label>
                </div>
            </div>

            <div class="input-label-area">
                <input type="text" class="input-generic" name="country" placeholder="" value="<?= $address['country'] ?>">
                <label class="label-generic">Pays</label>
            </div>

            <input type="submit" name="update" value="Modifier" class="button-generic">
            <input type="submit" name="delete" value="Supprimer" class="button-generic button-suppr">
        </form>
    <?php endforeach; ?>
</div>