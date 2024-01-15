<form action="/manage" method="POST">
    <label for="insert_name">Nom</label>
    <input type="text" name="insert_name" id="insert_name" value="<?= $datas['insert']['name'] ?>">
    <label for="insert_description">Description</label>
    <input type="text" name="insert_description" id="insert_description" value="<?= $datas['insert']['description'] ?>">
    <label for="insert_price">Prix</label>
    <input type="text" name="insert_price" id="insert_price" value="<?= $datas['insert']['price'] ?>">
    <label for="insert_quantity">Quantité</label>
    <input type="text" name="insert_quantity" id="insert_quantity" value="<?= $datas['insert']['quantity'] ?>">
    <label for="insert_image">Image</label>
    <input type="text" name="insert_image" id="insert_image" value="<?= $datas['insert']['image'] ?>">
    <label>Familles</label>
    <input type="checkbox" value="1" name="insert_category[]">Hésperidés
    <input type="checkbox" value="2" name="insert_category[]">Fleuris
    <input type="checkbox" value="3" name="insert_category[]">Boisés
    <input type="checkbox" value="4" name="insert_category[]">Fougeres
    <input type="checkbox" value="5" name="insert_category[]">Chypres
    <input type="checkbox" value="6" name="insert_category[]">Orientaux
    <input type="checkbox" value="7" name="insert_category[]">Aromatiques
    <input type="submit" value="Ajouter">
</form>

<form action="/manage" method="POST">
    <label for="update_name">Nom</label>
    <select name="update_name" id="update_name">
        <?php foreach ($datas['liste_name_product'] as $product) : ?>
            <option value="<?= $product['name'] ?>"><?= $product['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <label for="update_quantity">Quantité</label>
    <input type="text" name="update_quantity" id="update_quantity">
    <input type="submit" value="Modifier">
</form>

<form action="/manage" method="POST">
    <label for="delete_name">Nom</label>
    <select name="delete_name" id="delete_name">
        <?php foreach ($datas['liste_name_product'] as $product) : ?>
            <option value="<?= $product['name'] ?>"><?= $product['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Supprimer">
</form>