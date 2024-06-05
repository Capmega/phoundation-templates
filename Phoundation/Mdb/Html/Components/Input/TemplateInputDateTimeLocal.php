<?php

declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Components\Input;

use Phoundation\Web\Html\Components\Input\InputDateTimeLocal;


/**
 * Class TemplateInputDateTimeLocal
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */
class TemplateInputDateTimeLocal extends TemplateInput
{
    /**
     * InputDateTimeLocal class constructor
     */
    public function __construct(InputDateTimeLocal $component)
    {
        $component->addClasses('form-control');
        parent::__construct($component);
    }
}