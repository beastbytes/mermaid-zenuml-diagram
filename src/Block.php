<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

use BeastBytes\Mermaid\RenderItemsTrait;

class Block
{
    use ItemTrait;
    use RenderItemsTrait;

    /* @internal */
    public function renderBlock(string $type, string $indentation, array &$output): void
    {
        $output[] = $indentation . $type . ' {';
        $this->renderItems($this->items, $indentation, $output);
        $output[] = $indentation . '}';
    }
}
