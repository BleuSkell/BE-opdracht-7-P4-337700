<?php

use PHPUnit\Framework\TestCase;

class InstructeurModelTest extends TestCase
{
    private $instructeurModel;

    protected function setUp(): void
    {
        // Create a new instance of InstructeurModel before each test
        $this->instructeurModel = new InstructeurModel();
    }

    public function testGetInstructeurById()
    {
        // Test getting instructor with ID 1
        $result = $this->instructeurModel->getInstructeurById(1);
        
        // Assert that we got a result
        $this->assertNotNull($result);
        
        // Assert that the instructor has expected properties
        $this->assertEquals('Li', $result[0]->Voornaam);
        $this->assertEquals('Zhan', $result[0]->Achternaam);
        $this->assertEquals('***', $result[0]->AantalSterren);
    }

    public function testVerifyTypeVoertuigExists()
    {
        // Test with existing type (1 = Personenauto)
        $resultExists = $this->instructeurModel->verifyTypeVoertuigExists(1);
        $this->assertTrue($resultExists);

        // Test with non-existing type
        $resultNotExists = $this->instructeurModel->verifyTypeVoertuigExists(999);
        $this->assertFalse($resultNotExists);
    }
}
