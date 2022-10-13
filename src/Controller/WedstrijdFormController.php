<?php

namespace App\Controller;


use Pimcore\Controller\FrontendController;
use Pimcore\Mail;
use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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


class WedstrijdFormController extends FrontendController
{
    private mixed $view;




    public function generateRandomString($length = 25): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function SlugChecker($slugURL, $slugObject){
        foreach($slugObject as $check){
            if ($check->getUrl_confirmation() == $slugURL){
                return true;
            }
        }
    }





    /**
     * @param Request $request
     * @return Response
     * @throws TransportExceptionInterface
     */

    public function WestrijdForm(Request $request,MailerInterface $mailer): Response
    {
        // creates a task object and initializes some data for this example
        $wedstrijdform = new DataObject\WedstrijdForm();
        // user wedstrijd info
        $form = $this->createFormBuilder($wedstrijdform)
/*            ->add('Afbeelding', FileType::class, ['attr' => ['class' => 'form-control']])*/
            ->add('Voornaam', TextType::class , ['attr' => ['class' => 'form-control']])
            ->add('Achternaam', TextType::class, ['attr' => ['class' => 'form-control']])
            /*->add('Geboortedatum', dateType::class, [  'widget' => 'choice','input'  => 'datetime_immutable'])*/
            ->add('Email', TextType::class,  ['attr' => ['class' => 'form-control']])
            ->add('Klantnummer', TextType::class, [  'label' => 'Klantnummer Optioneel CN 00-000-00','attr' => ['class' => 'form-control'],])
            ->add('Merk', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('Schoenmaat', TextType::class, ['attr' => ['class' => 'form-control'],'required' => true,])
            ->add('save', SubmitType::class, ['label' => 'Submit Formulier', 'attr' => ['class' => 'btn btn-primary mt-3'],])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $linkregistration = new DataObject\WedstrijdRegistration();

            $registration = $form->getData();

/*            Asset::create(2)->setData($registration->getAfbeelding())->save();*/


            $registration->setParentId(2)->setKey('form'.$registration->getEmail())->save();

           $linkregistration
               ->setUrl_confirmation($this->generateRandomString())
               ->setParentId(62)
               ->setKey($linkregistration->getUrl_confirmation())
               ->setPublished(true)
               ->setWedstrijdFormLink($registration)
               ->save();

            $email = (new Email())
                ->from('hello@example.com')
                ->to('you@example.com')
                ->subject('Time for Wedstrijd')
                ->text('Sending emails is fun again!')
                ->html('<a href="http://127.0.0.1/check-mail-form/'. $linkregistration->getUrl_confirmation().'">Click voor wedstrijd bevestingen</a>');

            $mailer->send($email);

            return $this->redirect('/');
        }

        return $this->render('default/wedstrijd-form.html.twig',[
            'form' => $form->createView(),
        ]);

    }

    /**
     * @throws \Exception
     */
    #[Route('/check-mail-form/{slug}', name: 'WestrijdFormCheck')]
    public function WestrijdFormCheck(Request $request , string $slug )
    {
        // creates a task object and initializes some data for this example
        $Slugcheck = DataObject\WedstrijdRegistration::getList();

        if ($this->SlugChecker($slug, $Slugcheck)){

            $wedstrijdFormCheck = new DataObject\WedstrijdRegistration();

            // user wedstrijd info
            $form = $this->createFormBuilder($wedstrijdFormCheck)
                ->add('save', SubmitType::class, ['label' => 'Submit Formulier', 'attr' => ['class' => 'btn btn-primary mt-3'],])
                ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $registration = $form->getData();

                DataObject\WedstrijdForm::getByWedstrijdRegistrationLink($registration)->setPublished(true)->save();


                return $this->redirectToRoute('/');
            }

            return $this->render('default/wedstrijd-form-bevestig.html.twig',[
                'form' => $form->createView(),
            ]);

        }

        return $this->redirect('/');

    }

}
