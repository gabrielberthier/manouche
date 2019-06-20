<?php

namespace Manouche\Models;
/**
 * @Entity @Table(name="users")
 **/
class UserModel {
    
    //protected $tableName = "users";
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;
    /** @Column(type="string") **/
    private $name;


}