<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Companies;
use AppBundle\Form\CompaniesType;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class CompaniesController extends Controller {
    /**
     * @Route("/companies", name="companies_list")
     * @Method({"GET"})
     * @ApiDoc(
     *    description="Récuperer l'ensemble des companies",
     *    resource="Companies",
     *
     *    output= {
     *      "class"=Companies::class, "collection"=true, "groups"={"companies"}
     *    }
     * )
     */
    ///////////////////////////// RÉCUPÈRE L'ENSEMBLE DES COMPANIES //////////////////////////// OK
    public function getCompaniesAction(Request $request)
        {
            $companies = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Companies')
                ->findAll();
            /* @var $companies Companies[] */

            $formatted = [];
            foreach ($companies as $company) {
                $formatted[] = [
                    'id' => $company->getId(),
                    'name' => $company->getName(),
                    'address' => $company->getAddress(),
                    'city' => $company->getCity(),
                    'country' => $company->getCountry(),
                    'postcode' => $company->getPostcode(),

                ];
            }

            return new JsonResponse($formatted);

        }
        /////// FIN ///////
        /////// RECUPERER UNE SEUL ET UNIQUE COMPANY A LA FOIS ////// OK
        /**
         * @Rest\View()
         * @Rest\Get("/companies/{id}")
         * @ApiDoc(
         *    description="Récuperer une company spécifique",
         *    resource="Companies",
         *
         *    output= {
         *      "class"=Companies::class, "collection"=true, "groups"={"companies"}
         *    },
         *    requirements= {
         *     {"name"="id", "dataType"="integer", "requirement"="∅", "description"="Company id"}
         *    }
         * )
         */
        public function getCompanyAction(Request $request)
        {
            $company = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Companies')
                ->find($request->get('id'));
            /* @var $companies Companies[] */

            if (empty($company)) {
                return new JsonResponse(['message' => 'Company not found'], Response::HTTP_NOT_FOUND);
            }

            return $company;
        }
        /////// FIN ///////
        /**
         * @Rest\View()
         * @Rest\Put("/companies/{id}")
         * @ApiDoc(
         *    description="Mettre à jour une company",
         *    resource="Companies",
         *
         *    output= {
         *      "class"=Companies::class, "collection"=true, "groups"={"companies"}
         *    },
         *    requirements= {
         *     {"name"="id", "dataType"="integer", "requirement"="∅", "description"="Company id"},
         *     {"name"="name", "dataType"="string", "requirement"="∅", "description"="Company name"},
         *     {"name"="address", "dataType"="string", "requirement"="∅", "description"="Company address"},
         *     {"name"="city", "dataType"="string", "requirement"="∅", "description"="Company city"},
         *     {"name"="country", "dataType"="string", "requirement"="∅", "description"="Company country"},
         *     {"name"="postcode", "dataType"="integer", "requirement"="∅", "description"="Company postcode"},
         *     {"name"="telephone", "dataType"="integer", "requirement"="∅", "description"="Company telephone"}
         *    }
         * )
         */
        ////////////// PERMET DE RENTRER  UNE COMPANY /////////////////////// OK
        public function updateCompanyAction(Request $request)
        {
            $companies = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Companies')
                ->find($request->get('id'));
            /* @var $companies Companies */

            if (empty($companies)) {
                return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }

            $form = $this->createForm(CompaniesType::class, $companies);

            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->merge($companies);
                $em->flush();
                return $companies;
            } else {
                return $form;
            }
        }
        //////////////// AJOUTER UNE COMPANY ////////////////////////////// OK
        /**
         * @Rest\View(statusCode=Response::HTTP_CREATED)
         * @Rest\Post("/companies")
         * @ApiDoc(
         *    description="Ajouter une company",
         *    resource="Companies",
         *
         *    output= {
         *      "class"=Companies::class, "collection"=true, "groups"={"companies"}
         *    },
         *    requirements= {
         *     {"name"="name", "dataType"="string", "requirement"="∅", "description"="Company name"},
         *     {"name"="address", "dataType"="string", "requirement"="∅", "description"="Company address"},
         *     {"name"="city", "dataType"="string", "requirement"="∅", "description"="Company city"},
         *     {"name"="country", "dataType"="string", "requirement"="∅", "description"="Company country"},
         *     {"name"="postcode", "dataType"="integer", "requirement"="∅", "description"="Company postcode"},
         *     {"name"="telephone", "dataType"="integer", "requirement"="∅", "description"="Company telephone"}
         *    }
         * )
         */
        public function addCompanyAction(Request $request)
        {
            $company = new Companies();
            $form = $this->createForm(CompaniesType::class, $company);

            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $risks_id = $em->getRepository('AppBundle:Risks')->find($request->get('risks_id'));
                if ($risks_id == NULL){
                    throw $this->createNotFoundException("Le risk n'existe pas");
                }
                $typecompanie_id = $em->getRepository('AppBundle:TypeCompanie')->find($request->get('typecompanie_id'));
                if ($typecompanie_id == NULL){
                    throw $this->createNotFoundException("Le type n'existe pas");
                }
                $em->persist($company);
                $em->flush();
                return $company;
            } else {
                return $form;
            }
        }
        ///////////////////// DELETE UNE COMPANY ////////////////////////// OK
        /**
         * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
         * @Rest\Delete("/companies/{id}")
         * @ApiDoc(
         *    description="Supprimer une company",
         *    resource="Companies",
         *
         *    output= {
         *      "class"=Companies::class, "collection"=true, "groups"={"companies"}
         *    },
         *    requirements= {
         *     {"name"="id", "dataType"="integer", "requirement"="∅", "description"="Company id"}
         *
         *    }
         * )
         */
        public function removeCompanyAction(Request $request)
        {
            $em = $this->get('doctrine.orm.entity_manager');
            $companies = $em->getRepository('AppBundle:Companies')
                ->find($request->get('id'));
            /* @var $companies Companies */

            $em->remove($companies);
            $em->flush();
        }
}
