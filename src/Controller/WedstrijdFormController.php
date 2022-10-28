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


class WedstrijdFormController extends FrontendController
{
    private mixed $view;




    public function generateRandomString($length): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function SlugChecker($slugURL, $slugObject): bool
    {
        /*foreach($slugObject as $check){*/
            if ($slugObject->getUrl_confirmation() == $slugURL){
            return true;
        }

      /*  }*/
        return false;
    }


    /**
     * @param Request $request
     * @return Response
     * @throws TransportExceptionInterface
     * @throws \Exception
     */

    public function WestrijdForm(Request $request,MailerInterface $mailer): Response
    {
        // creates a task object and initializes some data for this example

        // user wedstrijd info




        $form = $this->createFormBuilder()
            ->add('Afbeelding', FileType::class, ['attr' => ['class' => 'form-control']])
            ->add('Voornaam', TextType::class , ['attr' => ['class' => 'form-control']])
            ->add('Achternaam', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('Geboortedatum',DateType::class,['years' => range(1920, date('Y')),'attr' => ['class' => 'form-control']])
            ->add('Email', TextType::class,  ['attr' => ['class' => 'form-control']])
            ->add('Klantnummer', TextType::class, ['required' => false,'label' => 'Klantnummer Optioneel CN 00-000-00','attr' => ['class' => 'form-control'],])
            ->add('Merk', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('Schoenmaat', TextType::class, ['attr' => ['class' => 'form-control'],'required' => true,])
            ->add('save', SubmitType::class, ['label' => 'Submit Formulier', 'attr' => ['class' => 'btn btn-primary mt-3'],])
            ->getForm();



        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $registration = $form->getData();


            $newAsset = new Asset\Image();

            $newAsset->setParentId(2);

            $newAsset->setData($form->get('Afbeelding')->getData()->getContent());

            $newAsset->setFilename($form->get('Afbeelding')->getData()->getClientOriginalName());
            $newAsset->save();

            $registration['Afbeelding'] = $newAsset;
            $registration['Geboortedatum'] = Carbon::parse($registration['Geboortedatum']);

           $registrationPimcore = DataObject\WedstrijdForm::create($registration)->setParentId(2)->setKey('form'.$registration['Email'])->save();


            $linkregistration = new DataObject\WedstrijdRegistration();

           $linkregistration
               ->setUrl_confirmation($this->generateRandomString(25))
               ->setParentId(62)
               ->setKey('url_code : '.$linkregistration->getUrl_confirmation())
               ->setPublished(true)
               ->setWedstrijdFormLink($registrationPimcore)
               ->save();

           //send mail + link voor bevestingen
            $email = (new Email())
                ->from('wedstrijd@sneakerboss.com')
                ->to($registrationPimcore->getEmail())
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
    public function WestrijdFormCheck(Request $request , string $slug ,MailerInterface $mailer)
    {
        // creates a task object and initializes some data for this example


        $Slugcheck = DataObject\WedstrijdRegistration::getByUrl_confirmation($slug,1);

        if ($Slugcheck == null){
            return $this->redirect('/');
        }

        if ($this->SlugChecker($slug, $Slugcheck)){

            // user wedstrijd info
            $form = $this->createFormBuilder($Slugcheck)
                ->add('save', SubmitType::class, ['label' => 'Bevestige Webstrijd Deelnamen', 'attr' => ['class' => 'btn btn-primary mt-3'],])
                ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {


                \Pimcore\Model\DataObject::setHideUnpublished(false);
                $Slugcheck->getWedstrijdFormLink()->setPublished(true)->save();
                \Pimcore\Model\DataObject::setHideUnpublished(true);

                $date = date("F j, Y, g:i a");

                $email = (new Email())
                    ->from('wedstrijd@sneakerboss.com')
                    ->to('admin@sneakerboss.com')
                    ->subject('Nieuwe deelnamen Wedstrijd')
                    ->text('Bekijk de  inschrijving')
                    ->html(' <p>Bekijk :</p><a href="http://127.0.0.1/wedstrijd-lijst">Nieuwe deelnamen</a>');
                $mailer->send($email);

                $Slugcheck->setKey('Gebruikt op '. $date)->setPublished(false)->save();

                return $this->redirect('/');
            }

            return $this->render('default/wedstrijd-form-bevestig.html.twig',[
                'form' => $form->createView(),
            ]);

        }

        return $this->redirect('/');

    }

}
