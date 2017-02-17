<?php

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Filter;

/**
 * SitebossController
 *
 * Manage CRUD operations for products
 */
class SitebossController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Mange Your Sites');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction($pid)
    {
		$auth = $this->session->get('auth');
		$mySb;
		$sbQuery = Siteboss::query();
		$params;
		$project;
		if($auth['role'] === 'A')
		{
			$sbQuery->limit(10);
			$this->view->setVar("role",'A');	
			if($pid and is_numeric($pid))
			{
				$myQuery = Project::query()->where('id = :pid:');
				$project = $myQuery->bind(['pid' => $pid])->execute();
				$sbQuery->andwhere('project_id = :pid:');
				if (!$this->request->isPost()) 
				{
					$sbQuery->bind(['pid' => $pid]);	
				}else
				{
					$params['pid'] = $pid;
				}
			}	
		}elseif($pid and is_numeric($pid)) //must always have an argument
		{  
				$this->view->setVar("role",'U');
				$myQuery = Project::query()->where('id = :pid:');
				$myQuery->andwhere('company_id = :cid:');					
				$project = $myQuery->bind(['pid' => $pid, 'cid' => $auth['cid']])->execute();
				
				
			if (count($project) == 0) {
				$this->flash->notice("Contact Admin to access this Project");

				return $this->dispatcher->forward(
					[
						"controller" => "project",
						"action"     => "index",
					]);
			}
			else
			{
				$sbQuery->andwhere('project_id = :pid:');
				if (!$this->request->isPost()) 
				{
					$sbQuery->bind(['pid' => $pid]);	
				}else
				{
					$params['pid'] = $pid;
				}			
			}
											
			
		}else
		{
			$this->flash->notice("Contact Admin to access this Project");
			return $this->dispatcher->forward(
				[
					"controller" => "project",
					"action"     => "index",
				]
			);
		}
		
		if ($this->request->isPost()) 
		{
			$search = $this->request->getPost("site-search-str");
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
				$params['nid'] = '%' . $sanSearch . '%';
				$sbQuery->andwhere('SiteName LIKE :nid: OR SiteID LIKE :nid:');
				$sbQuery->bind($params);
					
			}
		}
		
		
		
		$mySB = $sbQuery->execute();
		
		if (count($mySB) == 0) {
			$this->flash->notice("No SiteBoss found for this project");
			return;
		}
		
		
		$this->view->setVar("sb", $mySB);
		$this->view->setVar("project123", $project[0]);
    }

    /**
     * Shows the form to create a new Siteboss
     */
    public function newAction()
    {
		
        $this->view->form = new SitebossForm(null, array('edit' => true));
    }

    /**
     * Edits a siteboss based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $sb = Siteboss::findFirstByUniqueID($id);
            if (!$sb) {
                $this->flash->error("Siteboss was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "siteboss",
                        "action"     => "index",
                    ]
                );
            }
			
            $this->view->form = new SitebossForm($sb, array('edit' => true));
        }
    }

    /**
     * Creates a new siteboss
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "Siteboss",
                    "action"     => "index",
                ]
            );
        }

        $form = new SitebossForm;
        $siteboss = new Siteboss();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $siteboss)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "Siteboss",
                    "action"     => "new",
                ]
            );
        }

        if ($siteboss->save() == false) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "siteboss",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Siteboss was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "siteboss",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current product in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "siteboss",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("UniqueID", "int");

        $sb = Siteboss::findFirstByUniqueID($id);
        if (!$sb) {
            $this->flash->error("Siteboss does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "siteboss",
                    "action"     => "index",
                ]
            );
        }

        $form = new SitebossForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $sb)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "siteboss",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($sb->save() == false) {
            foreach ($sb->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "siteboss",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Siteboss was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "siteboss",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a siteboss
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $sb = Siteboss::findFirstByUniqueID($id);
        if (!$sb) {
            $this->flash->error("Siteboss was not found");
			return $this->response->redirect("siteboss");
        }

        if (!$sb->delete()) {
            foreach ($sb->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->response->redirect("siteboss");
        }
		
		$message = 'Deleted Site : ' . $sb->SiteID . ' - ' . $sb->SiteName;
        $this->flash->success($message);
        return $this->response->redirect("siteboss");
    }
    
    /**
     * Shows the control buttons after a user selects a siteboss.
     */  
    public function controlAction($id, $btn)
    {
        $mySb = Siteboss::query()->where('UniqueID = :pid:')
								 ->bind(['pid' => $id])
								 ->execute();
        $this->view->setVar('sbName', $mySb[0]);
        //$this->view->
        //$hey = $this->testerer();
        /*
        $click = strtolower($btn);
        switch($click)
        {
			case 'details':
			print_r($btn);
			break;
			case "photo":
			print_r($btn);
			break;
			case "notes":
			print_r($btn);			
			break;
			case "complete":
			print_r($btn);			
			break;
			default:
			print_r("hello default");			
		}
        echo $hey;
        */ 
				
    }
    
    
    public function takephotoAction($sid)
    {
		
		echo 'The siteboss id "' . $sid ;
		//Get sb with id and get project_id
		//If role U project exist with p_id and c_id good
	}
	
	public function projSiteAjaxAction($pid,$qstring)
    {    

		$this->view->disable();
		$sbQuery = Siteboss::query()->limit(10)->columns(['UniqueID','SiteName','SiteID']);
		$filter = new Filter();
		$words = explode(" ", $qstring);
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
		$params['nid'] = '%' . $sanSearch . '%';
		$sbQuery->andwhere('SiteName LIKE :nid: OR SiteID LIKE :nid:');
		$sbQuery->bind($params);
		$mySB = $sbQuery->execute();
		                              
        //Create a response instance
        $response = new \Phalcon\Http\Response();

        //Set the content of the response
        $response->setContent(json_encode($mySB));

        //Return the response
        return $response;
	}
	
}
