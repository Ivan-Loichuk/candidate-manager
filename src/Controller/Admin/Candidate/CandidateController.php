<?php

namespace App\Controller\Admin\Candidate;

use App\Entity\Birthplace;
use App\Entity\Candidate;
use App\Entity\Country;
use App\Entity\LegalizationDocument;
use App\Forms\Candidate\CandidateType;
use App\Repository\CandidateRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function admin(CandidateRepository $candidateRepository)
    {
        $candidates = $candidateRepository->findAll();

        return $this->render('admin/candidate/index.html.twig',['candidates' => $candidates]);
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

        $candidate->setJobSummary("OK");
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

        return new Response('Saved new candidate with id '.$candidate->getId());
    }

    /**
     * @Route("/candidate/{id}/edit", methods="POST|GET", name="app_admin_candidate_edit")
     */
    public function editCandidate($id, CandidateRepository $candidateRepository)
    {
        $candidate = $candidateRepository->findOneBy(['id' => $id]);

        $form = $this->createForm(CandidateType::class, $candidate);

        return $this->render('admin/candidate/edit.html.twig',[
            'form' => $form->createView(),
        ]);
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

        return new Response('Saved new lagalization document for candidat '.$candidate->getFirstname());
    }
}