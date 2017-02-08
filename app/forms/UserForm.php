<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Numericality;

class UserForm extends Form
{

    public function initialize($entity = null, $options = null)
    {
		
		if (isset($options['edit'])) {
            $this->add(new Hidden("id"));
        }
		
		
		$companies = new Select('company_id', Company::find(), array(
            'using'      => array('id', 'name'),
            'useEmpty'   => true,
            'emptyText'  => '...',
            'emptyValue' => ''
        ));
        $companies->blankmessage = 'Please select a company for the user';
        $companies->setLabel('Company to assign the new User');
        $this->add($companies);
        
        // Name
        $name = new Text('name');
        $name->blankmessage = 'Please enter the user\'s full name';
        $name->setLabel('Full Name');
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Name is required'
            ))
        ));
        $this->add($name);

		$rrole = new Select(
			"role",
			[
				"U" => "Installer",
				"A" => "Admin",
			]
			);
		$rrole->blankmessage = 'Please select a role for the user';
		$rrole->setLabel("Assign a role to the user");
		$this->add($rrole);


        // Name
        $name = new Text('username');
        $name->id = 'username';
        $name->blankmessage = 'Please enter the desired username';
        $name->setLabel('Username');
        $name->setFilters(array('alpha'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Please enter the desired username'
            ))
        ));
        $this->add($name);

        // Email
        $email = new Text('email');
        $email->blankmessage = 'Please enter a vaild email';
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'E-mail is required'
            )),
            new Email(array(
                'message' => 'E-mail is not valid'
            ))
        ));
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->blankmessage = 'Please provide a valid password';
        $password->setLabel('Password');
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Password is required'
            ))
        ));
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->blankmessage = 'The password does not match';
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'Confirmation password is required'
            ))
        ));
        $this->add($repeatPassword);
    }
}
