<div class="step" data-step="personal-details">
    <div class="details-grid">
        <div class="input-group">
            <label for="fname">Vorname</label>
            <input type="text" name="fname" id="fname" required>
        </div>
        <div class="input-group">
            <label for="lname">Nachname</label>
            <input type="text" name="lname" id="lname" required>
        </div>
        <div class="input-group">
            <label for="email">E-Mail Adresse</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="input-group">
            <label for="address">Strasse / Nr.</label>
            <input type="text" name="address" id="address" required>
        </div>
        <div class="input-group">
            <label for="plz">PLZ</label>
            <input type="text" name="plz" id="plz" required>
        </div>
        <div class="input-group">
            <label for="ort">Ort</label>
            <input type="text" name="ort" id="ort" required>
        </div>
        <div class="input-group fullwidth optin checkbox">
            <input type="checkbox" name="optin" id="optin" checked>
            <label for="optin">Ich bin einverstanden, dass die JUSO Kanton Zürich mich auf dem Laufenden hält</label>
        </div>
        <input type="hidden" name="uuid" value="<?= uniqid("bestellung_") ?>">
    </div>
    <button type="submit" class="button">Bestellung abschicken</button>
</div>