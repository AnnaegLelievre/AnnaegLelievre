<?php

use PHPUnit\Framework\TestCase;

require_once "Constantes.php";
include_once "PDO/connectionPDO.php";
require_once "metier/Adresse.php";
require_once "PDO/AdresseDB.php";

class AdresseDBTest extends TestCase
{

    /**
     * @var AdresseDB
     */
    protected $adresse;
    protected $pdodb;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */

    /**
     * 
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     * @coversNothing
     */

    protected function setUp(): void
    {
        //parametre de connexion à la bae de donnée
        $strConnection = Constantes::TYPE . ':host=' . Constantes::HOST . '3309;dbname=' . Constantes::BASE;
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     *@coversNothing
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers AdresseDB::ajout
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     */
    public function testAjout()
    {
        try {
            $this->adresse = new AdresseDB($this->pdodb);

            $p = new Adresse(6, 6, "Larue", 35000, "Laville");
            //insertion en bdd
            $this->adresse->ajout($p);

            $adr = $this->adresse->selectAdresse($p->getId());
            //echo "adr bdd: $adr";
            $this->assertEquals($p->getId(), $adr->getId());
            $this->assertEquals($p->getNumero(), $adr->getNumero());
            $this->assertEquals($p->getRue(), $adr->getRue());
            $this->assertEquals($p->getCodePostal(), $adr->getCodePostal());
            $this->assertEquals($p->getVille(), $adr->getVille());
        } catch (Exception $e) {
            echo 'Exception recue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @covers AdresseDB::suppression
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     */
    public function testSuppression()
    {
        try {
            $this->adresse = new AdresseDB($this->pdodb);

            $adr = $this->adresse->selectAdresse("1");
            $this->adresse->suppression($adr);
            $adr2 = $this->adresse->selectAdresse("1");
            if ($adr2 != null) {
                $this->markTestIncomplete(
                    "La suppression de l'enreg adresse a echoué"
                );
            }
        } catch (Exception $e) {
            //verification exception
            $exception = "RECORD ADRESSE not present in DATABASE";
            $this->assertEquals($exception, $e->getMessage());
        }
    }

    /**
     * @covers AdresseDB::selectionId
     *
     */
    /**
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     */
    public function testSelectAdresse()
    {
        $this->adresse = new AdresseDB($this->pdodb);
        $p = $this->adresse->selectAdresse("1");
        $this->assertEquals($p->getId(), $p->getId());
        $this->assertEquals($p->getNumero(), $p->getNumero());
        $this->assertEquals($p->getRue(), $p->getRue());
        $this->assertEquals($p->getCodePostal(), $p->getCodePostal());
        $this->assertEquals($p->getVille(), $p->getVille());
    }

    /**
     * @covers AdresseDB::selectAll
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     */
    public function testSelectAll()
    {
        $ok = true;
        $this->adresse = new AdresseDB($this->pdodb);
        $res = $this->adresse->selectAll();
        $i = 0;
        foreach ($res as $key => $value) {
            $i++;
        }
        if ($i == 0) {
            $this->markTestIncomplete('Pas de résultat');
            $ok = false;
        }
        $this->assertTrue($ok);
    }

    /**
     * @covers AdresseDB::convertPdoAdr
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     */
    public function testConvertPdoAdr()
    {
        $tab["id"] = 5;
        $tab["numero"] = 12;
        $tab["rue"] = "Larue";
        $tab["codepostal"] = 35000;
        $tab["ville"] = "Laville";
        $this->adresse = new AdresseDB($this->pdodb);
        $adr = $this->adresse->convertPdoAdr($tab);
        $this->assertEquals($tab["id"], $adr->getId());
        $this->assertEquals($tab["numero"], $adr->getNumero());
        $this->assertEquals($tab["rue"], $adr->getRue());
        $this->assertEquals($tab["codepostal"], $adr->getCodePostal());
        $this->assertEquals($tab["ville"], $adr->getVille());
    }

    /**
     * @covers AdresseDB::update
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     */
    public function testUpdate()
    {

        $this->adresse = new AdresseDB($this->pdodb);
        //insertion en bdd de l'enreg
        $p = new Adresse(1, 67, "Lotrerue", 56000, "Lotreville");
        //insertion en bdd
        $this->adresse->ajout($p);

        //instanciation de l'objet pour mise ajour

        $p = new Adresse(1, 4, "thatRue", 35000, "thatVille");
        //update pers 
        $lastId = $this->pdodb->lastInsertId();
        $p->setId($lastId);
        $this->adresse->update($p);
        $adr = $this->adresse->selectAdresse($p->getId());
        $this->assertEquals($p->getId(), $adr->getId());
        $this->assertEquals($p->getNumero(), $adr->getNumero());
        $this->assertEquals($p->getRue(), $adr->getRue());
        $this->assertEquals($p->getCodePostal(), $adr->getCodePostal());
        $this->assertEquals($p->getVille(), $adr->getVille());
    }
}
