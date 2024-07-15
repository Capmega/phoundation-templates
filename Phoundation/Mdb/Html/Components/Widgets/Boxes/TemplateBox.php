<?php

/**
 * Class TemplateBox
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */

declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Components\Widgets\Boxes;

use Phoundation\Web\Html\Components\Widgets\Boxes\Box;
use Phoundation\Web\Html\Template\TemplateRenderer;

abstract class TemplateBox extends TemplateRenderer
{
    /**
     * Box class constructor
     */
    public function __construct(Box $component)
    {
        parent::__construct($component);
    }
}
