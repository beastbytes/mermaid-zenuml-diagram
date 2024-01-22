<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

class ConditionalBlock extends Block
{
    use QuoteTrait;

    public function __construct(private readonly string $condition)
    {
    }

    /* @internal */
    public function renderBlock(string $indentation, array &$output): void
    {
        $this->type .= ($this->condition === '' ? '' : ' (' . $this->quote($this->condition) . ')');
        parent::renderBlock($indentation, $output);
    }
}
