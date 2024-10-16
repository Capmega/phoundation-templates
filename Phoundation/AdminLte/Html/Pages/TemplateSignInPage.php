<?php

declare(strict_types=1);

namespace Templates\Phoundation\AdminLte\Html\Pages;

use Phoundation\Core\Core;
use Phoundation\Core\Sessions\Session;
use Phoundation\Utils\Config;
use Phoundation\Web\Html\Template\TemplateRenderer;
use Phoundation\Web\Http\UrlBuilder;
use Phoundation\Web\Requests\Response;


/**
 * Class TemplateSignInPage
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Phoundation\Web
 */
class TemplateSignInPage extends TemplateRenderer
{
    public function render(): ?string
    {
        // This page will build its own body
        Response::setBuildBody(false);

        $this->render = '   <body class="hold-transition login-page" style="background: url(' . UrlBuilder::getImg('img/backgrounds/' . Core::getProjectSeoName() . '/signin.jpg') . '); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                <div class="login-box">
                                  <!-- /.login-logo -->
                                  <div class="card card-outline card-info">
                                    <div class="card-header text-center">
                                      <a href="' . Config::getString('project.customer-url', 'https://phoundation.org') . '" class="h1">' . Config::getString('project.owner.label', '<span>Phoun</span>dation') . '</a>
                                    </div>
                                    <div class="card-body">
                                      <p class="login-box-msg">' . tr('Please sign in to start your session') . '</p>
                                      <form action="' . UrlBuilder::getWww() . '" method="post">';
                                            if (Session::supports('email')) {
                                                $this->render .= '  <div class="input-group mb-3">
                                                                        <input type="email" name="email" id="email" class="form-control" placeholder="' . tr('Email address') . '"' . (isset_get($get['email']) ? 'value="' . $get['email'] . '"' : '') . '>
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-envelope"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                        <input type="password" name="password" id="password" class="form-control" placeholder="' . tr('Password') . '">
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-lock"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-8">
                                                                            <div class="icheck-primary">
                                                                                <input type="checkbox" id="remember">
                                                                                <label for="remember">
                                                                                    ' . tr('Remember Me') . '
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.col -->
                                                                        <div class="col-4">
                                                                            <button type="submit" class="btn btn-primary btn-block">' . tr('Sign In') . '</button>
                                                                        </div>
                                                                        <!-- /.col -->
                                                                    </div>';
                                            }

        $this->render .= '            </form>';


        if (Session::supports('facebook')) {
            $html = '                 <a href="#" class="btn btn-block btn-primary">
                                          <i class="fab fa-facebook mr-2"></i>' . tr('Sign in using Facebook') . '
                                      </a>';
        }

        if (Session::supports('google')) {
            $html = '                 <a href="#" class="btn btn-block btn-danger">
                                          <i class="fab fa-google-plus mr-2"></i>' . tr('Sign in using Google') . '
                                      </a>';
        }

        if (isset($html)) {
            $this->render .= '       <div class="social-auth-links text-center mt-2 mb-3">
                                         ' . $html . '
                                     </div>';
        }

        if (Session::supports('lost-password')) {
            $this->render .= '        <p class="mb-1">
                                          <a href="' . UrlBuilder::getWww('/lost-password.html')->addQueries(isset_get($post['email']) ? 'email=' . $post['email'] : '', isset_get($post['redirect']) ? 'redirect=' . $post['redirect'] : '') . '">' . tr('I forgot my password') . '</a>
                                      </p>';
        }

        if (Session::supports('register')) {
            $this->render .= '        <p class="mb-0">
                                          <a href="' . UrlBuilder::getWww('/sign-in.html') . '" class="text-center">' . tr('Register a new membership') . '</a>
                                      </p>';
        }

        if (Session::supports('copyright')) {
            $this->render .= '      <div class="login-footer text-center">
                                        ' . 'Copyright © ' . Config::getString('project.copyright', '2024') . ' <b><a href="' . Config::getString('project.owner.url', 'https://phoundation.org') . '" target="_blank">' . Config::getString('project.owner.name', 'Phoundation') . '</a></b><br>' . '
                                        ' . tr('All rights reserved') . '</div>
                                    </div>';
        }

        $this->render .= '          <!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                </div>
                            </body>';

        return parent::render();
    }
}