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
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row mt-3">
        <div class="col-2"></div>
        <div class="col-8">

            <form action="<?= URLROOT; ?>/instructeurs/update/<?= $data['voertuiggegevens']->VoertuigInstructeurId ?>" method="post">
                <input type="hidden" name="voertuiginstructeurId" id="voertuiginstructeurId" value="<?= $data['voertuiggegevens']->VoertuigInstructeurId; ?>">

                <div class="mb-3 row align-items-center">
                    <label for="instructeur" class="col-sm-4 col-form-label">Instructeur:</label>

                    <div class="col-sm-8">
                        <select name="instructeur" id="instructeur" class="form-select">
                            <?php foreach ($data['instructeurs'] as $row): ?>
                                <option value="<?= $row->Id; ?>" <?= $row->Id == $data['voertuiggegevens']->InstructeurId ? 'selected' : '' ?>>
                                    <?= $row->Voornaam . ' ' . $row->Tussenvoegsel . ' ' . $row->Achternaam; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="typevoertuig" class="col-sm-4 col-form-label">Type Voertuig:</label>

                    <div class="col-sm-8">
                        <select name="typevoertuig" id="typevoertuig" class="form-select">
                            <?php foreach ($data['typevoertuigen'] as $row): ?>
                                <option value="<?= $row->Id; ?>" <?= $row->Id == $data['voertuiggegevens']->TypeVoertuigId ? 'selected' : '' ?>>
                                    <?= $row->TypeVoertuig; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="type" class="col-sm-4 col-form-label">Type:</label>

                    <div class="col-sm-8">
                        <input type="text" name="type" id="type" class="form-control" value="<?= $data['voertuiggegevens']->Type; ?>">
                    </div>
                </div>
                
                <div class="mb-3 row align-items-center">
                    <label for="bouwjaar" class="col-sm-4 col-form-label">Bouwjaar:</label>
                    
                    <div class="col-sm-8">
                        <input type="date" name="bouwjaar" id="bouwjaar" class="form-control"
                            value="<?= $data['voertuiggegevens']->Bouwjaar; ?>">
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label class="col-sm-4 col-form-label">Brandstof:</label>

                    <div class="col-sm-8">
                        <?php
                        $brandstoffen = ['Diesel', 'Benzine', 'Elektrisch'];
                        foreach ($brandstoffen as $brandstof):
                        ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="brandstof" id="brandstof_<?= $brandstof; ?>"
                                    value="<?= $brandstof; ?>" <?= $data['voertuiggegevens']->Brandstof == $brandstof ? 'checked' : '' ?>>
                                <label class="form-check-label" for="brandstof_<?= $brandstof; ?>"><?= $brandstof; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="kenteken" class="col-sm-4 col-form-label">Kenteken:</label>

                    <div class="col-sm-8">
                        <input type="text" name="kenteken" id="kenteken" class="form-control" value="<?= $data['voertuiggegevens']->Kenteken; ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Wijzig</button>
                    </div>
                </div>
                
            </form>

            <a href="<?= URLROOT; ?>/homepages/index">Homepage</a>
        </div>
        <div class="col-2"></div>
    </div>

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>