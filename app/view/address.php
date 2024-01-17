<form action="/address" method="POST" class="form-container">
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

<?php
$i = 1;
foreach ($datas['user_addresses'] as $address) :
?>
    <form action="/address" method="POST" class="form-container">
        <div class="form-title">Adresse n°<?= $i ?></div>

        <input type="hidden" name="address_id" placeholder="" value="<?= $address['address_id'] ?>">

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
<?php
    $i += 1;
endforeach;
?>