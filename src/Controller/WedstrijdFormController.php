<?php

namespace App\Controller;


use Pimcore\Controller\FrontendController;
use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class WedstrijdFormController extends FrontendController
{
    private mixed $view;


    /**
     * @param Request $request
     * @return Response
     */
    public function WestrijdForm(Request $request): Response
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

            $registration = $form->getData();

/*            Asset::create(2)->setData($registration->getAfbeelding())->save();*/

            $registration->setParentId(2)->setKey($registration->getEmail())->setPublished(true)->save();



            return $this->redirectToRoute('WestrijdList');
        }

        return $this->render('default/wedstrijd-form.html.twig',[
            'form' => $form->createView(),
        ]);

    }

    public function WestrijdFormCheck(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $wedstrijdFormCheck = new DataObject\WedstrijdRegistration();

        // user wedstrijd info
        $form = $this->createFormBuilder($wedstrijdFormCheck)
            ->add('save', SubmitType::class, ['label' => 'Submit Formulier', 'attr' => ['class' => 'btn btn-primary mt-3'],])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $registration = $form->getData();

            /*            Asset::create(2)->setData($registration->getAfbeelding())->save();*/

            $registration->setParentId(2)->setKey($registration->getEmail())->setPublished(true)->save();



            return $this->redirectToRoute('WestrijdList');
        }

        return $this->render('default/wedstrijd-form-bevestig.html.twig',[
            'form' => $form->createView(),
        ]);

    }

}
