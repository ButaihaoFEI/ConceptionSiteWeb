<div id="list">
    <h2>Liste des objets perdus</h2>
    <div id="list_lost">
        <?php
        $objects_found = $db->getAll('objet', [
            'etat' => 0
        ]);
        foreach ($objects_found as $of):
            //for ($i = 0; $i < 10; $i++):
            ?>
            <div class="list-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text"><?= $of['nom'] ?></h2>
                </div>
                <div class="mdl-card__supporting-text">
                    Date d'ajout: <?php
                    $date = new DateTime($of['date_ajout']);
                    echo $date->format("d/m/Y");
                    ?>
                    <br>
                    <?= $of['couleur'] ?>
                </div>
                <?php if ($_SESSION['droits'] == 1): ?>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="update-item.php?objet=<?= $of['id'] ?>&etat=2">
                        Marquer comme rendu
                    </a>
                </div>
                <?php endif; ?>
                <?php if ($_SESSION['droits'] == 2): ?>
                    <div class="mdl-card__menu">
                        <a class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect" href="update-item.php?objet=<?= $of['id'] ?>&etat=3">
                            Abandonné
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <?php
//        endfor;*/
        endforeach;
        ?>
        <br>
        <?php if ($_SESSION['droits'] < 2):?>
        <a href="index.php?ajouter" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
        <?php endif; ?>
    </div>
    <?php if ($_SESSION['droits'] >= 1): ?>
        <h2>Liste des objets trouvés</h2>
        <div id="list_found">
            <?php
            $objects_found = $db->getAll('objet', [
                'etat' => 1
            ]);
            foreach ($objects_found as $of):
                //for ($i = 0; $i < 10; $i++):
                ?>
                <div class="list-card mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text"><?= $of['nom'] ?></h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Date d'ajout: <?php
                        $date = new DateTime($of['date_ajout']);
                        echo $date->format("d/m/Y");
                        ?>
                        <br>
                        <?= $of['couleur'] ?>
                    </div>
                    <?php if ($_SESSION['droits'] == 1): ?>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="update-item.php?objet=<?= $of['id'] ?>&etat=2">
                                Marquer comme rendu
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ($_SESSION['droits'] == 2): ?>
                        <div class="mdl-card__menu">
                            <a class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect" href="update-item.php?objet=<?= $of['id'] ?>&etat=3">
                                Abandonné
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
//        endfor;*/
            endforeach;
            ?>
            <br>
            <?php if ($_SESSION['droits'] < 2):?>
                <a href="index.php?ajouter" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
                    <i class="material-icons">add</i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($_SESSION['droits'] == 2): ?>
        <h2>Liste des objets abandonnés</h2>
        <div id="list_abandoned">
            <?php
            $objects_found = $db->getAll('objet', [
                'etat' => 3
            ]);
            foreach ($objects_found as $of):
                //for ($i = 0; $i < 10; $i++):
                ?>
                <div class="list-card mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text"><?= $of['nom'] ?></h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Date d'ajout: <?php
                        $date = new DateTime($of['date_ajout']);
                        echo $date->format("d/m/Y");
                        ?>
                        <br>
                        <?= $of['couleur'] ?>
                    </div>
                </div>
                <?php
//        endfor;*/
            endforeach;
            ?>
        </div>
    <?php endif; ?>
</div>