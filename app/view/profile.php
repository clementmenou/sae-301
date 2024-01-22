<div class="page-content">
    <div class="form-container">
        <div class="form-title">Editez votre compte</div>

        <form action="/votre_profil" method="post" class="form-profile">
            <div class="input-label-area-medium">
                <input type="text" name="first_name" id="input-first-name" class="input-generic" placeholder="" value="<?= $datas['user_info']['first_name'] ?>" required>
                <label for="input-first-name" class="label-generic">Prénom</label>
            </div>
            <input type="submit" value="Valider" class="button-small button-padding">
        </form>


        <form action="/votre_profil" method="post" class="form-profile">
            <div class="input-label-area-medium">
                <input type="text" name="last_name" id="input-last-name" class="input-generic" placeholder="" value="<?= $datas['user_info']['last_name'] ?>" required>
                <label for="input-last-name" class="label-generic">Nom</label>
            </div>
            <input type="submit" value="Valider" class="button-small button-padding">
        </form>

        <form action="/votre_profil" method="post" class="form-profile">
            <div class="input-label-area-medium">
                <input type="text" name="username" id="input-username" class="input-generic" placeholder="" value="<?= $datas['user_info']['username'] ?>" required>
                <label for="input-username" class="label-generic">Pseudo</label>
                <?php if ($datas['update']['username_exists']) : ?>
                    <div class="input-error">
                        <svg viewBox="0 0 24 24" class="input-error-svg">
                            <circle cx="12" cy="12" r="9" fill="none" />
                            <line x1="12" y1="8" x2="12" y2="12" stroke-width="2" />
                            <line x1="12" y1="16" x2="12" y2="16" stroke-width="2" />
                        </svg>
                        <p class="input-error-text">Pseudo déjà utilisé</p>
                    </div>
                <?php endif; ?>
            </div>
            <input type="submit" value="Valider" class="button-small button-padding">
        </form>

        <form action="/votre_profil" method="post" class="form-profile">
            <div class="input-label-area-medium" class="form-container">
                <input type="email" name="email" id="input-email" class="input-generic" placeholder="" value="<?= $datas['user_info']['email'] ?>" required>
                <label for="input-email" class="label-generic">Email</label>
                <?php if ($datas['update']['email_exists']) : ?>
                    <div class="input-error">
                        <svg viewBox="0 0 24 24" class="input-error-svg">
                            <circle cx="12" cy="12" r="9" fill="none" />
                            <line x1="12" y1="8" x2="12" y2="12" stroke-width="2" />
                            <line x1="12" y1="16" x2="12" y2="16" stroke-width="2" />
                        </svg>
                        <p class="input-error-text">Email déjà utilisé</p>
                    </div>
                <?php endif; ?>
            </div>
            <input type="submit" value="Valider" class="button-small button-padding">
        </form>
        <form action="/deconnexion" method="post">
            <input type="submit" value="Deconnection" class="button-generic button-suppr">
        </form>
    </div>

    <?php if ($datas['all_ordered']) : ?>
        <div class="form-container">
            <?php foreach ($datas['all_ordered'] as $order) : ?>
                <div class="order-container">
                    <div><?= $order['order_date'] ?></div>
                    <div><?= $order['first_name'] ?></div>
                    <div></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>