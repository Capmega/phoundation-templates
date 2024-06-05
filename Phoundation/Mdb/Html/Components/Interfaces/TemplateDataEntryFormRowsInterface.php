<?php

/**
 * interface TemplateDataEntryFormRowsInterface
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\Mdb
 */

declare(strict_types=1);

namespace Templates\Phoundation\Mdb\Html\Components\Interfaces;

use Phoundation\Data\DataEntry\Definitions\Interfaces\DefinitionInterface;
use Phoundation\Web\Html\Components\Forms\DataEntryFormColumn;
use Phoundation\Web\Html\Components\Input\Interfaces\RenderInterface;


interface TemplateDataEntryFormRowsInterface
{
    /**
     * Returns the maximum number of columns per row
     *
     * @return int
     */
    public function getColumnCount(): int;

    /**
     * Sets the maximum number of columns per row
     *
     * @param int $count
     * @return $this
     */
    public function setColumnCount(int $count): static;

    /**
     * Adds the column component and its definition as a DataEntryFormColumn
     *
     * @param DefinitionInterface|null    $definition
     * @param RenderInterface|string|null $component
     * @return $this
     */
    public function add(?DefinitionInterface $definition = null, RenderInterface|string|null $component = null): static;

    /**
     * Adds the specified DataEntryFormColumn to this DataEntryFormRow
     *
     * @param DataEntryFormColumn $column
     *
     * @return $this
     */
    public function addColumn(DataEntryFormColumn $column): static;

    /**
     * Renders and returns the HTML for this component
     *
     * @return string|null
     */
    public function render(): ?string;
}
