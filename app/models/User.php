<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class User extends Model
{
	private $ivs = 20698103;
	private $passphrase = '$@ttl3WA$3ntr!a'; 
	public $company_id;
	public $salt;
	public $id;
	
    public function validation()
    {
        $validator = new Validation();
        
        $validator->add(
            'email',
            new EmailValidator([
            'message' => 'Invalid email given'
        ]));
        $validator->add(
            'email',
            new UniquenessValidator([
            'message' => 'Sorry, The email was registered by another user'
        ]));
        $validator->add(
            'username',
            new UniquenessValidator([
            'message' => 'Sorry, That username is already taken'
        ]));
        
        return $this->validate($validator);
    }
    
    public function encryptPassword($unencryptedText)
    {
		//$vector = $this->ivs;
		$pw = mcrypt_encrypt(MCRYPT_BLOWFISH, $this->passphrase, $unencryptedText, MCRYPT_MODE_CBC, $this->ivs); 
		$this->salt = base64_encode($pw);
		return; 
	}
	
	public function decryptPassword()
	{
		$debase64 = base64_decode($this->salt);
		//$vector = $this->ivs;
		$dec = mcrypt_decrypt(MCRYPT_BLOWFISH, $this->passphrase, $debase64, MCRYPT_MODE_CBC, $this->ivs); 
		return $dec;
	}
}
