<?php

use Phalcon\Mvc\Model;

class Image extends Model
{
	/**
	 * @var integer
	 */
	public $id;
		/**
	 * @var integer
	 */
	public $siteboss_id;
	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var string
	 */	
	public $datatype;

	public $data;


}
