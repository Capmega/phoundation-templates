<?php

declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Components\Input;


/**
 * Class TemplateInputAutoSuggest
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */
class TemplateInputAutoSuggest extends TemplateInput
{
    /**
     * InputAutoSuggest class constructor
     */
    public function __construct(\Phoundation\Web\Html\Components\Input\InputAutoSuggest $component)
    {
        $component->addClasses('form-control');
        parent::__construct($component);
    }
}