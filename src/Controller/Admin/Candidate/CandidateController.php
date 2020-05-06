<?php

namespace App\Controller\Admin\Candidate;

use App\Entity\Birthplace;
use App\Entity\Candidate;
use App\Entity\LegalizationDocument;
use App\Forms\Candidate\CandidateType;
use App\Repository\CandidateRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class CandidateController extends AbstractController
{
    /**
     * @Route("/candidates", name="app_admin_candidates")
     */
    public function getCandidates(CandidateRepository $candidateRepository, Request $request,  PaginatorInterface $paginator)
    {
        $q = $request->query->get('q');
        $queryBuilder = $candidateRepository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/candidate/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/candidate", name="app_create_candidate")
     */
    public function createCandidate(EntityManagerInterface $entityManager, CountryRepository $countryRepository): Response
    {
        $candidate = new Candidate();
        $candidate->setFirstname("Jon");
        $candidate->setLastname("Cena");
        $candidate->setEmail("jon.cena@gmail.com");
        $candidate->setDateOfBirth(new \DateTime("now"));
        $candidate->setGender('MALE');

        $candidate->setAboutCandidate("OK");
        $candidate->setPhoneNumber("+8556585665");

        $birthplace = new Birthplace();
        $birthplace->setCity("Florida");

        $country = $countryRepository->findOneBy(['id' => 2]);

        $birthplace->setCountry($country);

        $candidate->setBirthplace($birthplace);

        $candidate->setProfession("Fighter");
        $candidate->setLastUpdate(new \DateTime('now'));

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($candidate);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new candidate with id ' . $candidate->getId());
    }

    /**
     * @Route("/candidate/{id}/edit", methods="POST|GET", name="app_admin_candidate_edit")
     */
    public function editCandidate(
        $id,
        CandidateRepository $candidateRepository,
        ValidatorInterface $validator,
        Request $request,
        TranslatorInterface $translator
    ) {
        $candidate = $candidateRepository->findOneBy(['id' => $id]);

        $form = $this->createForm(CandidateType::class, $candidate);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash(
                    'success',
                    $translator->trans('Your changes were saved!')
                );

                return $this->render(
                    'admin/candidate/edit.html.twig',
                    [
                        'form' => $form->createView(),
                        'success_message' => 'Updated',
                    ]
                );
            }
        }

        return $this->render(
            'admin/candidate/edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/candidate/{id}/show", methods="GET", name="app_admin_candidate_show")
     */
    public function showCandidate($id, CandidateRepository $candidateRepository, TranslatorInterface $translator)
    {
        $candidate = $candidateRepository->findOneBy(['id' => $id]);

        return $this->render(
            'admin/candidate/show.html.twig',
            [
                'candidate' => $candidate,
            ]
        );
    }

    /**
     * @Route("/legalization_document", name="app_create_legalization_document")
     */
    public function createLegalizationDocument(EntityManagerInterface $entityManager): Response
    {
        $legalizationDocument = new LegalizationDocument();

        $repository = $this->getDoctrine()->getRepository(Candidate::class);

        $candidate = $repository->find(9);

        $legalizationDocument->setCandidate($candidate);
        $legalizationDocument->setDateFrom(new \DateTime('now'));
        $legalizationDocument->setDateTo(new \DateTime('now'));
        $legalizationDocument->setDocumentType(['WIZA']);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($legalizationDocument);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new lagalization document for candidat ' . $candidate->getFirstname());
    }
}