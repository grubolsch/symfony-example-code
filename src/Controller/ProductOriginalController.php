<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductOriginalController extends AbstractController
{
    /**
     * @Route("/products", name="productdefault")
     */
    public function default()
    {
        return $this->render('productOriginal/index.html.twig', [
            'controller_name' => 'ProductController',
            'productname' => 'No product'
        ]);
    }

    /**
     * @Route("/products/new/{categoryName}", name="product_new_orig")
     */
    public function create(string $categoryName)
    {
        //$category = $this->getDoctrine()->getRepository(Category::class)->find(1);
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy([
            'name' => $categoryName
        ]);

        $product = new Product('Chicken', 5, 100);
        $product->setCategory($category);

        $this->getDoctrine()->getManager()->persist($product);//git add
        $this->getDoctrine()->getManager()->flush();//git push

        die('product is created');
    }

    /**
     * @Route("/products/update/{product}", name="product_update_orig")
     */
    public function update(Request $request, Product $product)
    {
        //$product->setPrice($request->request->get('price'));
        $product->setPrice(50);

        $this->getDoctrine()->getManager()->flush();//git push

        die($product->getPrice());
    }

    /**
     * @Route("/products/delete/{product}", name="product_delete_orig")
     */
    public function delete(Product $product)
    {
        $this->getDoctrine()->getManager()->remove($product);
        $this->getDoctrine()->getManager()->flush();//git push

        $this->addFlash('success', 'Product is deleted');
        return $this->redirectToRoute('category');
    }

    /**
     * @Route("/products/{product}", name="product_detail_orig")
     */
    public function detail(Request $request, Product $product)
    {
        return $this->render('productOriginal/detail.html.twig', [
            'product' => $product,
        ]);
    }
}
