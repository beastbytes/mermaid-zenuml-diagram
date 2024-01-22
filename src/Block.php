<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

use BeastBytes\Mermaid\RenderItemsTrait;

class Block implements ItemInterface
{
    use CommentTrait;
    use ItemTrait;
    use RenderItemsTrait;

    protected string $type = '';

    /** @internal */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderComment($indentation, $output);
        $this->renderBlock($indentation, $output);
        return implode("\n", $output);
    }

    /* @internal */
    public function renderBlock(string $indentation, array &$output): void
    {
        $output[] = $indentation . $this->type . ' {';
        $this->renderItems($this->items, $indentation, $output);
        $output[] = $indentation . '}';
    }
}
