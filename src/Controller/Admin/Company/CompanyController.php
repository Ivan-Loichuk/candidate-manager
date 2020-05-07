<?php


namespace App\Controller\Admin\Company;


use App\Repository\CompanyRepository;
use App\Repository\CountryRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class CompanyController extends AbstractController
{

    /**
     * @Route("/companies", name="app_admin_companies")
     */
    public function getCandidates(CompanyRepository $companyRepository)
    {
        $companies = $companyRepository->findAll();

        return $this->render('admin/company/index.html.twig', [
            'companies' => $companies,
        ]);
    }
}