<div id="login">
    <form action="index.php" method="post">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" id="inputEmail" name="inputEmail" required>
            <label class="mdl-textfield__label" for="inputEmail">Entrez votre identifiant</label>
        </div>
        <br>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" id="inputPassword" name="inputPassword" required>
            <label class="mdl-textfield__label" for="inputPassword">Entrez votre mot de passe</label>
        </div>
        <br>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary"
                name="connect" value="connect">
            Se connecter
        </button>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary"
                name="register" value="register">
            S'inscrire
        </button>
    </form>
</div>