<?php

namespace Manouche\Models;

use Doctrine\ORM\EntityManager;

/**
 * @Entity @Table(name="regulars")
 **/
class Regular extends AbstractModel{
    
    /** @Id @Column(type="integer", name="id") @GeneratedValue **/
    private $id;
    /** @Column(type="string", name="name") **/
    private $name;
    /** @Column(type="string", name="surname") **/
    private $surname;
    /** @Column(type="string", name="cpf") **/
    private $cpf;
    /** @Column(type="string", name="institution_type") **/
    private $institution_type;
    /** @Column(type="string", name="occupation") **/
    private $occupation;
    /**
     * One to one with user
     * @OneToOne(targetEntity="UserModel", inversedBy="regular")
     * @JoinColumn(name="users_id", referencedColumnName="idusers")
     */
    private $user;

    /**
     * This regular person has one address
     * @OneToOne(targetEntity="UserModel", inversedBy="regular")
     * @JoinColumn(name="users_id", referencedColumnName="idusers")
     */
    private $address;

    /**
     * @Inject
     * @param EntityManager $entity
     */
    public function __construct(EntityManager $entity)
    {
        parent::__construct($entity);
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surname
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */ 
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of institution_type
     */ 
    public function getInstitution_type()
    {
        return $this->institution_type;
    }

    /**
     * Set the value of institution_type
     *
     * @return  self
     */ 
    public function setInstitution_type($institution_type)
    {
        $this->institution_type = $institution_type;

        return $this;
    }

    /**
     * Get the value of occupation
     */ 
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set the value of occupation
     *
     * @return  self
     */ 
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get the value of occupation
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of occupation
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
    
}