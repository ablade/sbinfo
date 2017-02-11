<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class CompanyForm extends Form
{

    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = array())
    {

        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $name = new Text("name");
        $name->setLabel("Vendor Name");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Name is required'
            ))
        ));
        $this->add($name);

		$name = new Text('vendor_code',['oninput' => 'company.getVendorCode(this);']);
        $name->setLabel("Vendor Code");
        $name->setFilters(array('striptags', 'string', 'upper'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Vendor Code is required and cannot be a duplicate'
            ))
        ));
        $this->add($name);
        
        $telephone = new Text("telephone");
        $telephone->setLabel("Telephone");
        $telephone->setFilters(array('striptags', 'string'));
        $telephone->addValidators(array(
            new PresenceOf(array(
                'message' => 'Telephone is required'
            ))
        ));
        $this->add($telephone);

        $address = new Text("address");
        $address->setLabel("Address");
        $address->setFilters(array('striptags', 'string'));
        $address->addValidators(array(
            new PresenceOf(array(
                'message' => 'Address is required'
            ))
        ));
        $this->add($address);

        $city = new Text("city");
        $city->setLabel("City");
        $city->setFilters(array('striptags', 'string'));
        $city->addValidators(array(
            new PresenceOf(array(
                'message' => 'City is required'
            ))
        ));
        $this->add($city);
    }

}
