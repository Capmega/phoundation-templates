<?php



/**
 * Class TemplateInputPassword
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */

declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Components\Input;

use Phoundation\Web\Html\Components\Input\InputPassword;

class TemplateInputPassword extends TemplateInput
{
    /**
     * InputPassword class constructor
     */
    public function __construct(InputPassword $component)
    {
        $component->addClasses('form-control');
        parent::__construct($component);
    }
}