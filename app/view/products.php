<p>Produits</p>
<?php
foreach ($datas['all_users'] as $user) : ?>
    <div>
        <div><?= $user['name'] ?></div>
        <div><?= $user['description'] ?></div>
        <div><?= $user['price'] ?> €</div>
    </div>
<?php endforeach ?>