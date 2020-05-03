<?php


namespace App\Controller\Admin\Application;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApplicationController
 * @package App\Controller\Admin\Application
 * @Route("/admin")
 */
class ApplicationController extends AbstractController
{
    /**
     * @Route("/applications", name="app_admin_applications")
     */
    public function applications()
    {
        return $this->render('admin/application/index.html.twig');
    }

}