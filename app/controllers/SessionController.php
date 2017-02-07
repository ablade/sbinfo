<?php

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->tag->setDefault('email', 'alvin');
            $this->tag->setDefault('password', 'Asentria1!');
            
            
            
            
			if ($this->cookies->has("remember-me")) {
				// Get the cookie
				$rememberMeCookie = $this->cookies->get("remember-me");
				// Get the cookie's value
				$value = $rememberMeCookie->getValue();
				$this->tag->setDefault('inst_name', $value);
			} 
			
        }
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(User $user)
    {
        $this->session->set('auth', array(
            'id'   => $user->id,
            'name' => $user->name,
			'role' => $user->role,
			'cid'  => $user->company_id
        ));
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {

        $email = $this->request->getPost('email');
	    $password = $this->request->getPost('password');
	    $yourname = $this->request->getPost('inst_name'); 
	    $this->cookies->set(
			"remember-me",
			$yourname,
			time()+ 15*86400 //15 days  
		);
	    
	    if(!$email or !$password or !$yourname)
	    {
			$this->flash->error('All fields are required');
			return $this->dispatcher->forward(
            [
                "controller" => "session",
                "action"     => "index",
            ]
        );
		}
	    
	    $myarr = array(
                "(email = :email: OR username = :email:) AND active = 'Y'",
                'bind' => array('email' => $email)
		);
		
		
		
            $user = User::findFirst($myarr);

            //Verify that a user was found in the database and that the
            //passwords match.
             
            if ($user && password_verify($password, $user->password)) {				
                $this->_registerSession($user);
                //$this->flash->success('Welcome ' . $user->name);
               
               
				//Dispatch this to the next controller
				if($user->role === 'U')
				{
					$this->view->setVar("role",'U');
					/*
				    return $this->dispatcher->forward(
                    [
                        "controller" => "project",
                        "action"     => "index",
                    ]);
                    
                    */
                    
                }elseif($user->role ==='A')
                {
					$this->view->setVar("role",'A');
					/*
					return $this->dispatcher->forward(
                    [
                        "controller" => "project",
                        "action"     => "index",
                    ]);
					*/
					
				}
                                 
                   //return $ret;
                   return $this->response->redirect("project");
            }
  
            $this->flash->error('Wrong email/password');
        }

        return $this->dispatcher->forward(
            [
                "controller" => "session",
                "action"     => "index",
            ]
        );
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }
}
