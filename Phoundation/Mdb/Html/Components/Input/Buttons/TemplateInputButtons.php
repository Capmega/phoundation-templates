<?php

/**
 * Class TemplateButtons
 *
 *
 *
 * @author    Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */


declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Components\Input\Buttons;

use Phoundation\Web\Html\Components\Input\Buttons\InputButtons;
use Phoundation\Web\Html\Template\TemplateRenderer;


class TemplateInputButtons extends TemplateRenderer
{
    /**
     * Buttons class constructor
     */
    public function __construct(InputButtons $component)
    {
        parent::__construct($component);
    }


    /**
     * Renders and returns the buttons HTML
     *
     * @return string|null
     */
    public function render(): ?string
    {
        $this->render = '';

        if ($this->component->getGroup()) {
            $this->render .= '<div class="btn-group" role="group" aria-label="Button group">';
        }

        foreach ($this->component->getSource() as $button) {
            if (is_string($button)) {
                $this->render .= $button . ' ';
            } else {
                $this->render .= $button->render(). ' ';
            }
        }

        if ($this->component->getGroup()) {
            $this->render .= '</div>';
        }

        return parent::render();
    }
}
