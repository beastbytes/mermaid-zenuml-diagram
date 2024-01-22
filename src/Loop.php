<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

/** @link https://zenuml.com/docs/language-guide/loops/ */
final class Loop extends ConditionalBlock
{
    use CommentTrait;

    public function __construct(string $condition, LoopType $type = LoopType::Loop)
    {
        parent::__construct($condition);
        $this->type = $type->value;
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderComment($indentation, $output);
        $this->renderBlock($indentation, $output);
        return implode("\n", $output);
    }
}
