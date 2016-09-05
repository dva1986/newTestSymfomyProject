<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;

class LoadUserData implements FixtureInterface
{
    private $categories = [
        ['name' => 'Mobiles', 'alias' => 'mobile'],
        ['name' => 'Notebooks', 'alias' => 'notebook'],
        ['name' => 'Sports', 'alias' => 'sport']
    ];

    private $products = [
        ['category' => 'mobile', 'name' => 'Xiaomi Redmi Note 3 Pro 32GB', 'description' => 'About Xiaomi', 'price' => 6000.00],
        ['category' => 'mobile', 'name' => 'Lenovo Vibe Z2 Pro (K920)', 'description' => 'About Lenovo', 'price' => 7999],
        ['category' => 'notebook', 'name' => 'Lenovo G50', 'description' => 'About Lenovo G50', 'price' => 9000],
        ['category' => 'sport', 'name' => 'Totem Marsstar 26" bicycle', 'description' => 'About Totem', 'price' => 21000],
        ['category' => 'sport', 'name' => 'Pride XC-650 Pro 1.0 (2016) 21" bicycle', 'description' => 'About Pride', 'price' => 34000],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->categories as $item) {
            $category = new Category();
            $category
                ->setAlias($item['alias'])
                ->setName($item['name'])
            ;
            $manager->persist($category);
        }

        $manager->flush();

        foreach ($this->products as $item) {
            $category = $manager->getRepository('AppBundle:Category')->findOneBy(['alias' => $item['category']]);
            $product = new Product();
            $product
                ->setCategory($category)
                ->setName($item['name'])
                ->setDescription($item['description'])
                ->setPrice($item['price'])
            ;
            $manager->persist($product);
        }

        $manager->flush();
    }
}