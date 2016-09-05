<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{
    /**
     * List of products in specific category
     *
     * @Route("/{alias}", name="category")
     * @Template()
     */
    public function indexAction($alias)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->findOneBy([
            'alias' => $alias
        ]);

        if (!$category) {
            $this->createNotFoundException('Category not found');
        }

        $products = $em->getRepository('AppBundle:Product')->findBy([
            'category' => $category
        ]);

        return [
            'products' => $products,
            'category' => $category
        ];
    }

}
