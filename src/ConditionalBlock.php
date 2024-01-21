<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

use BeastBytes\Mermaid\RenderItemsTrait;

class ConditionalBlock extends Block
{
    use QuoteTrait;

    public function __construct(private readonly string $condition)
    {
    }

    /* @internal */
    public function renderBlock(string $type, string $indentation, array &$output): void
    {
        parent::renderBlock(
            $type . ($this->condition === '' ? '' : ' (' . $this->quote($this->condition) . ')'),
            $indentation,
            $output
        );
    }
}
