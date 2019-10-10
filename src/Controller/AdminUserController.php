<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\PaginationService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users/{page<\d+>?1}", name="admin_users_index")
     */
    public function index(UserRepository $repo, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(User::class)
            ->setPage($page)
            ->setLimit(6);

        return $this->render('admin/user/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
}