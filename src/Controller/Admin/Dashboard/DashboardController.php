<?php

namespace App\Controller\Admin\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 * @Route("/admin", name="app_admin_")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function admin()
    {
        return $this->render('admin/dashboard/index.html.twig');
    }
}