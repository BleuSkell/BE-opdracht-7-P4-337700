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

        if (is_null($instructeur) || is_null($beschikbareVoertuigen)) {
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

    public function wijzigenVoertuigGegevens($voertuigId, $instructeurId)
    {   
        $data = [
            'title' => 'Wijzigen voertuiggegevens',
            'message' => NULL,
            'messageColor' => NULL,
            'messageVisibility' => 'none',
            'voertuig' => NULL,
            'typeVoertuigen' => NULL,
            'instructeurId' => $instructeurId
        ];

        $voertuig = $this->instructeurModel->getVoertuigById($voertuigId);
        $typeVoertuigen = $this->instructeurModel->getAllTypeVoertuigen();

        if (is_null($voertuig) || is_null($typeVoertuigen)) {
            // Fout afhandelen
            $data['message'] = "Er is een fout opgetreden in de database";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['dataRows'] = NULL;;

            // header('Refresh:3; url=' . URLROOT . '/Homepages/index');
        } else {
            $data['voertuig'] = $voertuig[0];
            $data['typeVoertuigen'] = $typeVoertuigen;
        }

        $this->view('instructeurs/wijzigenVoertuigGegevens', $data);
    }

    public function updateAndAddVoertuig($voertuigId, $instructeurId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Verify TypeVoertuigId exists
            if (!$this->instructeurModel->verifyTypeVoertuigExists($_POST['typeVoertuigId'])) {
                $data = [
                    'title' => 'Wijzigen voertuiggegevens',
                    'message' => 'Ongeldig type voertuig geselecteerd',
                    'messageColor' => 'danger',
                    'messageVisibility' => 'flex'
                ];
                $this->wijzigenVoertuigGegevens($voertuigId, $instructeurId);
                return;
            }
            
            // First update the vehicle
            $updateResult = $this->instructeurModel->updateVoertuig($_POST);
            
            if ($updateResult) {
                // Then add to instructor
                $addResult = $this->instructeurModel->addVoertuigToInstructeur($voertuigId, $instructeurId);
                
                if ($addResult) {
                    header("Location: " . URLROOT . "/instructeurs/voertuigen/" . $instructeurId);
                    exit();
                }
            }
            
            // If we get here, something went wrong
            $data = [
                'title' => 'Wijzigen voertuiggegevens',
                'message' => 'Er is een fout opgetreden bij het opslaan',
                'messageColor' => 'danger',
                'messageVisibility' => 'flex'
            ];
            $this->wijzigenVoertuigGegevens($voertuigId, $instructeurId);
        }
    }
}