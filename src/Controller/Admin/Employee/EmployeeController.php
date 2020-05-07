<?php


namespace App\Controller\Admin\Employee;


use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/employee", name="app_create_employee")
     */
    public function createEmployee(EntityManagerInterface $entityManager): Response
    {
        $employee = new Employee();

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($employee);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new employee with id ' . $employee->getId());
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
                'candidate' => $employee,
            ]
        );
    }
}