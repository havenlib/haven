<?php

namespace Evocatio\Bundle\SecurityBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use Evocatio\Bundle\SecurityBundle\Entity\User as Entity;
use Evocatio\Bundle\SecurityBundle\Form\UserType as Form;

//use Evocatio\Bundle\SecurityBundle\Form\LoginType;

class LoginController extends ContainerAware {

    /**
     *  @Route("/auth/login")
     *  @Method("GET")
     */
    public function loginAction() {
        $request = $this->container->get("Request");
        $session = $request->getSession();
        $login_form = $this->container->get('form.factory')->create(new \Evocatio\Bundle\SecurityBundle\Form\LoginType);
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
        $templating = $this->container->get('templating');

        $render = $templating->render('EvocatioSecurityBundle:Login:login.html.twig', array(
            // last username entered by the user
            "csrfToken" => $csrfToken,
            "login_form" => $login_form->createView(),
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
                ));

        $response = new Response();
        if ($request->isXMLHttpRequest()) {
            $render = json_encode(array('message' => 'NotLoggedIn', 'render' => $render));
            $response->headers->set('Content-Type', 'application/json');
        }

        $response->setContent($render);
        return $response;
    }

    /**
     * @Route("/auth/register", name="EvocatioSecurityBundle_register")
     */
    public function registerAction() {
        $templating = $this->container->get('templating');
        $user = new User();
        $register_form = $this->container->get("form.factory")->create(new \Evocatio\Bundle\SecurityBundle\Form\RegisterType($user));
        $request = $this->container->get("request");

        if ($request->getMethod() == "POST" && $this->register($register_form, $request->get("register"))) {
            $render = "L'utilisateur est créer avec succès";
            $message = 'IsRegistered';
        } else {
            $render = $templating->render('EvocatioSecurityBundle:Login:register.html.twig', array(
                // last username entered by the user
//                    "csrfToken" => $csrfToken,
                "register_form" => $register_form->createView(),
//                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
//                    'error' => $error,
                    ));
            $message = 'NotRegistered';
        }
        $response = new Response();
        if ($request->isXMLHttpRequest()) {
            $render = json_encode(array('message' => $message, 'render' => $render));
            $response->headers->set('Content-Type', 'application/json');
        }

        $response->setContent($render);
        return $response;
    }

    /**
     * reset confirmation by the user
     * @Route("/auth/confirmation/{uuid}", name="EvocatioSecurityBundle_resetConfirmation") 
     */
//    public function resetConfirmationAction($uuid) {
//        $em = $this->container->get("doctrine")->getEntityManager();
//        $request = $this->container->get("request");
//        $confirm_data = $request->get("evocatio_bundle_securitybundle_confirmtype");
//        $user_reset = $em->getRepository("EvocatioSecurityBundle:UserReset")->findOneBy(array("uuid" => $uuid));
//        if (null == $user_reset) {
//            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("page.pas.trouve");
//        }
//
//        $confirm_form = $this->container->get("form.factory")->create(new \Evocatio\Bundle\SecurityBundle\Form\ConfirmType());
//
//        $templating = $this->container->get("templating");
//        $render = null;
//        if ($request->getMethod() == "POST") {
//            $confirm_form->bind($confirm_data);
//            if ($confirm_form->isValid()) {
//                if ($user_reset->getConfirmation() == $confirm_data["confirmation"] && !null == $user_reset->getUser()) {
//                    $factory = $this->container->get('security.encoder_factory');
//                    $user = $user_reset->getUser();
//                    $encoder = $factory->getEncoder($user);
//                    $user->setPassword($encoder->encodePassword($confirm_data["plainPassword"]["first"], $user->getSalt()));
//                } else {
//                    throw new \Exception("the user cannot be found or the reset doesnt exist");
//                }
//                $em->persist($user);
//                $em->remove($user_reset);
//                $em->flush();
//                $this->container->get("session")->getFlashBag()->add("success", "c'est réussi");
//
//                return new \Symfony\Component\HttpFoundation\RedirectResponse($this->container->get("router")->generate("EvocatioSecurityBundle_homepage"));
//            }
//        }
//        return new Response($templating->render("EvocatioSecurityBundle:Admin:resetConfirmation.html.twig", array("confirm_form" => $confirm_form->createView(), "uuid" => $uuid)));
//    }

