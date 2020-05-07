<?php


namespace App\Controller\Admin\Employee;


use App\Entity\Employee;
use App\Form\Employee\EmployeeType;
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
    /**
     * @Route("/employees", name="app_admin_employees")
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

        return $this->render('admin/employee/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/employee/add", name="app_create_employee")
     */
    public function createEmployee(EntityManagerInterface $entityManager, Request $request, TranslatorInterface $translator): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {
                $employee = $form->getData();
                $this->getDoctrine()->getManager()->persist($employee);
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash(
                    'success',
                    $translator->trans('Your changes were saved!')
                );
            }
        }

        return $this->render(
            'admin/employee/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route("/employee/{id}/show", methods="GET", name="app_admin_employee_show")
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