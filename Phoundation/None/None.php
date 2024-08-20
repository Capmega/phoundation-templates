<?php

/**
 * Class None
 *
 * This is the None template, a template that will build *nothing* and allows (and requires) you to build all the HTML
 * yourself
 *
 * @author    Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package None\Web
 */


declare(strict_types=1);


namespace Templates\None;

use Phoundation\Filesystem\FsDirectory;
use Phoundation\Filesystem\FsRestrictions;
use Phoundation\Filesystem\Interfaces\FsDirectoryInterface;
use Phoundation\Web\Html\Template\Template;
use Templates\None\Html\Components\Menu;


class None extends Template
{
    /**
     * Template constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->name        = 'None';
        $this->page_class  = TemplatePage::class;
        $this->menus_class = Menu::class;

        parent::__construct();
    }


    /**
     * Return a description for this template
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return 'This is the None template, a template that will build *nothing* and allows (and requires) you to build all the HTML yourself';
    }


    /**
     * Returns the path for this template
     *
     * @return FsDirectoryInterface
     */
    public function getDirectory(): FsDirectoryInterface
    {
        return new FsDirectory(__DIR__ . '/', FsRestrictions::getReadonly(DIRECTORY_ROOT, 'Templates\Phoundation\None::getDirectory()'));
    }
}
