<div class="page-content-center">
    <form action="/payer_votre_commande" method="POST" class="form-container">
        <div class="form-title">Paiement</div>

        <div class="input-label-area">
            <input type="text" id="input-card-number" maxlength="19" class="input-generic" placeholder="" name="card_number" required>
            <label for="input-card-number" class="label-generic">Numéro de carte</label>
        </div>
        <div class="form-sub-container">
            <div class="form-sub-container-expiration">
                <div class="input-label-area-extra-small">
                    <input type="text" id="input-expiration-month" minlength="2" maxlength="2" class="input-generic" placeholder="" name="expiration_month" required>
                    <label for="input-expiration-month" class="label-generic">XX</label>
                </div>
                <div class="input-expiration-spliter">/</div>
                <div class="input-label-area-extra-small">
                    <input type="text" id="input-expiration-year" minlength="2" maxlength="2" class="input-generic" placeholder="" name="expiration_year" required>
                    <label for="input-expiration-year" class="label-generic">XX</label>
                </div>
            </div>

            <div class="input-label-area-small">
                <input type="text" id="input-security-code" class="input-generic" maxlength="3" placeholder="" name="security_code" required>
                <label for="input-security-code" class="label-generic">Code</label>
            </div>
        </div>
        <div class="input-label-area">
            <input type="text" id="input-name" class="input-generic" placeholder="" name="name" required>
            <label for="input-name" class="label-generic">Nom du titulaire</label>
        </div>

        <input type="submit" value="Payer" class="button-generic">
    </form>
</div>