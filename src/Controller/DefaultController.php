<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    public function WestrijdFormPimCore(Request $request): Response
    {



        return $this->render('default/wedstrijd-form-pimcore.html.twig',[

        ]);
    }



    /**
     * @throws \Exception
     */
    #[Route('/wedstrijd-list', name: 'WestrijdList')]
    public function WestrijdList(Request $request): Response
    {

        $wedstrijdforms = DataObject\WedstrijdForm::getList();

        return $this->render('default/wedstrijd-list.html.twig', [
            'wedstrijdforms'=> $wedstrijdforms,
        ]);
    }


    #[Route('/wedstrijd-mail-check', name: 'WestrijdMailCheck')]
    public function WestrijdMailCheck(Request $request): Response
    {



        return $this->render('default/wedstrijd-form-bevestig.html.twig');
    }

}
