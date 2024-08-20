<?php

/**
 * Class TemplateInputImage
 *
 *
 *
 * @author    Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\AdminLte
 */


declare(strict_types=1);

namespace Templates\Phoundation\AdminLte\Html\Components\Input;

use Phoundation\Web\Html\Components\Input\InputImage;


class TemplateInputImage extends TemplateInput
{
    /**
     * InputImage class constructor
     */
    public function __construct(InputImage $component)
    {
        $component->addClasses('form-control');
        parent::__construct($component);
    }
}
