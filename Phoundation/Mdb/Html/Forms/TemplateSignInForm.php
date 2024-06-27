<?php

/**
 * Class TemplateSignIn form
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */

declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Forms;

use Phoundation\Web\Html\Forms\SignInForm;
use Phoundation\Web\Html\Html;
use Phoundation\Web\Html\Template\TemplateRenderer;

class TemplateSignInForm extends TemplateRenderer
{
    /**
     * SignInForm class constructor
     */
    public function __construct(SignInForm $component)
    {
        parent::__construct($component);
    }


    /**
     * Render the HTML for this Sign-in form
     *
     * @return string|null
     */
    public function render(): ?string
    {
        $this->render = ' <!-- Email input -->
                          <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control" />
                            <label class="form-label" for="email">' . tr('Email address') . '</label>
                          </div>
                        
                          <!-- Password input -->
                          <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control" />
                            <label class="form-label" for="password">' . tr('Password') . '</label>
                          </div>
                        
                          <!-- 2 column grid layout for inline styling -->
                          <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                              <!-- Checkbox -->
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember_me" checked />
                                <label class="form-check-label" for="remember_me"> ' . tr('Remember me') . ' </label>
                              </div>
                            </div>
                        
                            <div class="col">
                              <!-- Simple link -->
                              <a href="' . Html::safe($this->component->getForgotPasswordUrl()) . '">' . tr('Forgot password?') . '</a>
                            </div>
                          </div>
                        
                          <!-- Submit button -->
                          <button type="submit" class="btn btn-primary btn-block mb-4">' . tr('Sign in') . '</button>
                        
                          <!-- Register buttons -->
                          <div class="text-center">
                            <p>' . tr('Not a member?') . ' <a href="' . Html::safe($this->component->getRegisterUrl()) . '">' . tr('Register') . '</a></p>
                            <p>' . tr('or sign up with:') . '</p>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                              <i class="fab fa-facebook-f"></i>
                            </button>
                        
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                              <i class="fab fa-google"></i>
                            </button>
                        
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                              <i class="fab fa-twitter"></i>
                            </button>
                        
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                              <i class="fab fa-github"></i>
                            </button>
                          </div>';

       return parent::render();
    }
}
