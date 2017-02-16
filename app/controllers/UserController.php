<?php

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Filter;


/**
 * UserController
 *
 * Allows to add new users
 */
class UserController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle(' Add new user');
        parent::initialize();
    }

    /**
     * Action to add a new user
     */
    public function indexAction()
    {	
		$myQuery = User::query()->limit(100); 	
		$params = array(); //Parameters to bind to avoid SQL injections
		$numberPage = $this->request->getQuery("page", "int");
		if(!$numberPage)
		{
			$numberPage = 1;
		}
			
		$search = $this->request->getPost("user-search-str");
		if($search)
		{
			$filter = new Filter();
			$words = explode(" ", $search);
			$filterArray = array();
			foreach( $words as $word)
			{
				$sanitized = $filter->sanitize($word,"alphanum");
				if($sanitized)
				{
					array_push($filterArray, $sanitized);
				}
			}
			
			$sanSearch = implode(" ", $filterArray);
			$myQuery->andwhere('email LIKE :uid: OR username LIKE :uid:')->andwhere("active = 'Y'");
			$params['uid'] = '%' . $sanSearch . '%';
			
		}

		
		$users = $myQuery->bind($params)->execute();
		
		if (count($users) == 0) {
			$this->flash->notice("The search did not find any users");
			return;
		}

		$paginator = new Paginator(array(
			"data"  => $users,
			"limit" => 10,
			"page"  => $numberPage
		));
		$this->view->page = $paginator->getPaginate(); 
//echo app/library/Elements::b64("what's up");//$this->$loader->getNameSpaces();//Elements::testerer('Whats going on');
//        $hey = \Elements::b64("ajfda;lj adlfjk");
        //print_r($hey);
//		$this->view->setVar("aaaa", $hey);//app/library/Elements::b64("what's up"));//$this->$loader->getNameSpaces();//Elements::testerer('Whats going on');
    }

	public function newAction()
    {
        $form = new UserForm;

        if ($this->request->isPost()) {

            $name = $this->request->getPost('name', array('string', 'striptags'));
            $username = $this->request->getPost('username', 'alphanum');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');
			$role = $this->request->getPost('role');
			$companyId = $this->request->getPost('company_id');
            if ($password != $repeatPassword) {
                $this->flash->error('Passwords are different');
                return false;
            }

            $user = new User();
            $user->username = $username;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->name = $name;
            $user->email = $email;
            $user->created_at = new Phalcon\Db\RawValue('now()');
            $user->active = 'Y';
			$user->role = $role;
			$user->company_id = $companyId;
			$user->encryptPassword($password);
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                $this->flash->success('Successfuly added new user');

                return $this->dispatcher->forward(
                    [
                        "controller" => "user",
                        "action"     => "index",
                    ]
                );
            }
        }

        $this->view->form = $form;
    }
    
    /**
     * Edits a user based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $user = User::findFirstById($id);
            if (!$user) {
                $this->flash->error("User was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "user",
                        "action"     => "index",
                    ]
                );
            }

			$user->password = '';
            $this->view->form = new UserForm($user, array('edit' => true));
            $this->view->pick("user/new");
        }
    }
    
    /**
     * Saves current project in screen
     *
     * @param string $id
     */
    public function saveAction()
    {                            
        if ($this->request->isPost()) {
			
			$id = $this->request->getPost("id", "int");
			$user = User::findFirstById($id);
			if (!$user) {
				$this->flash->error("User does not exist");

				return $this->dispatcher->forward(
					[
						"controller" => "user",
						"action"     => "index",
					]
				);
			}  
			
            $name = $this->request->getPost('name', array('string', 'striptags'));
            $username = $this->request->getPost('username', 'alphanum');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');
			$role = $this->request->getPost('role');
			$companyId = $this->request->getPost('company_id');
			
			if($password != $repeatPassword)
			{
					$this->flash->error('Passwords are different');
					$user->username = $username;
					$user->name = $name;
					$user->email = $email;
					$user->role = $role;
					$user->company_id = $companyId;
					$user->password = $password;
					$this->view->form = new UserForm($user, array('edit' => true));
					$this->view->pick("user/new");
					return;
			}
			elseif($password and $repeatPassword)
			{
				$user->password = password_hash($password, PASSWORD_DEFAULT);
				$user->encryptPassword($password);
			}

			//Update the user
            $user->username = $username;
            $user->name = $name;
            $user->email = $email;
			$user->role = $role;
			$user->company_id = $companyId;
			
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                $this->flash->success('Successfuly added/edited a user');

            }
            

        }

		return $this->dispatcher->forward(
			[
				"controller" => "user",
				"action"     => "index",
			]
		);   
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = User::findFirstById($id);
        if (!$user) {
            $this->flash->error("User was not found");
            return $this->dispatcher->forward(
                [
                    "controller" => "user",
                    "action"     => "index",
                ]
            );
        }

        if (!$user->delete()) 
        {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(
                [
                    "controller" => "user",
                    "action"     => "index",
                ]
            );
             
        }   
        $this->flash->success("User was deleted");
            return $this->dispatcher->forward(
                [
                    "controller" => "user",
                    "action"     => "index",
                ]
        );
    } 
    
    
}
