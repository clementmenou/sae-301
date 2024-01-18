<form action="/manage" method="POST" class="form-container" enctype="multipart/form-data">
    <div class="form-title">Ajouter un parfum</div>

    <div class="input-label-area">
        <input type="file" name="insert_image" id="insert_image" accept="image/*" placeholder="" value="<?= $datas['insert']['image'] ?>">
        <div class="input-image">
            <label for="insert_image" class="input-image-content-container">
                <img class="input-image-content" src="" id="preview-image">
                <div class="input-image-content-add">+</div>
            </label>
        </div>
    </div>

    <div class="form-sub-container">
        <div class="input-label-area-medium">
            <input type="text" name="insert_name" id="insert_name" class="input-generic" placeholder="" value="<?= $datas['insert']['name'] ?>">
            <label class="label-generic" for="insert_name">Nom</label>
            <?php if ($datas['insert']['name_error']) : ?>
                <div>Nom déjà utilisé</div>
            <?php endif; ?>
        </div>

        <div class="input-label-area-small">
            <input type="text" name="insert_quantity" id="insert_quantity" class="input-generic" placeholder="" value="<?= $datas['insert']['quantity'] ?>">
            <label class="label-generic" for="insert_quantity">Quantité</label>
        </div>
    </div>

    <div class="input-label-area">
        <input type="text" name="insert_price" id="insert_price" class="input-generic" placeholder="" value="<?= $datas['insert']['price'] ?>">
        <label class="label-generic" for="insert_price">Prix</label>
    </div>

    <div class="input-label-area">
        <label class="label-generic">Familles</label>
        <input type="checkbox" value="1" name="insert_category[]">Hésperidés
        <input type="checkbox" value="2" name="insert_category[]">Fleuris
        <input type="checkbox" value="3" name="insert_category[]">Boisés
        <input type="checkbox" value="4" name="insert_category[]">Fougeres
        <input type="checkbox" value="5" name="insert_category[]">Chypres
        <input type="checkbox" value="6" name="insert_category[]">Orientaux
        <input type="checkbox" value="7" name="insert_category[]">Aromatiques
    </div>

    <div class="input-label-area">
        <textarea class="input-generic" name="insert_description" id="insert_description" cols="30" rows="10"><?= $datas['insert']['description'] ?></textarea>
        <label class="label-generic" for="insert_description">Description</label>
    </div>

    <input type="submit" value="Ajouter" class="button-generic">
</form>

<form action="/manage" method="POST" class="form-container">
    <div class="form-title">Modifier la quantité d'un produit</div>

    <div class="form-sub-container">
        <div class="input-label-area-medium">
            <select name="update_name" id="update_name" class="input-generic">
                <?php foreach ($datas['liste_name_product'] as $product) : ?>
                    <option value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <label class="label-generic" for="update_name">Nom</label>
        </div>

        <div class="input-label-area-small">
            <div class="all-quantity">
                <?php foreach ($datas['liste_name_product'] as $product) : ?>
                    <div><?= $product['stock_quantity'] ?></div>
                <?php endforeach; ?>
            </div>
            <input type="text" name="update_quantity" id="update_quantity" class="input-generic" value="" placeholder="">
            <label class="label-generic" for="update_quantity">Quantité</label>
        </div>
    </div>

    <input type="submit" value="Modifier" class="button-generic">
</form>

<form action="/manage" method="POST" class="form-container">
    <div class="form-title">Supprimer un parfum</div>

    <div class="input-label-area">
        <select name="delete_name" id="delete_name" class="input-generic">
            <?php foreach ($datas['liste_name_product'] as $product) : ?>
                <option value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <label class="label-generic" for="delete_name">Nom</label>
    </div>

    <input type="submit" value="Supprimer" class="button-generic">
</form>

<form action="/manage" method="POST" class="form-container">
    <div class="form-title">Ajouter promotion</div>

    <div class="form-sub-container">
        <div class="input-label-area-medium">
            <select name="delete_name" id="delete_name" class="input-generic">
                <?php foreach ($datas['liste_name_product'] as $product) : ?>
                    <option value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <label class="label-generic" for="delete_name">Nom</label>
        </div>

        <div class="input-label-area-small">
            <input type="text" name="update_quantity" id="update_quantity" class="input-generic" placeholder="">
            <label class="label-generic" for="update_quantity">Quantité</label>
        </div>
    </div>
</form>

<div>
    <?php foreach ($datas['order_ordered'] as $order) : ?>
        <div>
            <?= $order['first_name'] ?>
            <?= $order['last_name'] ?>
            <?= $order['street'] ?>
            <?= $order['order_date'] ?>
        </div>
    <?php endforeach; ?>
</div>