<div class="page-content-center">
    <form action="/inscrivez_vous" method="POST" class="form-container" id="name-zone">
        <div class="form-title">Créer votre compte</div>

        <div class="input-label-area">
            <input type="text" name="first_name" id="input-first-name" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['first_name']) ?>" required>
            <label for="input-first-name" class="label-generic">Prénom</label>
        </div>
        <div class="input-label-area">
            <input type="text" name="last_name" id="input-last-name" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['last_name']) ?>" required>
            <label for="input-last-name" class="label-generic">Nom</label>
        </div>
        <input type="submit" value="Continuer" class="button-generic">
        <p class="sub-text">Vous souhaitez vous connecter? <a href="/connectez_vous">Cliquez ici!</a></p>
    </form>

    <form action="/inscrivez_vous" method="POST" class="form-container" id="identifier-zone">
        <div class="form-title">Identifiants</div>

        <div class="input-label-area">
            <input type="text" name="username" id="input-username" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['username']) ?>" required>
            <label for="input-username" class="label-generic">Pseudo</label>
            <?php if ($datas['username_exists']) : ?>
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
        <div class="input-label-area" class="form-container">
            <input type="email" name="email" id="input-email" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['email']) ?>" required>
            <label for="input-email" class="label-generic">Email</label>
            <?php if ($datas['email_exists']) : ?>
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
        <input type="submit" value="Continuer" class="button-generic">
    </form>

    <form action="/inscrivez_vous" method="POST" class="form-container" id="password-zone">
        <div class="form-title">Mot de passe sécurisé</div>

        <div class="input-label-area">
            <input type="password" name="password" id="input-password" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['password']) ?>" required>
            <label for="input-password" class="label-generic">Mot de passe</label>
            <div class="input-password-condition">
                <div class="input-password-condition-section">
                    <div class="input-password-condition-lenght"><span></span> Au moins 10 caractères</div>
                    <div class="input-password-condition-maj"><span></span> Au moins 1 lettre majuscule</div>
                    <div class="input-password-condition-min"><span></span> Au moins 1 lettre minuscule</div>
                </div>
                <div class="input-password-condition-section">
                    <div class="input-password-condition-digit"><span></span> Au moins 1 chiffre</div>
                    <div class="input-password-condition-special"><span></span> Au moins 1 caractère spécial</div>
                    <div class="input-password-condition-match"><span></span> Confirmation correcte</div>
                </div>
            </div>
        </div>
        <div class="input-label-area">
            <input type="password" name="confirm_password" id="input-confirm-password" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['confirm_password']) ?>" required>
            <label for="input-confirm-password" class="label-generic">Confirmer</label>
        </div>
        <input type="submit" value="S'inscrire !" class="button-generic">
    </form>
</div>