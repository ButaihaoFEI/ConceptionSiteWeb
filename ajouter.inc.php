<div class="div">
    <br>
    <?php if ($_SESSION['droits'] == 0): ?>
        <h2 id="title">Ajouter un objet perdu</h2>
        <?php endif; ?>

    <?php if ($_SESSION['droits'] == 1): ?>
    <h2 id="title">Ajouter un objet trouvé</h2>
    <?php endif; ?>


    <!-- Textfield with Floating Label -->

    <form action="#" method="post">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" name="nom" type="text" id="sample3">
            <label class="mdl-textfield__label" for="sample3">Nom...</label>
        </div>
        <br>
        <!-- Textfield with Floating Label -->

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" name="couleur" type="text" id="sample4">
            <label class="mdl-textfield__label" for="sample4">Couleur...</label>
        </div>
        <br>

        <!-- Raised button -->
        <button class="mdl-button mdl-js-button mdl-button--raised" input type="post">
            Valider
        </button>
        <button class="mdl-button mdl-js-button mdl-button--raised" input type="reset">
            Annuler
        </button>
    </form>
</div>