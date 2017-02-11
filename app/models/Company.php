<?php

use Phalcon\Mvc\Model;

class Company extends Model
{
    /**
     * @var integer
     */
    public $id;
    
        /**
     * @var string
     */
    public $vendor_code;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $telephone;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $city;

}
