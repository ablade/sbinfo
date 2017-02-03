<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('Asentria Reporter');
        $this->view->setTemplateAfter('main');
    }
}
