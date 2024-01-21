<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class Par extends Block implements ItemInterface
{
    private const TYPE = 'par';

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderBlock(self::TYPE, $indentation, $output);
        return implode("\n", $output);
    }
}
