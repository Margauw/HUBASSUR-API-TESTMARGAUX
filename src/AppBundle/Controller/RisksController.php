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
use AppBundle\Entity\Risks;
use AppBundle\Form\RisksType;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class RisksController extends Controller {
    /**
     * @Route("/risks", name="risks_list")
     * @Method({"GET"})
     * @ApiDoc(
     *    description="Récuperer l'ensemble des risques",
     *    resource="Risks",
     *
     *    output= {
     *      "class"=Risks::class, "collection"=true, "groups"={"risks"}
     *    }
     * )
     */
    public function getRisksAction(Request $request)
        {
            $risks = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Risks')
                ->findAll();
            /* @var $risks Risks[] */

            $formatted = [];
            foreach ($risks as $risk) {
                $formatted[] = [
                    'id' => $risk->getId(),
                    'name' => $risk->getName(),
                    'description' => $risk->getDescription(),
                    'size' => $risk->getSize(),

                ];
            }

            return new JsonResponse($formatted);

        }
        /**
         * @Rest\View()
         * @Rest\Get("/risks/{id}")
         * @ApiDoc(
         *    description="Récuperer un risque spécifique",
         *    resource="Risks",
         *
         *    output= {
         *      "class"=Risks::class, "collection"=true, "groups"={"risks"}
         *    },
         *    requirements= {
         *       {"name"="id", "dataType"="integer", "requirement"="∅", "description"="Risks id"}
         *     }
         * )
         */
        public function getRiskAction(Request $request)
        {
            $risk = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Risks')
                ->find($request->get('id'));
            /* @var $risks Risks[] */

            if (empty($risk)) {
                return new JsonResponse(['message' => 'Risk Not Found'], Response::HTTP_NOT_FOUND);
            }

            return $risk;
        }
        /**
         * @Rest\View()
         * @Rest\Put("/risks/{id}")
         * @ApiDoc(
         *    description="Mettre à jour un risque",
         *    resource="Risks",
         *
         *    output= {
         *      "class"=Risks::class, "collection"=true, "groups"={"risks"}
         *    },
         *    requirements= {
         *       {"name"="id", "dataType"="integer", "requirement"="∅", "description"="Risks id"},
         *       {"name"="name", "dataType"="string", "requirement"="∅", "description"="Risks name"},
         *       {"name"="description", "dataType"="string", "requirement"="∅", "description"="Risks description"},
         *      {"name"="size", "dataType"="integer", "requirement"="∅", "description"="Risks size"},
         *     }
         * )
         */
        public function updateRiskAction(Request $request)
        {
            $risks = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Risks')
                ->find($request->get('id'));
            /* @var $risks Risks */

            if (empty($risks)) {
                return new JsonResponse(['message' => 'Risk not found'], Response::HTTP_NOT_FOUND);
            }

            $form = $this->createForm(RisksType::class, $risks);

            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->merge($risks);
                $em->flush();
                return $risks;
            } else {
                return $form;
            }
        }
        /**
         * @Rest\View(statusCode=Response::HTTP_CREATED)
         * @Rest\Post("/risks")
         * @ApiDoc(
         *    description="Ajouter un risque",
         *    resource="Risks",
         *
         *    output= {
         *      "class"=Risks::class, "collection"=true, "groups"={"risks"}
         *    },
         *    requirements= {
         *       {"name"="name", "dataType"="string", "requirement"="∅", "description"="Risks name"},
         *       {"name"="description", "dataType"="string", "requirement"="∅", "description"="Risks description"},
         *       {"name"="size", "dataType"="integer", "requirement"="∅", "description"="Risks size"}
         *     }
         * )
         */
        public function addRiskAction(Request $request)
        {
            $risk = new Risks();
            $form = $this->createForm(RisksType::class, $risk);

            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $companies_id = $em->getRepository('AppBundle:SubscriptionPolicy')->find($request->get('companies_id'));
                if ($companies_id == NULL){
                    throw $this->createNotFoundException("La compagnie n'existe pas");
                }
                $subscriptionpolicy_id = $em->getRepository('AppBundle:SubscriptionPolicy')->find($request->get('subscriptionpolicy_id'));
                if ($subscriptionpolicy_id == NULL){
                    throw $this->createNotFoundException("La sub n'existe pas");
                }
                $em->persist($risk);
                $em->flush();
                return $risk;
            } else {
                return $form;
            }
        }
        /**
         * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
         * @Rest\Delete("/risks/{id}")
         * @ApiDoc(
         *    description="Supprimer un risque",
         *    resource="Risks",
         *
         *    output= {
         *      "class"=Risks::class, "collection"=true, "groups"={"risks"}
         *    },
         *    requirements= {
         *      {"name"="id", "dataType"="integer", "requirement"="∅", "description"="Risks id"}
         *    }
         * )
         */
        public function removeRiskAction(Request $request)
        {
            $em = $this->get('doctrine.orm.entity_manager');
            $risks = $em->getRepository('AppBundle:Risks')
                ->find($request->get('id'));
            /* @var $risks Risks */

            $em->remove($risks);
            $em->flush();
        }
}
