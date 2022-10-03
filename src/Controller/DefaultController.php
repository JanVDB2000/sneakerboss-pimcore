<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FrontendController
{
    private mixed $view;


    /**
     * @param Request $request
     * @return Response
     */
    public function defaultAction(Request $request): Response
    {


        return $this->render('default/default.html.twig');
    }

    public function WestrijdForm(Request $request): Response
    {



        return $this->render('default/wedstrijd-form.html.twig',[

        ]);
    }

    /**
     * @throws \Exception
     */
    public function WestrijdList(Request $request): Response
    {

        $wedstrijdforms = DataObject\WedstrijdForm::getList();

        return $this->render('default/wedstrijd-list.html.twig', [
            'wedstrijdforms'=> $wedstrijdforms,
        ]);
    }

}
