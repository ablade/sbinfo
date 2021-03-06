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
				$myQuery->andwhere('name LIKE :nid: OR projectcode LIKE :nid:');
				$params['nid'] = '%' . $sanSearch . '%';
				
			}
			//$this->persistent->searchParams = $myQuery->getParams();
		}
	
		$projects = $myQuery->bind($params)->execute();
		if (count($projects) == 0) {
			$this->flash->notice("The search did not find any projects");

			return;
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
        //$this->view->form = new ProjectForm(null, array('edit' => true));
        $this->view->form = new ProjectUploadForm(null, array('edit' => true));
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

            //$this->view->form = new ProjectForm($project, array('edit' => true));
			$this->view->form = new ProjectUploadForm($project, array('edit' => true));
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

        //$form = new ProjectForm;
        $form = new ProjectUploadForm;
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

        //$form = new ProjectForm;
        $form = new ProjectUploadForm;
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
    
    
    
    public function pcodeAjaxAction($qstring)
    {     
		$this->view->disable();                         
		$pCode = Project::query()->columns(['id','name','projectcode'])
								 ->andwhere('projectcode LIKE :qstr: OR name LIKE :qstr:')
								 ->bind(['qstr' => '%' . $qstring . '%'])
		                         ->order('projectcode')
		                         ->limit(10)
		                         ->execute();
		                              
        //Create a response instance
        $response = new \Phalcon\Http\Response();

        //Set the content of the response
        $response->setContent(json_encode($pCode));

        //Return the response
        return $response;
	}
	
	/**
     * Shows the form to create a new project
     */
    public function uploadAction()
    {
		if ($this->request->isPost()) 
		{
			require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';
			$form = new ProjectUploadForm;
			$proj = new Project();
			$proj->active = 'Y';
			$data = $this->request->getPost();
			if (!$form->isValid($data, $proj)) {
				foreach ($form->getMessages() as $message) {
					$this->flash->error($message);
				}
				return $this->dispatcher->forward(
					[
						"controller" => "project",
						"action"     => "uploadsheet",
					]
				);
			}else
			{
				try{
					if ($proj->save() == false) {
						foreach ($proj->getMessages() as $message) {
							$this->flash->error($message);
						}
						return $this->dispatcher->forward(
							[
								"controller" => "project",
								"action"     => "uploadsheet",
							]
						);
					}else
					{
						foreach ($this->request->getUploadedFiles() as $myfile) 
						{
							$this->_processXLSX($myfile,$proj);
					
						}//For Loop		
					}
					
				} catch (Exception $e){ //Project wasn't saved
					echo '<br>' .$e->getMessage() . '<br>';
					//echo '<pre>' . $e->getTraceAsString() . '</pre>';
				} 
				// There should only by one file so lets validate
		
			} //else valid
		}else
		{
			return $this->dispatcher->forward(
					[
						"controller" => "project",
						"action"     => "uploadsheet",
					]
				);
		}
    }
    
    public function uploadSheetAction()
    {
			$pCode = Project::query()->columns(['projectcode'])
							 ->order('projectcode')
							 ->limit(10)
							 ->execute();
									
			$this->view->pCode = $pCode;
			
			$this->view->form = new ProjectUploadForm(null,array('edit' => true));
			$this->view->pick("project/upload");	
	}
    
    
	/**
     * Shows the form to create a new project
     */
    public function uploadFileAction()
    {
		if ($this->request->isPost()) {
			if ($this->request->hasFiles() == true) {
				foreach ($this->request->getUploadedFiles() as $file) 
				{//There should only be 1 file 

					//echo "Saving a file  " . $file->getName();
					$inputFile = $file->getTempName();
					$inputFileType = PHPExcel_IOFactory::identify($inputFile);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel21 = $objReader->load($inputFile);

					//Final check if file is a valid project file
					$siteInfo = $objPHPExcel21->getSheetByName("sites");
					
					if($siteInfo)
					{
						$row = $siteInfo->getRowIterator(1)->current();
						//Map the Valid Colums to the database
						//Check if value is in the allowed header
						//Map column to database column
						
						
						
						echo '<table border="1">';
						//foreach ($siteInfo->getRowIterator() as $row) {
							$cellIterator = $row->getCellIterator();
							$cellIterator->setIterateOnlyExistingCells(false);
							echo '<tr>';
							foreach ($cellIterator as $cell) {
								if (!is_null($cell)) {
									$value = $cell->getCalculatedValue();
									echo '<td>';
									echo $value . '&nbsp;';
									echo '</td>';
								}
							}
							echo '</tr>';
						//}
						echo '</table>';
						echo '<br> Highest column : ' . $siteInfo->getHighestColumn() . '</br>';
					
					}else
					{
						echo '<br>Not a vaild Project Excel Sheet must have "sites" sheet which is case sensitive</br>';
					}
					  
				
				}
				echo "<br>Finished with no errors<br>";
				return;
			}
			else 
			{
				
				if ((! empty ($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0) ||
					(empty ($_POST) && empty ($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0)) {
					$this->flash->error('Uploaded file exceeds the maximum upload size allowed {0}');
				}
				else {
					$this->flash->error('No files uploaded');
				}
			}
	   }	


    } 
  
    public function downloadAction()
    {
    	
		$projects = Project::query()->columns(['id','name','projectcode'])
		                            ->limit(20)->execute();
		
		$this->view->myprojects = $projects; 
	}
	
    public function downloadProjectAction($pid)
    {
		$this->view->disable();
		//1. Check that the pid is valid if not valid redirect to downloadAction
		//2. If pid is valid check that there are sitebosses for this project
		//   if not send flash message and redirect to downloadAction
		//3. If there are sitebosses yay create an xlsx file.
		
		if($pid and is_numeric($pid)) 
		{
			$project = Project::findFirstById($pid);
			if (!$project) 
			{
				$this->flash->notice("The search did not find any projects!");
				return $this->response->redirect('project/download');
			}else
			{
				//Get all the sitebosses for this project
				$Sites = Siteboss::query()->andwhere('project_id = :pid:')
										  ->bind(['pid' => $pid])
										  ->execute();

				if (count($Sites) == 0) {
					$this->flash->notice("The search did not find any sites for this project");
						return;
				}
			}
			
		}else
		{
			$this->flash->notice("Please select a project");
			return $this->response->redirect('project/download');
		}


		//We got here everything is good so start creating the file
		
		$objPHPExcel = new PHPExcel();

		// Set document properties creates first sheet
		$objPHPExcel->getProperties()->setCreator("Asentria AIRT")
									 ->setLastModifiedBy("Asentria AIRT")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Siteboss for an AIRT project")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("AIRT Project");

		$objPHPExcel->createSheet(); //Creates second sheet
		//Get the keys/columns for the database
		$sbArray = array_keys($Sites[0]->toArray());
        //We don't want to write the project_id to the xlsx file which is the second
        //column in the database so we do this funky shit and unshift with the array 
		$uid = array_shift($sbArray);
		array_shift($sbArray);
		array_unshift($sbArray, $uid);


		foreach($sbArray as $i=>$value)
		{
			$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i,1,$value);
		}
		
		//Populate each row starting with row 2
		foreach($Sites as $sbi=>$sbv)
		{
			$row = $sbi + 2;
			foreach( $sbArray as $i=>$value)
			{
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i,$row,$sbv->$value);
			}
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('sites');
		
		
		$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue('A1', 'Before wiring - ATS connections')
					->setCellValue('A2', 'Before wiring - Alarm block connections')
					->setCellValue('A3', 'Before wiring - Generator controller connections')
					->setCellValue('A4', 'Before Wiring - Fuel gauge connections')
					->setCellValue('A5', 'Front of SiteBoss')
					->setCellValue('A6', 'Back of SiteBoss after wired');
		$objPHPExcel->getActiveSheet()->setTitle('photos');
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $project->name . '.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

	}
	
	private function _processXLSX($file, Project $project)
    {
		
		$inputFile = $file->getTempName();	
		if(!$inputFile)
		{//Check if there was a file sent
			$message = 'An XLSL file is needed to create this project';
			$this->flash->error($message);
			return $this->dispatcher->forward(
			[
				"controller" => "project",
				"action"     => "uploadsheet",
			]);
		}	
				
		$inputFileType = PHPExcel_IOFactory::identify($inputFile);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel21 = $objReader->load($inputFile);
		$siteInfo = $objPHPExcel21->getSheetByName("sites"); 
		//Final check if the spreadsheet has a sheet with "sites" as a title
		//lets create a project and add the sitebosses
		if($siteInfo)
		{
                    //We have a project now lets attached the new siteboss to this
					$siteboss = new Siteboss();
					//Get the keys/colums for the database
					$sbArray = array_keys($siteboss->toArray());
					$validKeyArray = array(); //Use this as a holder for valid keys
					//Get the header if its a valid field map it value = valid or invalid
					$header = $siteInfo->getRowIterator(1)->current();
					$cellIterator = $header->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(true); //Goes to column max if false gets null values if true;
					$rowSaved = 0;
					foreach ($cellIterator as $key=>$cell) {
						if (!is_null($cell)) {
							$value = $cell->getCalculatedValue();
							if(in_array($value, $sbArray))
							{
								$validKeyArray[$key] = $value;
							}else
							{
								$validKeyArray[$key] = 'invalid';
							}								
						}
					}
					
					//The second row should contain data that pretains to the siteboss table in the db
					$rowIterator = $siteInfo->getRowIterator(2);
					
					foreach($rowIterator as $row)
					{ //for each row save it to the database
						$rowcellIter = $row->getCellIterator();
						$rowcellIter->setIterateOnlyExistingCells(true);
						$modArray = new ArrayObject();//array();
						foreach($rowcellIter as $in=>$va)
						{//We add this to the database
							if($validKeyArray[$in] !== 'invalid')
							{
								$modArray[$validKeyArray[$in]] = $va;
							}
						}
						
						//Set the project id and project code to the project we just created.
						//In the future we might have to check the value of id and project code.
						$modArray['project_id'] = $project->id;
						$modArray['ProjectCode'] = $project->projectcode;
						
						//PDO might be faster but for now just loop to the columns and save the siteboss info
						$siteboss = new Siteboss();
						$siteboss->setWithArray($modArray->getArrayCopy());
						try
						{
							//$copy = $modArray->getArrayCopy();
							if($siteboss->save() == true)
							{
								$rowSaved++;
								//echo '<br>A siteboss was saved</br>';
							}
							
						} catch (Exception $e){
								echo '<br>' . $e->getMessage() . '<br>';
								//echo '<pre>' . $e->getTraceAsString() . '</pre>';
						}
																
					}
					//Success
					$total = $siteInfo->getHighestRow() - 1;
					$message = 'Successful save ' . $rowSaved 
					. ' out of ' . $total . ' row/s in the file to Project: ' 
					. $project->name;
					$this->flash->success($message);
					return $this->dispatcher->forward(
						[
							"controller" => "project",
							"action"     => "index",
						]
					);
													
		}else
		{
			$message = 'The XLSL file is not a valid.  File needs to have a sheet name "sites" (case-sensitive)';
			$this->flash->error($message);
			return $this->dispatcher->forward(
					[
						"controller" => "project",
						"action"     => "uploadsheet",
					]
				);	
		}
		
	}
}