    /**
     * @Route("/auth/reset_request", name="EvocatioSecurityBundle_resetRequest") 
     */
    public function resetRequestAction() {

        $reset_form = $this->container->get("form.factory")->create(new \Evocatio\Bundle\SecurityBundle\Form\ResetType());
        $request = $this->container->get("request");
        $reset_data = $request->get("evocatio_bundle_securitybundle_resettype");
        $templating = $this->container->get("templating");
        $render = null;
        if ($request->getMethod() == "POST") {
            $reset_form->bind($reset_data);
            if ($reset_form->isValid()) {
                $em = $this->container->get("Doctrine");
                $user = $em->getRepository("EvocatioSecurityBundle:User")->findOneBy(array("email" => $reset_data["email"]));
//                return new Response("whate: ".print_r($reset_data["email"],true));
                if (null == $user) {
                    $error = "email.does.not.exist";
                    $message = 'emailNotFound';
                } else {
//                    we can send the request for reset
//@todo                    could check if expires
                    $user_reset = $em->getRepository("EvocatioSecurityBundle:UserReset")->findOneBy(array("user" => $user->getId()));
//                    only if theyre is not already a request for this user we create one.
                    if (null == $user_reset) {
                        $user_reset = new \Evocatio\Bundle\SecurityBundle\Entity\UserReset();
                        $user_reset->setUser($user);
                        $success = "new.reset.sent";
                        $em->getEntityManager()->persist($user_reset);
                        $em->getEntityManager()->flush();
                    } else {
                        $success = "reset.exists.resending";
                    }
                    $this->sendEmailReset(array("to" => $user->getEmail(), "user_reset" => $user_reset));
                    $message = 'resetSent';
//                    Send reset
                }
            }
        }
        $render = $templating->render("EvocatioSecurityBundle:Login:resetRequest.html.twig", array(
            "reset_form" => $reset_form->createView(), "success" => !empty($success) ? $success : null, "error" => !empty($error) ? $error : null
                ));
        $response = new Response();
        if ($request->isXMLHttpRequest()) {
            $render = json_encode(array('message' => $message, 'render' => $render));
            $response->headers->set('Content-Type', 'application/json');
        }

        $response->setContent($render);
        return $response;
    }

    /**
     *  @Route("/auth/login_check", name="login_check")
     *  @template
     */
    public function loginCheckAction() {
        
    }

    /**
     *  @Route("/auth/logout", name="EvocatioSecurityBundle_logout")
     *  @template
     */
    public function logoutAction() {
        
    }

    /**
     *  @Route("/auth/success", name="login_succes")
     */
    public function successAction() {
//    if is ajax
        $templating = $this->container->get('templating');
        $render = $templating->render('EvocatioSecurityBundle:Login:userWelcome.html.twig');
        $response = new Response();
        if ($this->container->get('Request')->isXMLHttpRequest()) {
            $render = json_encode(array('message' => 'IsLoggedIn', 'render' => $render));
            $response->headers->set('Content-Type', 'application/json');
        }

        $response->setContent($render);
        return $response;
    }

    /**
     * A vérifier
     * Registering a new user. should be done
     */
    public function register($register_form, $register) {
        $register_form->bind($register);
        if ($register_form->isValid()) {
            $user = $register_form->getData();
            $user->setUsername($user->getEmail());
            if (0 !== strlen($password = $user->getPlainPassword())) {
                $factory = $this->container->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            }
            $em = $this->container->get("doctrine")->getEntityManager();
            $em->persist($user);
            $em->flush();
            return true;
        }
        return false;
    }

    public function sendEmailReset($params) {
        $request = $this->container->get("request");
        $prefix = $request->isSecure() ? "https://" : "http://";

        $mail_message = new \Evocatio\Bundle\SecurityBundle\Lib\PasswordResetMailMessage($this->container->get("kernel")->getEnvironment());
        $mail_message->setBaseSujet("Réinitialisation du mot de passe");
        $mail_message->setBaseHtmlBody($this->container->get("templating")->render("EvocatioSecurityBundle:mail_templates:forget_password_template.html.twig", array(
                    "host" => $prefix . $request->getHttpHost()
                    , "confirmationUrl" => $this->container->get('router')->generate("EvocatioSecurityBundle_resetConfirmation", array("uuid" => $params["user_reset"]->getUuid()), true)
                    , "confirmation" => $params["user_reset"]->getConfirmation()
                )));
        $mail_message->addParam("host", $prefix . $request->getHttpHost());
        \Evocatio\Bundle\CoreBundle\Lib\MailService::sendAllMessages($mail_message, "sc@evocatio.com");
    }

}