<?php require_once APPROOT . '/views/includes/header.php'; ?>

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
            <h3><?= $data['title']; ?></h3>
            
            <form action="<?= URLROOT; ?>/instructeurs/updateAndAddVoertuig/<?= $data['voertuig']->VoertuigId ?>/<?= $data['instructeurId'] ?>" method="post">
                <input type="hidden" name="voertuigId" value="<?= $data['voertuig']->VoertuigId ?>">
                
                <div class="mb-3">
                    <label for="typeVoertuig" class="form-label">Type Voertuig</label>
                    <select name="typeVoertuigId" id="typeVoertuig" class="form-select">
                        <?php foreach ($data['typeVoertuigen'] as $type): ?>
                            <option value="<?= $type->Id ?>" <?= ($type->Id == $data['voertuig']->TypeVoertuigId) ? 'selected' : '' ?>>
                                <?= $type->TypeVoertuig ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control" id="type" name="type" value="<?= $data['voertuig']->Type ?>">
                </div>

                <div class="mb-3">
                    <label for="kenteken" class="form-label">Kenteken</label>
                    <input type="text" class="form-control" id="kenteken" name="kenteken" value="<?= $data['voertuig']->Kenteken ?>">
                </div>

                <div class="mb-3">
                    <label for="bouwjaar" class="form-label">Bouwjaar</label>
                    <input type="date" class="form-control" id="bouwjaar" name="bouwjaar" value="<?= $data['voertuig']->Bouwjaar ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Brandstof</label>
                    <?php $brandstofTypes = ['Diesel', 'Benzine', 'Elektrisch']; ?>
                    <?php foreach ($brandstofTypes as $brandstof): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="brandstof" 
                                   id="brandstof_<?= $brandstof ?>" value="<?= $brandstof ?>"
                                   <?= ($data['voertuig']->Brandstof == $brandstof) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="brandstof_<?= $brandstof ?>">
                                <?= $brandstof ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" class="btn btn-primary">Toevoegen aan instructeur</button>
            </form>

            <a href="<?= URLROOT; ?>/instructeurs/beschikbareVoertuigen/<?= $data['instructeurId'] ?>" class="btn btn-secondary mt-3">Terug</a>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>