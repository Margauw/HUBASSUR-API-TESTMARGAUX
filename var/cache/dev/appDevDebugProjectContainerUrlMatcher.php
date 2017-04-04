<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevDebugProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        if (0 === strpos($pathinfo, '/auth-token')) {
            // app_authtoken_removeauthtoken
            if (0 === strpos($pathinfo, '/auth-tokens') && preg_match('#^/auth\\-tokens/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_app_authtoken_removeauthtoken;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_authtoken_removeauthtoken')), array (  '_controller' => 'AppBundle\\Controller\\AuthTokenController::removeAuthTokenAction',));
            }
            not_app_authtoken_removeauthtoken:

            // app_authtoken_postauthtokens
            if ($pathinfo === '/auth-token') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_app_authtoken_postauthtokens;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\AuthTokenController::postAuthTokensAction',  '_route' => 'app_authtoken_postauthtokens',);
            }
            not_app_authtoken_postauthtokens:

        }

        if (0 === strpos($pathinfo, '/companies')) {
            // companies_list
            if ($pathinfo === '/companies') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_companies_list;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\CompaniesController::getCompaniesAction',  '_route' => 'companies_list',);
            }
            not_companies_list:

            // app_companies_getcompany
            if (preg_match('#^/companies/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_app_companies_getcompany;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_companies_getcompany')), array (  '_controller' => 'AppBundle\\Controller\\CompaniesController::getCompanyAction',));
            }
            not_app_companies_getcompany:

            // app_companies_updatecompany
            if (preg_match('#^/companies/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_app_companies_updatecompany;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_companies_updatecompany')), array (  '_controller' => 'AppBundle\\Controller\\CompaniesController::updateCompanyAction',));
            }
            not_app_companies_updatecompany:

            // app_companies_addcompany
            if ($pathinfo === '/companies') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_app_companies_addcompany;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\CompaniesController::addCompanyAction',  '_route' => 'app_companies_addcompany',);
            }
            not_app_companies_addcompany:

            // app_companies_removecompany
            if (preg_match('#^/companies/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_app_companies_removecompany;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_companies_removecompany')), array (  '_controller' => 'AppBundle\\Controller\\CompaniesController::removeCompanyAction',));
            }
            not_app_companies_removecompany:

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        if (0 === strpos($pathinfo, '/r')) {
            if (0 === strpos($pathinfo, '/risks')) {
                // risks_list
                if ($pathinfo === '/risks') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_risks_list;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\RisksController::getRisksAction',  '_route' => 'risks_list',);
                }
                not_risks_list:

                // app_risks_getrisk
                if (preg_match('#^/risks/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_app_risks_getrisk;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_risks_getrisk')), array (  '_controller' => 'AppBundle\\Controller\\RisksController::getRiskAction',));
                }
                not_app_risks_getrisk:

                // app_risks_updaterisk
                if (preg_match('#^/risks/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_app_risks_updaterisk;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_risks_updaterisk')), array (  '_controller' => 'AppBundle\\Controller\\RisksController::updateRiskAction',));
                }
                not_app_risks_updaterisk:

                // app_risks_addrisk
                if ($pathinfo === '/risks') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_app_risks_addrisk;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\RisksController::addRiskAction',  '_route' => 'app_risks_addrisk',);
                }
                not_app_risks_addrisk:

                // app_risks_removerisk
                if (preg_match('#^/risks/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_app_risks_removerisk;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_risks_removerisk')), array (  '_controller' => 'AppBundle\\Controller\\RisksController::removeRiskAction',));
                }
                not_app_risks_removerisk:

            }

            // app_user_postregistration
            if ($pathinfo === '/registration') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_app_user_postregistration;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\UserController::postRegistrationAction',  '_route' => 'app_user_postregistration',);
            }
            not_app_user_postregistration:

        }

        if (0 === strpos($pathinfo, '/users')) {
            // app_user_removeuser
            if (preg_match('#^/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_app_user_removeuser;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_removeuser')), array (  '_controller' => 'AppBundle\\Controller\\UserController::removeUserAction',));
            }
            not_app_user_removeuser:

            // app_user_updateuser
            if (preg_match('#^/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_app_user_updateuser;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_updateuser')), array (  '_controller' => 'AppBundle\\Controller\\UserController::updateUserAction',));
            }
            not_app_user_updateuser:

            // app_user_patchuser
            if (preg_match('#^/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_app_user_patchuser;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_patchuser')), array (  '_controller' => 'AppBundle\\Controller\\UserController::patchUserAction',));
            }
            not_app_user_patchuser:

        }

        // app_user_login
        if ($pathinfo === '/login_check') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_app_user_login;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\UserController::loginAction',  '_route' => 'app_user_login',);
        }
        not_app_user_login:

        if (0 === strpos($pathinfo, '/users')) {
            // get_users
            if ($pathinfo === '/users') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_users;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\UserController::getUsersAction',  '_format' => NULL,  '_route' => 'get_users',);
            }
            not_get_users:

            // get_user
            if (preg_match('#^/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_user;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_user')), array (  '_controller' => 'AppBundle\\Controller\\UserController::getUserAction',  '_format' => NULL,));
            }
            not_get_user:

        }

        // post_registration
        if ($pathinfo === '/registration') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_post_registration;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\UserController::postRegistrationAction',  '_format' => NULL,  '_route' => 'post_registration',);
        }
        not_post_registration:

        if (0 === strpos($pathinfo, '/users')) {
            // remove_user
            if (preg_match('#^/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_remove_user;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'remove_user')), array (  '_controller' => 'AppBundle\\Controller\\UserController::removeUserAction',  '_format' => NULL,));
            }
            not_remove_user:

            // update_user
            if (preg_match('#^/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_update_user;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'update_user')), array (  '_controller' => 'AppBundle\\Controller\\UserController::updateUserAction',  '_format' => NULL,));
            }
            not_update_user:

            // patch_user
            if (preg_match('#^/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_patch_user;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'patch_user')), array (  '_controller' => 'AppBundle\\Controller\\UserController::patchUserAction',  '_format' => NULL,));
            }
            not_patch_user:

        }

        // login
        if ($pathinfo === '/login_check') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_login;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\UserController::loginAction',  '_format' => NULL,  '_route' => 'login',);
        }
        not_login:

        if (0 === strpos($pathinfo, '/auth-token')) {
            // remove_auth_token
            if (0 === strpos($pathinfo, '/auth-tokens') && preg_match('#^/auth\\-tokens/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_remove_auth_token;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'remove_auth_token')), array (  '_controller' => 'AppBundle\\Controller\\AuthTokenController::removeAuthTokenAction',  '_format' => NULL,));
            }
            not_remove_auth_token:

            // post_auth_tokens
            if ($pathinfo === '/auth-token') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_post_auth_tokens;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\AuthTokenController::postAuthTokensAction',  '_format' => NULL,  '_route' => 'post_auth_tokens',);
            }
            not_post_auth_tokens:

        }

        // nelmio_api_doc_index
        if (0 === strpos($pathinfo, '/doc') && preg_match('#^/doc(?:/(?P<view>[^/]++))?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_nelmio_api_doc_index;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nelmio_api_doc_index')), array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  'view' => 'default',));
        }
        not_nelmio_api_doc_index:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
