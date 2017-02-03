<?php

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Filter;

/**
 * ProjectController
 *
 * Manage CRUD operations for project
 */
class ProjectController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Mange Your Projects');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
  
		$auth = $this->session->get('auth');			
		$myQuery = Project::query()->limit(100); 
		$params = array(); //Parameters to bind to avoid SQL injections
		$numberPage = 1;
		if($auth['role'] === 'U' ) //Filter for Admin or regular User
		{
			$myQuery->where('company_id = :thecid:');
			$params['thecid'] = $auth['cid'];
			$this->view->setVar("role",'U');
		}else
		{
			$this->view->setVar("role",'A');
		}


		if ($this->request->isPost()) 
		{
			$search = $this->request->getPost("proj-search-str");
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
				$myQuery->andwhere('name LIKE :nid: OR project_id LIKE :nid:');
				$params['nid'] = '%' . $sanSearch . '%';
				
			}
			//$this->persistent->searchParams = $myQuery->getParams();
		}else
		{
			$numberPage = $this->request->getQuery("page", "int");
		}
	
		$projects = $myQuery->bind($params)->execute();
		if (count($projects) == 0) {
			$this->flash->notice("The search did not find any projects");

			return;
			/*
			 $this->dispatcher->forward(
				[
					"controller" => "products",
					"action"     => "index",
				]
			);
			* */
		}
		$this->view->myprojects = $projects; 
    }

    /**
     * Search project based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Project", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $products = Products::find($parameters);


        if (count($products) == 0) {
            $this->flash->notice("The search did not find any products");

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $products,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Shows the form to create a new project
     */
    public function newAction()
    {
        $this->view->form = new ProjectForm(null, array('edit' => true));
    }

    /**
     * Edits a project based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $project = Project::findFirstById($id);
            if (!$project) {
                $this->flash->error("Project was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "project",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new ProjectForm($project, array('edit' => true));
        }
    }

    /**
     * Creates a new project
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProjectForm;
        $project = new Project();
        $project->active = 'Y';

        $data = $this->request->getPost();
        if (!$form->isValid($data, $project)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "new",
                ]
            );
        }

        if ($project->save() == false) {
            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Project was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "project",
                "action"     => "index",
            ]
        );

    }

    /**
     * Saves current project in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $project = Project::findFirstById($id);
        if (!$project) {
            $this->flash->error("Project does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProjectForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $project)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($project->save() == false) {
            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Project was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "project",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a project
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $project = Project::findFirstById($id);
        if (!$project) {
            $this->flash->error("Project was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "index",
                ]
            );
        }
		try{
				if (!$project->delete()) {
					foreach ($project->getMessages() as $message) {
						$this->flash->error($message);
					}

					return $this->dispatcher->forward(
						[
							"controller" => "project",
							"action"     => "index",
						]
					);
				}
				
				 $this->flash->success("Project was deleted");
		} catch (Exception $e){
			$this->flash->error("Deletion Failed.  Project to be deleted has siteboss units assgined to it please reassign them all to delete this project");
		}
       

            return $this->dispatcher->forward(
                [
                    "controller" => "project",
                    "action"     => "index",
                ]
            );
    }
}
