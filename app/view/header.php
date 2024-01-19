<header class="header">
    <a href="/" class="header-logo"></a>
    <div class="header-link-zone">
        <a class="header-link" href="/regardez_nos_produits">Boutique</a>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) : ?>
            <a class="header-link" href="/manage">Manage</a>
        <?php endif; ?>
        <a class="header-link" href="<?php if (!isset($_SESSION['user_id'])) : ?>/connectez_vous<?php else : ?>/votre_profil<?php endif; ?>">
            <img src="Public/Images/icon-account.png" alt="" class="header-link-image-account">
            <div>Compte</div>
        </a>
        <a class="header-link" href="/votre_panier">
            <img src="Public/Images/icon-cart.png" alt="" class="header-link-image-cart">
            <div>Panier</div>
        </a>
    </div>
</header>