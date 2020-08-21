<?php

namespace App\Controller;

use App\Entity\Example;
use App\Form\ExampleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{
    /**
     * @Route("/example", name="example")
     */
    public function index(Request $request)
    {
        $entity = new Example();
        //$entity->setDatetime(new \DateTime());
        $entity->setName('koen');

        $form = $this->createForm(ExampleType::class, $entity);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if(!$form->isValid()) {
                var_dump($form->getErrors());
                //exit;
            }

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();

            $file->move('../var/log', md5($file->getClientOriginalName()) . '.' . $file->guessClientExtension());

            die('File is uploaded');
        }

        return $this->render('example/index.html.twig', [
            'controller_name' => 'ExampleController',
            'formExample' => $form->createView()
        ]);
    }
}
