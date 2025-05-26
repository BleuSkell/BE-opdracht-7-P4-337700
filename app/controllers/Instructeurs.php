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
}