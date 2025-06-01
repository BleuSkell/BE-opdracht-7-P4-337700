<?php require_once APPROOT . '/views/includes/header.php'; ?>

<!-- Voor het centreren van de container gebruiken we het boodstrap grid -->
<div class="container">

    <div class="row mt-3 text-center" style="display:<?= $data['messageVisibility']; ?>">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="alert alert-<?= $data['messageColor']; ?>" role="alert">
                <?= $data['message']; ?>
            </div>
        </div>
        <div class="col-2"></div>
    </div>


    <div class="row mt-3">
        <div class="col-2"></div>
        <div class="col-8">
            <h3><?php echo $data['title']; ?></h3>
            <h4>Naam: <?= $data['instructeur']->Voornaam ?> <?= $data['instructeur']->Tussenvoegsel ?> <?= $data['instructeur']->Achternaam ?></h4>
            <h4>Datum in dienst: <?= date('d-m-Y', strtotime($data['instructeur']->DatumInDienst)) ?></h4>
            <h4>Aantal sterren: <?= $data['instructeur']->AantalSterren ?></h4>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row mt-3">
        <div class="col-2"></div>
        <div class="col-8">
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type Voertuig</th>
                        <th>Type</th>
                        <th>Kenteken</th>
                        <th>Bouwjaar</th>
                        <th>Brandstof</th>
                        <th>Rijbewijscategorie</th>
                        <th>Toevoegen</th>
                        <th>Wijzigen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_null($data['beschikbareVoertuigen'])) { ?>
                              <tr>
                                <td colspan='6' class='text-center'>Door een storing kunnen we op dit moment geen producten tonen uit het magazijn</td>
                              </tr>
                    <?php } else {                              
                              foreach ($data['beschikbareVoertuigen'] as $voertuig) { ?>
                                <tr>
                                    <td><?= $voertuig->TypeVoertuig; ?></td>
                                    <td><?= $voertuig->Type; ?></td>
                                    <td><?= $voertuig->Kenteken ?></td>
                                    <td><?= $voertuig->Bouwjaar ?></td>
                                    <td><?= $voertuig->Brandstof ?></td>
                                    <td><?= $voertuig->RijbewijsCategorie ?></td>
                                    <td class="text-center">
                                        <a href="">
                                            <i class='bi bi-plus'></i>
                                        </a>
                                    </td>
                                    <td class='text-center'>
                                        <a href='<?= URLROOT; ?>/instructeurs/wijzigenVoertuigGegevens/<?= $voertuig->VoertuigId; ?>/<?= $data['instructeur']->Id; ?>'>
                                            <i class='bi bi-pencil-fill'></i>
                                        </a>
                                    </td>
                                </tr>
                    <?php } } ?>
                </tbody>
            </table>

            <a href="<?= URLROOT; ?>/homepages/index">Homepage</a>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>