<?php

use Phalcon\Mvc\Model;

class Project extends Model
{

	/**
	 * @var integer
	 */
	public $id;
		/**
	 * @var integer
	 */
	public $company_id;
	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */	
	public $projectcode;

	public $active;


}
