<?php


namespace App\Controller\Admin\Employee;


use App\Form\Employee\GeneralEmployeeType;
use App\Form\Employee\JobDocumentsType;
use App\Form\Employee\LegalizationEmployeeType;
use App\Form\Employee\SimpleEmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class EmployeeController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class EmployeeController extends AbstractController
{
    private $entityManager;
    private $translator;

    function __construct(EntityManagerInterface $entityManager, TranslatorInterface $translator)
    {
        $this->entityManager = $entityManager;
        $this->translator = $translator;
    }

    /**
     * @Route("/employees", name="app_admin_employees")
     * @param EmployeeRepository $employeeRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getEmployees(EmployeeRepository $employeeRepository, Request $request,  PaginatorInterface $paginator)
    {
        $q = $request->query->get('q');
        $queryBuilder = $employeeRepository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );

        $form = $this->createForm(SimpleEmployeeType::class);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {
                $employee = $form->getData();
                $this->entityManager->persist($employee);
                $this->entityManager->flush();

                $this->addFlash(
                    'success',
                    $this->translator->trans('Nowy pracownik został dodany')
                );

                return $this->redirectToRoute('app_employee_edit', [
                    'id' => $employee->getId(),
                ]);
            }
        }

        return $this->render('admin/employee/index.html.twig', [
            'pagination' => $pagination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/employee/{id}/edit", name="app_employee_edit")
     * @param $id
     * @param EmployeeRepository $employeeRepository
     * @param Request $request
     * @return Response
     */
    public function createEmployee($id, EmployeeRepository $employeeRepository, Request $request): Response
    {
        $employee = $employeeRepository->findOneBy(['id' => $id]);

        $generalForm = $this->createForm(GeneralEmployeeType::class, $employee);
        $legalizationForm = $this->createForm(LegalizationEmployeeType::class, $employee);
        $jobDocumentsForm = $this->createForm(JobDocumentsType::class, $employee);

        if ($request->isMethod('POST')) {
            $generalForm->handleRequest($request);
            $this->saveIfFormSubmitted($generalForm);

            $legalizationForm->handleRequest($request);
            $this->saveIfFormSubmitted($legalizationForm);

            $jobDocumentsForm->handleRequest($request);
            $this->saveIfFormSubmitted($jobDocumentsForm);
        }

        return $this->render(
            'admin/employee/edit.html.twig',
            [
                'generalForm' => $generalForm->createView(),
                'legalizationForm' => $legalizationForm->createView(),
                'jobDocumentsForm' => $jobDocumentsForm->createView(),
            ]
        );
    }

    /**
     * @param $form
     */
    private function saveIfFormSubmitted($form): void
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();
            $this->entityManager->persist($employee);
            $this->addFlash(
                'success',
                $this->translator->trans('Dane zostały zapisane!')
            );
            $this->entityManager->flush();
        }
    }


    /**
     * @Route("/employee/{id}/show", methods="GET", name="app_admin_employee_show")
     * @param $id
     * @param EmployeeRepository $employeeRepository
     * @return Response
     */
    public function showCandidate($id, EmployeeRepository $employeeRepository)
    {
        $employee = $employeeRepository->findOneBy(['id' => $id]);

        return $this->render(
            'admin/employee/show.html.twig',
            [
                'employee' => $employee,
            ]
        );
    }
}