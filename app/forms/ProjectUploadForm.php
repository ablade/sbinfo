<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class ProjectUploadForm extends Form
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

		$projectId = new Text("projectcode",['oninput' => 'project.getProjectCode(this);']);
        $projectId->setLabel("New Project Code");
        $projectId->setFilters(array('striptags','string','upper'));
        $projectId->addValidators(array(
            new PresenceOf(array(
                'message' => 'Project Code is required'
            ))
        ));
        $this->add($projectId);
        
        $name = new Text("name");
        $name->setLabel("Descriptive Name");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'A description is required'
            ))
        ));
        $this->add($name);

        $companies = new Select('company_id', Company::find(), array(
            'using'      => array('id', 'name'),
            'useEmpty'   => true,
            'emptyText'  => '...',
            'emptyValue' => ''
        ));
        $companies->setLabel('Vendor Name');
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Vendor Name is required'
            ))
        ));
        $this->add($companies);


    }
}
