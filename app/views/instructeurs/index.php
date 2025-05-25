<?php require_once APPROOT . '/views/includes/header.php'; ?>

<h3><?php echo $data['title']; ?></h3>

<h3>Aantal instructeurs: <?= $data['dataRows'][0]->AantalInstructeurs; ?></h3>

<a href="<?= URLROOT; ?>/homepages/index">Homepage</a>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
