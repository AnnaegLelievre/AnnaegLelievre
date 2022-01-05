<?php

/**
 * 
 * Classe permettant de definir une adresse
 * @author Pascal Lamy
 *
 */
class Adresse
{

    private int $id;
    private int $numero;
    private ?string $rue;
    private ?int $codePostal;
    private ?string $ville;
    private int $id_pers;

    function __construct(int $id, int $numero, string $rue, int $codePostal, string $ville, int $id_pers)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->rue = $rue;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->id_pers = $id_pers;
    }

    function getId()
    {
        return $this->id;
    }

    function getNumero()
    {
        return $this->numero;
    }

    function getRue()
    {
        return $this->rue;
    }

    function getCodePostal()
    {
        return $this->codePostal;
    }

    function getVille()
    {
        return $this->ville;
    }

    function getIdPers()
    {
        return $this->id_pers;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNumero($numero)
    {
        $this->numero = $numero;
    }

    function setRue($rue)
    {
        $this->rue = $rue;
    }

    function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    function setVille($ville)
    {
        $this->ville = $ville;
    }

    function setIdPers($id_pers)
    {
        $this->id_pers = $id_pers;
    }

    /**
     *
     * renvoie sous forme de chaine de caracteres l'objet adresse en appelant echo ou print
     */

    public function __toString()
    {
        return '[' . $this->getId() . ','
            . $this->getNumero() . ','
            . $this->getRue() . ','
            . $this->getCodePostal() . ','
            . $this->getVille() . ','
            . $this->getIdPers() . ']';
    }
}
