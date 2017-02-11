<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CompanyController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your companies');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new CompanyForm;
        //return $this->response->redirect("company/search");
    }

    /**
     * Search company based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Company", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $companies = Company::find($parameters);
        if (count($companies) == 0) {
            $this->flash->notice("The search did not find any company");

            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $companies,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->company = $companies;
    }

    /**
     * Shows the form to create a new company
     */
    public function newAction()
    {
		$vendorlist = Company::query()->columns(['vendor_code','name'])
		                              ->order('vendor_code')
		                              ->limit(10)
		                              ->execute();
		$this->view->vCode = $vendorlist;
        $this->view->form = new CompanyForm(null, array('edit' => true));
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $company = Company::findFirstById($id);
            if (!$company) {
                $this->flash->error("Company was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "company",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new CompanyForm($company, array('edit' => true));
        }
    }

    /**
     * Creates a new company
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "index",
                ]
            );
        }

        $form = new CompanyForm;
        $company = new Company();

        $data = $this->request->getPost();
        //$data['vendor_code'] = strtoupper($data['vendor_code']);
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "new",
                ]
            );
        }
		
        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Company was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "company",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current company in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");
        $company = Company::findFirstById($id);
        if (!$company) {
            $this->flash->error("Company does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "index",
                ]
            );
        }

        $form = new CompanyForm;

        $data = $this->request->getPost();
        //$data['vendor_code'] = strtoupper($data['vendor_code']);
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "new",
                ]
            );
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Company was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "company",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a company
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $company = Company::findFirstById($id);
        if (!$company) {
            $this->flash->error("Company was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "company",
                    "action"     => "index",
                ]
            );
        }
		try
		{
			if (!$company->delete()) {
				foreach ($company->getMessages() as $message) {
					$this->flash->error($message);
				}

				return $this->dispatcher->forward(
					[
						"controller" => "company",
						"action"     => "search",
					]
				);
			}

			$this->flash->success("Company was deleted");
		} catch (Exception $e){
			$this->flash->error("Deletion Failed.  Reassign project from this company to another project to delete.");
		}
		

        return $this->dispatcher->forward(
            [
                "controller" => "company",
                "action"     => "index",
            ]
        );
    }
    
    public function vcodeAjaxAction($qstring)
    {
		
		$vendorlist = Company::query()->columns(['vendor_code','name'])
									  ->andwhere('vendor_code LIKE :qstr:')
									  ->bind(['qstr' => $qstring . '%'])
		                              ->order('vendor_code')
		                              ->limit(10)
		                              ->execute();
		                              
		//$this->view->disable();

        //Create a response instance
        $response = new \Phalcon\Http\Response();

        //Set the content of the response
        $response->setContent(json_encode($vendorlist));

        //Return the response
        return $response;
	}
}
