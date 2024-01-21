<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class TryCatch implements ItemInterface
{
    public function __construct(
        private readonly Block $try,
        private readonly Block $catch,
        private readonly ?Block $finally = null
    )
    {
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];

        $this->try->renderBlock('try', $indentation, $output);
        $this->catch->renderBlock('catch', $indentation, $output);
        $this->finally?->renderBlock('finally', $indentation, $output);

        return implode("\n", $output);
    }
}
