<form action="/inscrivez_vous" method="POST">
    <div class="input-area">
        <label for="input-first-name">Prénom</label>
        <input type="text" name="first_name" id="input-first-name" class="input-large" value="<?= htmlspecialchars($datas['first_name']) ?>" required>
    </div>
    <div class="input-area">
        <label for="input-last-name">Nom</label>
        <input type="text" name="last_name" id="input-last-name" class="input-large" value="<?= htmlspecialchars($datas['last_name']) ?>" required>
    </div>
    <input type="submit" value="Suivant">
</form>

<form action="/inscrivez_vous" method="POST">
    <div class="input-area">
        <label for="input-email">Pseudo</label>
        <input type="text" name="username" id="input-username" class="input-large" value="<?= htmlspecialchars($datas['username']) ?>" required>
        <?php if ($datas['username_exists']) : ?>
            <div class="input-error">Pseudo déjà utilisé</div>
        <?php endif; ?>
    </div>
    <div class="input-area">
        <label for="input-email">Email</label>
        <input type="email" name="email" id="input-email" class="input-large" value="<?= htmlspecialchars($datas['email']) ?>" required>
        <?php if ($datas['email_exists']) : ?>
            <div class="input-error">Email déjà utilisé</div>
        <?php endif; ?>
    </div>
    <input type="submit" value="Suivant">
</form>

<form action="/inscrivez_vous" method="POST">
    <div class="input-area">
        <label for="input-password">Mot de passe</label>
        <input type="password" name="password" id="input-password" class="input-large" value="<?= htmlspecialchars($datas['password']) ?>" required>
    </div>
    <div class="input-area">
        <label for="input-confirm-password">Confirmer le mot de passe</label>
        <input type="password" name="confirm_password" id="input-confirm-password" class="input-large" value="<?= htmlspecialchars($datas['confirm_password']) ?>" required>
    </div>
    <input type="submit" value="S'inscrire !">
</form>