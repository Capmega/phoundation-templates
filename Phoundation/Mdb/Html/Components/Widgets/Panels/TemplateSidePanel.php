<?php

declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Components\Widgets\Panels;

use Phoundation\Core\Core;
use Phoundation\Core\Sessions\Session;
use Phoundation\Utils\Config;
use Phoundation\Utils\Strings;
use Phoundation\Web\Html\Components\Widgets\Panels\SidePanel;
use Phoundation\Web\Html\Template\TemplateRenderer;
use Phoundation\Web\Http\UrlBuilder;


/**
 * Class TemplateSidePanel
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */
class TemplateSidePanel extends TemplateRenderer
{
    /**
     * SidePanel class constructor
     */
    public function __construct(SidePanel $component)
    {
        parent::__construct($component);
    }


    /**
     * Renders and returns the sidebar
     *
     * @return string|null
     */
    public function render(): ?string
    {
        $this->render = '   <nav data-mdb-sidenav-init id="sidenav-9" data-mdb-scroll-container="#scroll-container" class="sidenav sidenav-sm" data-mdb-hidden="true" data-mdb-accordion="true">
                              <a href="' . UrlBuilder::getWww('index') . '" data-mdb-ripple-init class="d-flex justify-content-center py-4 mb-3" style="border-bottom: 2px solid #f5f5f5" data-mdb-ripple-color="primary">
                                <img src="' . UrlBuilder::getImg('img/logos/' . Core::getProjectSeoName() . '/large.webp') . '" alt="' . tr(':project logo', [':project' => Strings::capitalize(Config::get('project.name'))]) . '" width="250px" draggable="false">
                              </a>

                              <a data-mdb-ripple-init class="d-flex py-4 mb-3 justify-content-center" style="border-bottom: 2px solid #f5f5f5" href="' . UrlBuilder::getWww('profile') . '" data-mdb-ripple-color="primary">
                                ' . Session::getUser()->getPicture()
                                        ->getHtmlElement()
                                        ->setSrc(UrlBuilder::getImg('img/profiles/default.png'))
                                        ->setClass('img-circle elevation-2')
                                        ->setAlt(tr('Profile picture for :user', [':user' => Session::getUser()->getDisplayName()]))
                                        ->setWidth(32)
                                        ->setHeight(32)
                                        ->render() . Session::getUser()->getDisplayName() . '
                              </a>
                              ' . $this->component->getMenu()?->render() . '
                            </nav>';

        $this->render .= $this->component->getModals()?->render() . PHP_EOL;

        return parent::render();

        $this->render = ' <aside class="main-sidebar sidebar-dark-primary elevation-4">
                            <a href="' . UrlBuilder::getWww('index') . '" class="brand-link">
                              <img src="' . UrlBuilder::getImg('img/logos/' . Core::getProjectSeoName() . '/large.webp') . '" alt="' . tr(':project logo', [':project' => Strings::capitalize(Config::get('project.name'))]) . '" class="brand-image elevation-3" style="opacity: .8" width="250px">
                            </a>
                            <div class="sidebar">
                              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                  ' . Session::getUser()->getPicture()
                                        ->getHtmlElement()
                                            ->setSrc(UrlBuilder::getImg('img/profiles/default.png'))
                                            ->setClass('img-circle elevation-2')
                                            ->setAlt(tr('Profile picture for :user', [':user' => Session::getUser()->getDisplayName()]))
                                            ->render() . '
                                </div>
                                <div class="info">
                                  <a href="' . (Session::getUser()->isGuest() ? '#' : UrlBuilder::getWww('/my/profile.html')) . '" class="d-block">' . Session::getUser()->getDisplayName() . '</a>
                                </div>
                              </div>
                              <div class="form-inline">
                                <div class="input-group" data-widget="sidebar-search">
                                  <input class="form-control form-control-sidebar" type="search" placeholder="' . tr('Search menu') . '" aria-label="' . tr('Search menu') . '">
                                  <div class="input-group-append">
                                    <button class="btn btn-sidebar">
                                      <i class="fas fa-search fa-fw"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="sidebar-search-results">
                                  <div class="list-group">
                                    <a href="#" class="list-group-item">
                                      <div class="search-title">
                                        <strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong>
                                      </div>
                                      <div class="search-path">
                                      </div>
                                    </a>
                                  </div>
                                </div>
                              </div>
                        
                              <!-- Sidebar Menu -->
                              <nav>
                                ' . $this->component->getMenu()?->render() . '                                
                              </nav>
                              <!-- /.sidebar-menu -->
                            </div>
                            <!-- /.sidebar -->
                          </aside>';

        $this->render .= $this->component->getModals()?->render() . PHP_EOL;

        return parent::render();
    }
}
