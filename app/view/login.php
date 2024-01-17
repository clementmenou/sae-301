<div class="page-content-center">
    <form action="/connectez_vous" method="POST" class="form-container">
        <div class="form-title">Connectez-vous</div>

        <div class="input-label-area">
            <input type="email" name="email" id="input-email" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['email']) ?>" required>
            <label for="input-email" class="label-generic">Email</label>
            <?php if ($datas['wrong_email']) : ?>
                <div class="input-error">
                    <svg viewBox="0 0 24 24" class="input-error-svg">
                        <circle cx="12" cy="12" r="9" fill="none" />
                        <line x1="12" y1="8" x2="12" y2="12" stroke-width="2" />
                        <line x1="12" y1="16" x2="12" y2="16" stroke-width="2" />
                    </svg>
                    <p class="input-error-text">Email incorrect</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="input-label-area">
            <input type="password" name="password" id="input-password" class="input-generic" placeholder="" value="<?= htmlspecialchars($datas['password']) ?>" required>
            <label for="input-password" class="label-generic">Password</label>
            <?php if ($datas['wrong_password']) : ?>
                <div class="input-error">
                    <svg viewBox="0 0 24 24" class="input-error-svg">
                        <circle cx="12" cy="12" r="9" fill="none" />
                        <line x1="12" y1="8" x2="12" y2="12" stroke-width="2" />
                        <line x1="12" y1="16" x2="12" y2="16" stroke-width="2" />
                    </svg>
                    <p class="input-error-text">Mot de passe incorrect</p>
                </div>
            <?php endif; ?>
        </div>
        <input type="submit" value="Connexion" class="button-generic">
    </form>
</div>