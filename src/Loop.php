<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

/** @link https://zenuml.com/docs/language-guide/loops/ */
final class Loop extends ConditionalBlock implements ItemInterface
{
    public function __construct(
        string $condition,
        private readonly LoopType $type = LoopType::Loop
    )
    {
        parent::__construct($condition);
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderBlock($this->type->value, $indentation, $output);
        return implode("\n", $output);
    }
}
