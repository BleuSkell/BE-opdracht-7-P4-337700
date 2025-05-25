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
            <h3>Aantal instructeurs: <?= $data['dataRows'][0]->AantalInstructeurs; ?></h3>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row mt-3">
        <div class="col-2"></div>
        <div class="col-8">
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Mobiel</th>
                        <th>Datum in dienst</th>
                        <th>Aantal sterren</th>
                        <th>Voertuigen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_null($data['dataRows'])) { ?>
                              <tr>
                                <td colspan='6' class='text-center'>Door een storing kunnen we op dit moment geen producten tonen uit het magazijn</td>
                              </tr>
                    <?php } else {                              
                              foreach ($data['dataRows'] as $instructeur) { ?>
                                <tr>
                                    <td><?= $instructeur->Voornaam; ?></td>
                                    <td><?= $instructeur->Tussenvoegsel; ?></td>
                                    <td><?= $instructeur->Achternaam; ?></td>
                                    <td><?= $instructeur->Mobiel; ?></td>
                                    <td><?= date('d-m-Y', strtotime($instructeur->DatumInDienst)); ?></td>
                                    <td><?= $instructeur->AantalSterren; ?></td>
                                    <td class='text-center'>
                                        <a href='<?= URLROOT . "/Instructeurs/voertuigen/$instructeur->InstructeurId" ?>'>
                                            <i class='bi bi-car-front-fill'></i>
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