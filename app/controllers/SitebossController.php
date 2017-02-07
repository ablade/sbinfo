<?php

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Filter;

/**
 * ProjectController
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
		
		if($pid and is_numeric($pid)) //must always have an argument
		{   			
			$params['pid'] = $pid;
			$myQuery = Project::query()->where('id = :pid:');
			if($auth['role'] !== 'A') //Filter for Admin or regular User
			{
					$params['cid'] = $auth['cid'];
					$myQuery->andwhere('company_id = :cid:');
					$this->view->setVar("role",'U');
			}else
			{
					$this->view->setVar("role",'A');
			}
										
			$project = $myQuery->bind($params)->execute();
				
			if (count($project) == 0) {
				$this->flash->notice("Contact Admin to access this Project");

				return $this->dispatcher->forward(
					[
						"controller" => "project",
						"action"     => "index",
					]
				);
			}else
			{
				
				$mySB = Siteboss::query()->where('project_id = :pid:')
											->bind(['pid' => $pid])
											->execute();
									
				if (count($mySB) == 0) {
					$this->flash->notice("No SiteBoss found for this project");

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
				$numberPage = 1;
				$paginator = new Paginator(array(
					"data"  => $mySB,
					"limit" => 10,
					"page"  => $numberPage
				));
				$this->view->page = $paginator->getPaginate(); 	
				//echo $project[0]->name;
				$this->view->setVar("projectname", $project[0]->name);
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
    }

    /**
     * Shows the form to create a new product
     */
    public function newAction()
    {
        $this->view->form = new SitebossForm(null, array('edit' => true));
    }

    /**
     * Edits a product based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $product = Products::findFirstById($id);
            if (!$product) {
                $this->flash->error("Product was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "products",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new ProductsForm($product, array('edit' => true));
        }
    }

    /**
     * Creates a new product
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProductsForm;
        $product = new Products();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "new",
                ]
            );
        }

        if ($product->save() == false) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Product was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "products",
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
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $product = Products::findFirstById($id);
        if (!$product) {
            $this->flash->error("Product does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProductsForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($product->save() == false) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Product was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "products",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a product
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $products = Products::findFirstById($id);
        if (!$products) {
            $this->flash->error("Product was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
        }

        if (!$products->delete()) {
            foreach ($products->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Product was deleted");

            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
    }
    
    public function controlAction($id, $btn)
    {
        $mySb = Siteboss::query()->where('id = :pid:')
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
}
