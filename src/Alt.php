<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class Alt implements ItemInterface
{
    /** @var list<ConditionalBlock> $blocks */
    private array $blocks = [];
    private ?Block $elseBlock = null;

    public function __construct(ConditionalBlock $block)
    {
        $this->blocks[] = $block;
    }

    public function withElse(Block $elseBlock): self
    {
        $new = clone $this;
        $new->elseBlock = $elseBlock;
        return $new;
    }

    public function withElseIf(ConditionalBlock ...$block): self
    {
        $new = clone $this;
        $new->blocks = array_merge($new->blocks, $block);
        return $new;
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];

        array_shift($this->blocks)?->renderBlock('if', $indentation, $output);

        foreach ($this->blocks as $block) {
            $block->renderBlock('else if', $indentation, $output);
        }

        $this->elseBlock?->renderBlock('else', $indentation, $output);

        return preg_replace('/}\s+else/', '} else', implode("\n", $output));
    }
}
