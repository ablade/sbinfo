<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{
	/**
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */
	public function getAcl()
	{
		if (!isset($this->persistent->acl)) {

			$acl = new AclList();

			$acl->setDefaultAction(Acl::DENY);

			// Register roles
			$roles = [
				'admin'  => new Role(
					'Admin',
					'Admin privileges, granted after sign in.'
				),
				'users'  => new Role(
					'Users',
					'Member privileges, granted after sign in.'
				),
				'guests' => new Role(
					'Guests',
					'Anyone browsing the site who is not signed in is considered to be a "Guest".'
				)
			];

			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			$adminResources = array(
					'user'        => array('index','new', 'edit', 'save', 'create', 'delete'),
					'register'    => array('index'),
					'company'     => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete', 'vcodeajax'),
					'project'     => array('new', 'edit', 'save', 'create', 'delete', 'pcodeajax', 'upload','download', 'uploadsheet', 'downloadproject'),
					'siteboss'    => array('new','create','delete')	
					
			);
			foreach ($adminResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}
			
			//Private area resources
			$privateResources = array(
				
				'project'     => array('index', 'search'),
				'siteboss'    => array('index', 'takephoto', 'edit', 'save', 'control','projsiteajax')	
			);
			foreach ($privateResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			//Public area resources
			$publicResources = array(
				'index'      => array('index'),
				'about'      => array('index'),
				'errors'     => array('show401', 'show404', 'show500'),
				'session'    => array('index', 'register', 'start', 'end')
			);
			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			//Grant access to public areas to both users and guests
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}

			//Grant access to private area to role Users
			foreach ($privateResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Users', $resource, $action);
					$acl->allow('Admin', $resource, $action);
				}
			}

			//Grant access to private area to role Users
			foreach ($adminResources as $resource => $actions) {
				foreach ($actions as $action){
					//$acl->allow('Users', $resource, $action);
					$acl->allow('Admin', $resource, $action);
				}
			}
			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}

		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 * @return bool
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher)
	{
		$auth = $this->session->get('auth');
		if (!$auth){
			$role = 'Guests';
		} elseif($auth['role'] === 'U') {
			$role = 'Users';
		} elseif($auth['role'] === 'A') {
			$role = 'Admin';
		}

        $dispatcher->setControllerName(strtolower($dispatcher->getControllerName()));
        $dispatcher->setActionName(strtolower($dispatcher->getActionName()));
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
		
		
		$acl = $this->getAcl();

		if (!$acl->isResource($controller)) {
			$dispatcher->forward([
				'controller' => 'errors',
				'action'     => 'show404'
			]);

			return false;
		}

		$allowed = $acl->isAllowed($role, $controller, $action);
		if (!$allowed) {
			$dispatcher->forward(array(
				'controller' => 'errors',
				'action'     => 'show401'
			));
                        $this->session->destroy();
			return false;
		}
	}
}
