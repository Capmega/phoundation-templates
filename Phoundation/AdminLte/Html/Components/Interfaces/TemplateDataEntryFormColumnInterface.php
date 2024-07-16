<?php

declare(strict_types=1);

namespace Templates\Phoundation\AdminLte\Html\Components\Interfaces;

use Phoundation\Web\Html\Components\Input\Interfaces\RenderInterface;

interface TemplateDataEntryFormColumnInterface
{
    /**
     * Returns the component
     *
     * @return RenderInterface|null
     */
    public function getComponent(): RenderInterface|null;

    /**
     * Sets the component
     *
     * @param RenderInterface|null $component
     * @return static
     */
    public function setComponent(RenderInterface|null $component): static;

    /**
     * Renders and returns the HTML for this component
     *
     * @return string|null
     */
    public function render(): ?string;
}