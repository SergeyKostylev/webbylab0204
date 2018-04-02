<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;
use Model\Form\FeedbackForm;
use Model\Entity\Feedback;


class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('index.html.twig');

    }

}