<header class="header">
    <a href="/" class="header-logo"></a>
    <div class="header-link-zone">
        <a class="header-link" href="/regardez_nos_produits">Parfums</a>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) { ?>
            <a class="header-link" href="/manage">Manage</a>
        <?php }
        if (!isset($_SESSION['user_id'])) : ?>
            <a class="header-link" href="/connectez_vous">Login</a>
        <?php else : ?>
            <a class="header-link" href="/votre_profil">Profile</a>
        <?php endif; ?>
        <a class="header-link" href="/votre_panier">Panier</a>
    </div>
</header>