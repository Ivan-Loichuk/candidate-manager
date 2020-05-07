<?php


namespace App\Controller\Admin\Vehicle;


use App\Repository\VehicleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VehicleController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class VehicleController extends AbstractController
{

    /**
     * @Route("/vehicles", name="app_admin_vehicles")
     */
    public function getCandidates(VehicleRepository $vehicleRepository)
    {
        $vehicles = $vehicleRepository->findAll();

        return $this->render('admin/vehicle/index.html.twig', [
            'vehicles' => $vehicles,
        ]);
    }
}