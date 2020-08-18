<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryOriginalController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        /* create new categories
        $categoryA = new Category('Food');
        $categoryB = new Category('Drinks');

        $this->getDoctrine()->getManager()->persist($categoryA);
        $this->getDoctrine()->getManager()->persist($categoryB);
        $this->getDoctrine()->getManager()->flush();
        */

        return $this->render('categoryOriginal/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
