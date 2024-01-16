<form action="/address" method="POST">
    <div>Street</div>
    <input type="text" name="insert_street" value="<?= $datas['insert']['street'] ?>">
    <div>City</div>
    <input type="text" name="insert_city" value="<?= $datas['insert']['city'] ?>">
    <div>Zip_code</div>
    <input type="text" name="insert_zip_code" value="<?= $datas['insert']['zip_code'] ?>">
    <div>Region</div>
    <input type="text" name="insert_region" value="<?= $datas['insert']['region'] ?>">
    <div>Country</div>
    <input type="text" name="insert_country" value="<?= $datas['insert']['country'] ?>">
    <input type="submit" name="insert" value="Ajouter">
</form>

<?php foreach ($datas['user_addresses'] as $address) : ?>
    <form action="/address" method="POST">
        <input type="hidden" name="address_id" value="<?= $address['address_id'] ?>">
        <div>Street</div>
        <input type="text" name="street" value="<?= $address['street'] ?>">
        <div>City</div>
        <input type="text" name="city" value="<?= $address['city'] ?>">
        <div>Zip_code</div>
        <input type="text" name="zip_code" value="<?= $address['zip_code'] ?>">
        <div>Region</div>
        <input type="text" name="region" value="<?= $address['region'] ?>">
        <div>Country</div>
        <input type="text" name="country" value="<?= $address['country'] ?>">
        <input type="submit" name="update" value="Modifier">
        <input type="submit" name="delete" value="Supprimer">
    </form>
<?php endforeach; ?>