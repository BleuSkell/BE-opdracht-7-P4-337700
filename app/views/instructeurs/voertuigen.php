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
            <h4>Naam: <?= $data['dataRows'][0]->Voornaam, ' ', $data['dataRows'][0]->Tussenvoegsel, ' ', $data['dataRows'][0]->Achternaam ?></h4>
            <h4>Datum in dienst: <?= date('d-m-Y', strtotime($data['dataRows'][0]->DatumInDienst)); ?></h4>
            <h4>Aantal sterren: <?= $data['dataRows'][0]->AantalSterren ?></h4>
            <a href="#">
                <button>
                    Toevoegen voertuig
                </button>
            </a>
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
                        <th>Wijzigen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_null($data['dataRows'])) { ?>
                              <tr>
                                <td colspan='6' class='text-center'>Door een storing kunnen we op dit moment geen producten tonen uit het magazijn</td>
                              </tr>
                    <?php } else {                              
                              foreach ($data['dataRows'] as $voertuig) { ?>
                                <tr>
                                    <td><?= $voertuig->TypeVoertuig; ?></td>
                                    <td><?= $voertuig->Type; ?></td>
                                    <td><?= $voertuig->Kenteken ?></td>
                                    <td><?= $voertuig->Bouwjaar ?></td>
                                    <td><?= $voertuig->Brandstof ?></td>
                                    <td><?= $voertuig->RijbewijsCategorie ?></td>
                                    <td class='text-center'>
                                        <a href='<?= URLROOT; ?>/instructeurs/edit/<?= $voertuig->VoertuigInstructeurId ?>'>
                                            <i class='bi bi-pencil-fill'></i>
                                        </a>
                                    </td>
                                </tr>
                    <?php } } ?>
                </tbody>
            </table>
                
            <a href="<?= URLROOT; ?>/instructeurs/index">Terug</a>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>