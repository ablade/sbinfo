<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class ProjectForm extends Form
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

        $name = new Text("name");
        $name->setLabel("Name");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Name is required'
            ))
        ));
        $this->add($name);

        $companies = new Select('company_id', Company::find(), array(
            'using'      => array('id', 'name'),
            'useEmpty'   => true,
            'emptyText'  => '...',
            'emptyValue' => ''
        ));
        $companies->setLabel('Company');
        $this->add($companies);

        $projectId = new Text("project_id");
        $projectId->setLabel("Project Id");
        $projectId->setFilters(array('int'));
        $projectId->addValidators(array(
            new PresenceOf(array(
                'message' => 'Project Id is required'
            )),
            new Numericality(array(
                'message' => 'Project Id is required'
            ))
        ));
        $this->add($projectId);
    }
}
