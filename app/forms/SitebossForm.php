<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class SitebossForm extends Form
{

    /**
     * Initialize the project form
     */
    public function initialize($entity = null, $options = array())
    {

        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }


        //$name = new Select('project_id', Project::find(), 
        $name = new Select('project_id', Project::find(array('columns'=> array('id', " CONCAT(projectcode, ' - ', name) as pidn"),)),
        array(
            'using'      => array('id', 'pidn'),
            'useEmpty'   => true,
            'emptyText'  => '...',
            'emptyValue' => ''
        ));
        $name->setLabel('Select project to add this siteboss to');
        $this->add($name);

		$name = new Text('SiteName');
		$name->setLabel('SiteName');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'SiteName is required'))
		));
		$this->add($name);
		$name = new Text('ProjectCode');
		$name->setLabel('ProjectCode');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'ProjectCode is required'))
		));
		$this->add($name);
		$name = new Text('VendorCode');
		$name->setLabel('VendorCode');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'VendorCode is required'))
		));
		$this->add($name);
		$name = new Text('VendorPonum');
		$name->setLabel('VendorPonum');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'VendorPonum is required'))
		));
		$this->add($name);
		$name = new Text('VendorInvoicenum');
		$name->setLabel('VendorInvoicenum');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'VendorInvoicenum is required'))
		));
		$this->add($name);
		$name = new Text('SiteID');
		$name->setLabel('SiteID');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'SiteID is required'))
		));
		$this->add($name);
		$name = new Text('EquipmentRelease');
		$name->setLabel('EquipmentRelease');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'EquipmentRelease is required'))
		));
		$this->add($name);
		$name = new Text('Switch');
		$name->setLabel('Switch');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'Switch is required'))
		));
		$this->add($name);
		$name = new Text('CellNumber');
		$name->setLabel('CellNumber');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'CellNumber is required'))
		));
		$this->add($name);
		$name = new Text('Latitude');
		$name->setLabel('Latitude');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'Latitude is required'))
		));
		$this->add($name);
		$name = new Text('Longitude');
		$name->setLabel('Longitude');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'Longitude is required'))
		));
		$this->add($name);
		$name = new Text('Address');
		$name->setLabel('Address');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'Address is required'))
		));
		$this->add($name);
		$name = new Text('City');
		$name->setLabel('City');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'City is required'))
		));
		$this->add($name);
		$name = new Text('State');
		$name->setLabel('State');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'State is required'))
		));
		$this->add($name);
		$name = new Text('ZIP');
		$name->setLabel('ZIP');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'ZIP is required'))
		));
		$this->add($name);
		$name = new Text('County');
		$name->setLabel('County');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'County is required'))
		));
		$this->add($name);
		$name = new Text('CellTech');
		$name->setLabel('CellTech');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'CellTech is required'))
		));
		$this->add($name);
		$name = new Text('PhoneNumber');
		$name->setLabel('PhoneNumber');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'PhoneNumber is required'))
		));
		$this->add($name);
		$name = new Text('Email');
		$name->setLabel('Email');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'Email is required'))
		));
		$this->add($name);
		$name = new Text('SiteBossIP');
		$name->setLabel('SiteBossIP');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'SiteBossIP is required'))
		));
		$this->add($name);
		$name = new Text('Subnet');
		$name->setLabel('Subnet');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'Subnet is required'))
		));
		$this->add($name);
		$name = new Text('Gateway');
		$name->setLabel('Gateway');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'Gateway is required'))
		));
		$this->add($name);
		$name = new Text('RouterPort');
		$name->setLabel('RouterPort');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'RouterPort is required'))
		));
		$this->add($name);
		$name = new Text('AccessDirections');
		$name->setLabel('AccessDirections');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'AccessDirections is required'))
		));
		$this->add($name);
		$name = new Text('SiteNotes');
		$name->setLabel('SiteNotes');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'SiteNotes is required'))
		));
		$this->add($name);
		$name = new Text('PowerPlant');
		$name->setLabel('PowerPlant');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'PowerPlant is required'))
		));
		$this->add($name);
		$name = new Text('PowerPlantMonitored');
		$name->setLabel('PowerPlantMonitored');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'PowerPlantMonitored is required'))
		));
		$this->add($name);
		$name = new Text('PowerPlantIP');
		$name->setLabel('PowerPlantIP');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'PowerPlantIP is required'))
		));
		$this->add($name);
		$name = new Text('PowerPlantComment');
		$name->setLabel('PowerPlantComment');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'PowerPlantComment is required'))
		));
		$this->add($name);
		$name = new Text('HVAC');
		$name->setLabel('HVAC');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'HVAC is required'))
		));
		$this->add($name);
		$name = new Text('HVACMonitored');
		$name->setLabel('HVACMonitored');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'HVACMonitored is required'))
		));
		$this->add($name);
		$name = new Text('HVACIP');
		$name->setLabel('HVACIP');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'HVACIP is required'))
		));
		$this->add($name);
		$name = new Text('HVACComment');
		$name->setLabel('HVACComment');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'HVACComment is required'))
		));
		$this->add($name);
		$name = new Text('ATSType');
		$name->setLabel('ATSType');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'ATSType is required'))
		));
		$this->add($name);
		$name = new Text('ATSComment');
		$name->setLabel('ATSComment');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'ATSComment is required'))
		));
		$this->add($name);
		$name = new Text('GeneratorRunSchedule');
		$name->setLabel('GeneratorRunSchedule');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'GeneratorRunSchedule is required'))
		));
		$this->add($name);
		$name = new Text('GenType');
		$name->setLabel('GenType');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'GenType is required'))
		));
		$this->add($name);
		$name = new Text('GenModel');
		$name->setLabel('GenModel');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'GenModel is required'))
		));
		$this->add($name);
		$name = new Text('FuelType');
		$name->setLabel('FuelType');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'FuelType is required'))
		));
		$this->add($name);
		$name = new Text('FuelGaugeType');
		$name->setLabel('FuelGaugeType');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'FuelGaugeType is required'))
		));
		$this->add($name);
		$name = new Text('FuseorBreaker');
		$name->setLabel('FuseorBreaker');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'FuseorBreaker is required'))
		));
		$this->add($name);
		$name = new Text('CompletionDate');
		$name->setLabel('CompletionDate');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'CompletionDate is required'))
		));
		$this->add($name);
		$name = new Text('CompletionName');
		$name->setLabel('CompletionName');
		$name->setFilters(array('striptags','string'));
		$name->addValidators(array(
		new PresenceOf(array(
		'message' => 'CompletionName is required'))
		));
		$this->add($name);


    }
}
