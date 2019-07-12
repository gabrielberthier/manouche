<?php

namespace Manouche\Models;

use Doctrine\ORM\EntityManager;

/**
 * @Entity @Table(name="addresses")
 **/
class Address extends AbstractModel{
    
    /** @Id @Column(type="integer", name="id") @GeneratedValue **/
    private $id;
    private $city;
    private $uf;
    private $neighbourhood;
    private $number;
    private $complement;
    private $latitude;
    private $longitude;

    private $regular;

}