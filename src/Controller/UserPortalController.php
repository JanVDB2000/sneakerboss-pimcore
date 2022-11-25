<?php

namespace App\Controller;


use Carbon\Carbon;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


class UserPortalController extends FrontendController
{

    /**
     * @param Request $request
     * @return Response
     * @throws TransportExceptionInterface
     * @throws \Exception
     */



    public function LoginPortal(Request $request): Response
    {



        return $this->render('default/user-portal.html.twig');
    }

}
