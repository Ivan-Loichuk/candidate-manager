<?php


namespace App\Controller\Admin\Company;


use App\Form\Company\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class CompanyController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class CompanyController extends AbstractController
{
    private $entityManager;
    private $translator;

    function __construct(EntityManagerInterface $entityManager, TranslatorInterface $translator)
    {
        $this->entityManager = $entityManager;
        $this->translator = $translator;
    }

    /**
     * @Route("/companies", name="app_admin_companies")
     */
    public function getCompanies(Request $request, CompanyRepository $companyRepository, PaginatorInterface $paginator)
    {
        $q = $request->query->get('q');
        $queryBuilder = $companyRepository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/company/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/company/add-form", methods="GET|POST", name="app_admin_company_add_form")
     */
    public function addCompanyForm(Request $request)
    {
        $form = $this->createForm(CompanyType::class, null, [
            'action' => $this->generateUrl('app_admin_company_add_form'),
        ]);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {
                $company = $form->getData();
                $this->entityManager->persist($company);
                $this->entityManager->flush();

                $this->addFlash(
                    'success',
                    $this->translator->trans('Firma została dodana')
                );

                return $this->redirectToRoute('app_admin_companies');
            }
        }

        return $this->render('admin/company/_partial/form/add-company.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/company/{id}/edit-form", methods="GET|POST", name="app_admin_company_edit_form")
     */
    public function editCompanyForm($id, Request $request, CompanyRepository $companyRepository)
    {
        $company = $companyRepository->findOneBy(['id' => $id]);

        $form = $this->createForm(CompanyType::class, $company, [
            'action' => $this->generateUrl('app_admin_company_edit_form', [
                'id' => $id,
            ]),
        ]);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {
                $company = $form->getData();
                $this->entityManager->persist($company);
                $this->entityManager->flush();

                $this->addFlash(
                    'success',
                    $this->translator->trans('Zmiany zostały zapisane')
                );

                return $this->redirectToRoute('app_admin_companies');
            }
        }

        return $this->render('admin/company/_partial/form/edit-company.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/company/{id}/delete", methods="POST", name="app_admin_company_delete")
     */
    public function deleteCompany($id, CompanyRepository $companyRepository)
    {
        $hasEmployees = $companyRepository->hasEmployees($id);

        if ($hasEmployees) {
            $this->addFlash(
                'danger',
                $this->translator->trans('Nie można usunąć firmy która ma przypisanych pracowników')
            );
            return $this->redirectToRoute('app_admin_companies');
        }

        $company = $companyRepository->findOneBy(['id' => $id]);

        $this->entityManager->remove($company);
        $this->entityManager->flush();

        $this->addFlash(
            'success',
            $this->translator->trans('Dane firmy zostały usunięte')
        );
        return $this->redirectToRoute('app_admin_companies');
    }
}