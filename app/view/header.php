<header class="header">
    <a href="/" class="header-logo">
        <img src="Public/Images/logo.svg" alt="logo délicor" class="header-logo-image">
        <div class="header-logo-text">Délicor</div>
    </a>
    <div class="header-link-zone">
        <a class="header-link" href="/regardez_nos_produits">
            <div>Boutique</div>
        </a>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) : ?>
            <a class="header-link" href="/gerez_le_site">Manage</a>
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
    <div class="burger-menu">&#9776;</div>
</header>