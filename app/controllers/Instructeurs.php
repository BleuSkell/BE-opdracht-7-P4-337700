<?php

class Instructeurs extends BaseController
{   
    private $instructeurModel;

    public function __construct()
    {
        $this->instructeurModel = $this->model('InstructeurModel');
    }

    public function index()
    {
        $data = [
            'title' => 'Instructeurs in dienst',
            'message' => NULL,
            'messageColor' => NULL,
            'messageVisibility' => 'none',
            'dataRows' => NULL
        ];

        $result = $this->instructeurModel->getAllInstructeurs();

        if (is_null($result)) {
            // Fout afhandelen
            $data['message'] = "Er is een fout opgetreden in de database";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['dataRows'] = NULL;

            header('Refresh:3; url=' . URLROOT . '/Homepages/index');
        } else {
            $data['dataRows'] = $result;
        }

        $this->view('instructeurs/index', $data);
    }

    public function voertuigen($instructeurId)
    {
        $data = [
            'title' => 'Door instructeur gebruikte voertuigen',
            'message' => NULL,
            'messageColor' => NULL,
            'messageVisibility' => 'none',
            'dataRows' => NULL
        ];

        $result = $this->instructeurModel->getVoertuigenByInstructeurId($instructeurId);

        if (is_null($result)) {
            // Fout afhandelen
            $data['message'] = "Er is een fout opgetreden in de database";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['dataRows'] = NULL;

            header('Refresh:3; url=' . URLROOT . '/Homepages/index');
        } else {
            $data['dataRows'] = $result;
        }

        $this->view('instructeurs/voertuigen', $data);
    }

    public function edit($voertuiginstructeurId)
    {
        $data = [
            'title' => 'Wijzigen voertuiggegevens',
            'message' => NULL,
            'messageColor' => NULL,
            'messageVisibility' => 'none',
            'voertuiggegevens' => NULL,
            'instructeurs' => NULL,
            'typevoertuigen' => NULL,
        ];

        $voertuiggegevens = $this->instructeurModel->getVoertuiggegevensById($voertuiginstructeurId);
        $instructeurs = $this->instructeurModel->getAllInstructeursSimple();
        $typevoertuigen = $this->instructeurModel->getAllTypeVoertuigen();

        if (is_null($voertuiggegevens)) {
            // Fout afhandelen
            $data['message'] = "Er is een fout opgetreden in de database";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['voertuiggegevens'] = NULL;
            $data['instructeurs'] = NULL;
            $data['typevoertuigen'] = NULL;

            header('Refresh:3; url=' . URLROOT . '/Homepages/index');
        } else {
            $data['voertuiggegevens'] = $voertuiggegevens[0];
            $data['instructeurs'] = $instructeurs;
            $data['typevoertuigen'] = $typevoertuigen;
        }

        $this->view('instructeurs/edit', $data);
    }

    public function update($voertuiginstructeurId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // VoertuiginstructeurId toevoegen aan POST-gegevens
            $_POST['voertuiginstructeurId'] = $voertuiginstructeurId;

            // Haal instructeurId op voor redirect
            $voertuiggegevens = $this->instructeurModel->getVoertuiggegevensById($voertuiginstructeurId);
            $instructeurId = $voertuiggegevens[0]->InstructeurId ?? null;

            // Update uitvoeren
            $result = $this->instructeurModel->updateVoertuiggegevens($_POST);

            if ($result) {
                header('Location: ' . URLROOT . '/instructeurs/voertuigen/' . $instructeurId);
                exit;
            } else {
                // Foutmelding tonen
                $data = [
                    'title' => 'Wijzigen voertuiggegevens',
                    'message' => 'Er is iets misgegaan bij het bijwerken.',
                    'messageColor' => 'danger',
                    'messageVisibility' => 'flex',
                    'voertuiggegevens' => $voertuiggegevens[0] ?? null,
                    'instructeurs' => $this->instructeurModel->getAllInstructeursSimple(),
                    'typevoertuigen' => $this->instructeurModel->getAllTypeVoertuigen(),
                ];
                $this->view('instructeurs/edit', $data);
            }
        } else {
            header('Location: ' . URLROOT . '/instructeurs/edit/' . $voertuiginstructeurId);
            exit;
        }
    }

    public function beschikbareVoertuigen($instructeurId)
    {
        $data = [
            'title' => 'Beschikbare voertuigen',
            'message' => NULL,
            'messageColor' => NULL,
            'messageVisibility' => 'none',
            'instructeur' => NULL,
            'beschikbareVoertuigen' => NULL
        ];

        $instructeur = $this->instructeurModel->getInstructeurById($instructeurId);
        $beschikbareVoertuigen = $this->instructeurModel->getAllVoertuigen();

        if (is_null($instructeur)) {
            // Fout afhandelen
            $data['message'] = "Er is een fout opgetreden in de database";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['instructeur'] = NULL;
            $data['beschikbareVoertuigen'] = NULL;

            header('Refresh:3; url=' . URLROOT . '/Homepages/index');
        } else {
            $data['instructeur'] = $instructeur[0];
            $data['beschikbareVoertuigen'] = $beschikbareVoertuigen;
        }

        $this->view('instructeurs/beschikbareVoertuigen', $data);
    }

    public function wijzigenVoertuigGegevens($voertuigId)
    {
        $data = [
            'title' => 'Wijzigen voertuiggegevens',
            'message' => NULL,
            'messageColor' => NULL,
            'messageVisibility' => 'none',
            'dataRows' => NULL
        ];

        $this->view('instructeurs/wijzigenVoertuigGegevens', $data);
    }
}