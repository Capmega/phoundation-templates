<?php

/**
 * class TemplatePage
 *
 *
 *
 * @author    Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\AdminLte
 */


declare(strict_types=1);

namespace Templates\Phoundation\AdminLte;

use Phoundation\Core\Plugins\Plugins;
use Phoundation\Utils\Config;
use Phoundation\Web\Html\Components\Widgets\Panels\BottomPanel;
use Phoundation\Web\Html\Components\Widgets\Panels\HeaderPanel;
use Phoundation\Web\Html\Components\Widgets\Panels\Interfaces\PanelsInterface;
use Phoundation\Web\Html\Components\Widgets\Panels\Panels;
use Phoundation\Web\Html\Components\Widgets\Panels\SidePanel;
use Phoundation\Web\Html\Components\Widgets\Panels\TopPanel;
use Phoundation\Web\Html\Html;
use Phoundation\Web\Requests\Request;
use Phoundation\Web\Requests\Response;


class TemplatePage extends \Phoundation\Web\Requests\TemplatePage
{
    /**
     * Execute, builds and returns the page output, according to the template.
     *
     * Either use the default execution steps from parent::execute($target), or write your own execution steps here.
     * Once the output has been generated, it should be returned.
     *
     * @return string|null
     */
    public function execute(): ?string
    {
        // Generate panels used by the plugins
        Request::setPanelsObject($this->getAvailablePanelsObject());

        // Start all plugins
        Plugins::start();

        // Render the page body
        $body = $this->renderMain();

        if (Response::getRenderMainContentsOnly()) {
            return $body;
        }

        // Build HTML and minify the output
        $output = $this->renderHtmlHeadTag();
        Response::getHtmlHeadersSent(true);

        if (Response::getRenderMainWrapper()) {
            $body    = Request::getPanelsObject()->get('top', false)?->render() .
                       Request::getPanelsObject()->get('left')?->render() .
                       $body .
                       Request::getPanelsObject()->get('bottom', false)?->render();

            $output .= ' <body class="sidebar-mini' . (Config::get('web.panels.sidebar.collapsed', false) ? ' sidebar-collapse' : '') . '" style="height: auto;">
                            <div class="wrapper">' .
                                Response::getFlashMessagesObject()->render() .
                                $body . '
                            </div>';

        } else {
            // Page requested that no body parts be built
            $output .= Response::getFlashMessagesObject()->render() . $body;
        }

        // Add file upload javascript, if required. Add footers and minify all the HTML
        $output .= Response::getFileUploadHandlersObject()->render();
        $output .= $this->renderHtmlFooters();
        $output  = Html::minify($output);

        // Build Template specific HTTP headers
        $this->renderHttpHeaders($output);
        return $output;
    }


    /**
     * Returns a Panels object with the available panels for this Template
     *
     * @return PanelsInterface
     */
    public function getAvailablePanelsObject(): PanelsInterface
    {
        return Panels::new()
            ->add(Config::getBoolean('web.panels.top.enabled'   , true) ? TopPanel::new()    : null, 'top')
            ->add(Config::getBoolean('web.panels.left.enabled'  , true) ? SidePanel::new()   : null, 'left')
            ->add(Config::getBoolean('web.panels.header.enabled', true) ? HeaderPanel::new() : null, 'header')
            ->add(Config::getBoolean('web.panels.bottom.enabled', true) ? BottomPanel::new() : null, 'bottom');
    }


    /**
     * Build the HTTP headers for the page
     *
     * @param string $output
     * @return void
     */
    public function renderHttpHeaders(string $output): void
    {
        Response::setContentType('text/html');
        Response::setDoctype('html');
    }


    /**
     * Build the HTML header for the page
     *
     * @return string|null
     */
    public function renderHtmlHeadTag(): ?string
    {
        // Set head meta data
        Response::setFavIcon();
        Response::setViewport('width=device-width, initial-scale=1');

        // Load basic AdminLte and fonts CSS
        Response::loadCss([
            'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
            'phoundation/adminlte/plugins/fontawesome-free-6.4.0-web/css/all',
            'phoundation/adminlte/plugins/fontawesome-free-6.4.0-web/css/regular',
//            'phoundation/adminlte/plugins/fontawesome-free-6.4.0-web/css/v4-shim',
            'phoundation/adminlte/css/adminlte',
            'phoundation/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars',
            'phoundation/adminlte/css/phoundation'
        ], true);

        // Load configured CSS files
        Response::loadCss(Config::getArray('templates.adminlte.css', []));

        // Load basic AdminLte amd jQuery javascript libraries
        Response::loadJavascript([
            'phoundation/adminlte/plugins/jquery/jquery',
            'phoundation/adminlte/plugins/jquery-ui/jquery-ui',
            'phoundation/adminlte/plugins/bootstrap/js/bootstrap.bundle',
            'phoundation/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars',
            'phoundation/adminlte/js/adminlte',
            'phoundation/phoundation/js/jquery-phoundation',
        ], prefix: true);

        // Set basic page details
        Response::setPageTitle(Config::get('project.name', tr('Phoundation project')) . ' (' . Response::getHeaderTitle() . ')');

        return Response::renderHtmlHeaders();
    }


    /**
     * Build the HTML body
     *
     * @return string|null
     */
    public function renderMain(): ?string
    {
        $body = parent::renderMain();

        if (Response::getRenderMainContentsOnly()) {
            return $body;
        }

        if (Response::getRenderMainWrapper()) {
            $body = '   <div class="' . Response::getClass('content-wrapper', 'content-wrapper') .  '" style="min-height: 1518.06px;">
                           ' . Request::getPanelsObject()->get('header', false)?->render() . '
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            ' . $body . '
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>';
        }

        return $body;
    }
}
