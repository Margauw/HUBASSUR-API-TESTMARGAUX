<?php
/**
 * Created by PhpStorm.
 * User: gauthierflichy
 * Date: 12/12/16
 * Time: 18:44
 */

namespace AppBundle\Controller;

use AppBundle\Form\LoginType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @ApiDoc(
     *    description="Récupère tous les utilisateurs",
     *    resource="Users",
     *    output= {
     *      "class"=User::class, "collection"=true, "groups"={"users"}
     *    }
     * )
     */
    public function getUsersAction(Request $request)
    {
        $users = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:User')
            ->findAll();
        /* @var $users User[] */

        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'id' => $user->getId(),
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
            ];
        }

        return new JsonResponse($formatted);
    }

    /**
     * @ApiDoc(
     *    description="Récupère un utilisateur specifique",
     *    resource="Users",
     *    output= {
     *      "class"=User::class, "collection"=true, "groups"={"users"}
     *    },
     *    requirements= {
     *      {"name"="id", "dataType"="integer", "requirement"="∅", "description"="User id"}
     *     }
     * )
     */
    public function getUserAction(Request $request, $id)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:User')
            ->find($id);
        /* @var $user User */

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $formatted = [
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
        ];

        return new JsonResponse($formatted);
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"user"})
     * @Rest\Post("/registration")
     * @ApiDoc(
     *    description="Créer un utilisateur",
     *    resource="Users",
     *
     *    output= {
     *      "class"=User::class, "collection"=true, "groups"={"users"}
     *    },
     *    requirements= {
     *      {"name"="firstname", "dataType"="string", "requirement"="∅", "description"="User firstname"},
     *      {"name"="lastname", "dataType"="string", "requirement"="∅", "description"="User lastname"},
     *      {"name"="email", "dataType"="string", "requirement"="∅", "description"="User email"},
     *      {"name"="plainPassword", "dataType"="string", "requirement"="∅", "description"="User plain password"}
     *    }
     * )
     */
    public function postRegistrationAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['validation_groups' => ['Default', 'New']]);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            // le mot de passe en claire est encodé avant la sauvegarde
            $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);
            $user->setRole(array());

            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($user);
            $em->flush();
            return $user;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/users/{id}")
     * @ApiDoc(
     *    description="Supprimer un utilisateur",
     *    resource="Users",
     *
     *    output= {
     *      "class"=User::class, "collection"=true, "groups"={"users"}
     *    },
     *    requirements= {
     *      {"name"="id", "dataType"="integer", "requirement"="∅", "description"="User id"}
     *
     *    }
     * )
     */
    public function removeUserAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $user = $em->getRepository('AppBundle:User')
            ->find($request->get('id'));
        /* @var $user User */

        if ($user) {
            $em->remove($user);
            $em->flush();
        }
    }

    /**
     * @Rest\View(serializerGroups={"user"})
     * @Rest\Put("/users/{id}")
     * @ApiDoc(
     *    description="Mettre un utilisateur à jour",
     *    resource="Users",
     *
     *    output= {
     *      "class"=User::class, "collection"=true, "groups"={"users"}
     *    },
     *    requirements= {
     *      {"name"="id", "dataType"="integer", "requirement"="∅", "description"="User id"},
     *      {"name"="firstname", "dataType"="string", "requirement"="∅", "description"="User firstname"},
     *      {"name"="lastname", "dataType"="string", "requirement"="∅", "description"="User lastname"},
     *      {"name"="email", "dataType"="string", "requirement"="∅", "description"="User email"},
     *      {"name"="plainPassword", "dataType"="string", "requirement"="∅", "description"="User plainPassword"}
     *    }
     * )
     */
    public function updateUserAction(Request $request)
    {
        return $this->updateUser($request, true);
    }

    /**
     * @Rest\View(serializerGroups={"user"})
     * @Rest\Patch("/users/{id}")
     */
    public function patchUserAction(Request $request)
    {
        return $this->updateUser($request, false);
    }

    private function updateUser(Request $request, $clearMissing)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:User')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $user User */

        if (empty($user)) {
            return $this->userNotFound();
        }

        if ($clearMissing) { // Si une mise à jour complète, le mot de passe doit être validé
            $options = ['validation_groups' => ['Default', 'FullUpdate']];
        } else {
            $options = []; // Le groupe de validation par défaut de Symfony est Default
        }

        $form = $this->createForm(UserType::class, $user, $options);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            // Si l'utilisateur veut changer son mot de passe
            if (!empty($user->getPlainPassword())) {
                $encoder = $this->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($encoded);
            }
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($user);
            $em->flush();
            return $user;
        } else {
            return $form;
        }
    }

    private function userNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"user"})
     * @Rest\Post("/login_check")
     */

    public function loginAction(Request $request)
    {
        $login = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:User')
            ->findAll();

        $form = $this->createForm(LoginType::class, $login);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                return "Vous êtes connectés";
            }
            else{
                return "Veuillez réessayer";
            }
        }
        else {
            return $form;
        }
    }
}