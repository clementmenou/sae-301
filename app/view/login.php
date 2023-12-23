<form action="/connectez_vous" method="POST">
    <div class="input-area">
        <label for="input-email">Email</label>
        <input type="email" name="email" id="input-email" class="input-large" value="<?= htmlspecialchars($datas['email']) ?>" required>
        <?php if ($datas['login_status'] === 'EMAIL_INCORRECT') : ?>
            <div>Email incorrect</div>
        <?php endif; ?>
    </div>
    <div class="input-area">
        <label for="input-password">Password</label>
        <input type="password" name="password" id="input-password" class="input-large" value="<?= htmlspecialchars($datas['password']) ?>" required>
        <?php if ($datas['login_status'] === 'PASSWORD_INCORRECT') : ?>
            <div>Mot de passe incorrect</div>
        <?php endif; ?>
    </div>
    <input type="submit" value="Connexion">
</form>