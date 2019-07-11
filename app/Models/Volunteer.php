<?php

namespace Manouche\Models;

use Doctrine\ORM\EntityManager;

class Volunteer extends AbstractModel{
    
    
    
    /**
     * @Inject
     * @param EntityManager $entity
     */
    public function __construct(EntityManager $entity)
    {
        parent::__construct($entity);
    }

}