<?php

namespace PharmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity(repositoryClass="PharmaciaBundle\Repository\PacienteRepository")
 */
class Paciente
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="idNumber", type="string", length=255)
     */
    private $idNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="idType", type="string", length=255)
     */
    private $idType;

    

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text")
     */
    private $observations;


    /**
     * @var arrayColection
     * @ORM\ManyToMany(targetEntity="Analisis", inversedBy="Paciente")
     * @ORM\JoinTable (name="paciente_analisis")
     */
    private $analisis=null;

    public function __construct()
    {
        $this->analisis = new ArrayCollection();
    }

    public function getAnalisis(){
        return $this->analisis;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Paciente
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Paciente
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Paciente
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set idNumber
     *
     * @param string $idNumber
     *
     * @return Paciente
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * Get idNumber
     *
     * @return string
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * Set idType
     *
     * @param string $idType
     *
     * @return Paciente
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return string
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set analisis
     *
     * @param string $analisis
     *
     * @return Paciente
     */
    public function setAnalisis($analisis)
    {
        $this->analisis = $analisis;

        return $this;
    }

    

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return Paciente
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    public function __toString(){
        return $this->name;
    }
}

