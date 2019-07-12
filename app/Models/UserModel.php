<?php

namespace Manouche\Models;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\EntityManager;

/**
 * @Entity @Table(name="users")
 **/
class UserModel extends AbstractModel
{
    /**
     * Table of current instance
     *
     * @var string
     */
    protected $tableName = "users";
    /** @Id @Column(type="integer", name="idusers") @GeneratedValue **/
    private $idusers;
    /** @Column(type="string", name="username") **/
    private $username;
    /** @Column(type="string", name="email") **/
    private $email;
    /** @Column(type="string", name="password") **/
    private $password;
    /** @Column(type="datetime", name="createdAt") **/
    private $createdAt;
    /** @Column(type="datetime", name="updatedAt") **/
    private $updatedAt;
    /** @Column(type="string", name="roles", options={"default":"common"} ) **/
    private $roles = "common";
    /**
     * One to one with regular
     * @OneToOne(targetEntity="Regular", mappedBy="user")
     */
    private $regular;

    /**
     * Annotation combined with phpdoc:
     *
     * @Inject
     * @param EntityManager $entity
     */
    public function __construct(EntityManager $entity)
    {
        parent::__construct($entity);
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = manoucheHash($password);

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles(string $roles)
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * Returns true if user already exists
     *
     * @return bool
     */
    public function exists()
    {
        try{
            $user = $this->database->getRepository(static::class)->createQueryBuilder('u')
            ->andWhere('u.email = :email OR u.username = :name')
            ->setParameter('email', $this->email)
            ->setParameter('name', $this->username)
            ->getQuery()
            ->getOneOrNullResult();
            return ($user !== null);
        }
        catch(NonUniqueResultException $ex){
            return true;
        }
    }

    /**
     * Get the value of idusers
     */
    public function getIdusers()
    {
        return $this->idusers;
    }

    /**
     * Set the value of idusers
     *
     * @return  self
     */
    public function setIdusers($idusers)
    {
        $this->idusers = $idusers;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get one to one with regular
     */ 
    public function getRegular()
    {
        return $this->regular;
    }

    /**
     * Set one to one with regular
     *
     * @return  self
     */ 
    public function setRegular($regular)
    {
        $this->regular = $regular;

        return $this;
    }
}
