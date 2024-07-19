<?php

/**
 * Class TemplateInputFile
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\AdminLte
 */

declare(strict_types=1);

namespace Templates\Phoundation\AdminLte\Html\Components\Input;

use Phoundation\Web\Html\Components\Input\InputFile;

class TemplateInputFile extends TemplateInput
{
    /**
     * InputFile class constructor
     */
    public function __construct(InputFile $component)
    {
        $component->addClasses('form-control');
        parent::__construct($component);
    }
}