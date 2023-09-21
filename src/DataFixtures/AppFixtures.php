<?php

namespace App\DataFixtures;

use App\Entity\ShoppingItem;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadShoppingItems($manager);
        // $product = new Product();
        // $manager->persist($product);

    }
    public function loadUsers(ObjectManager $manager) : void
    {
        //$data = ["Kous@gmail.dev","wewe@gmail.dev"];
        //foreach ($data as  $email)
        //{
        //   $admin = new User();
        //   $admin->setEmail($email);
        //   $admin->setPassword($this->hasher->hashPassword($admin,"password"));
        //   $admin->setRoles((['ROLE_ADMIN']));
        //   $manager->persist($admin);

        // }
        $manager->flush();
    }
    private function loadShoppingItems(ObjectManager $manager) : void
    {
        //$data = ["Lait","Chips","Desperados","Bonbons","Coca"];

        //foreach ($data as $arr)
        //{
        //$shoppingitem = new ShoppingItem();
        //$shoppingitem->setLabel($arr);
        //$shoppingitem->setIsCheck(false);
        //$manager->persist($shoppingitem);

        //}
        $manager->flush();
    }
}
