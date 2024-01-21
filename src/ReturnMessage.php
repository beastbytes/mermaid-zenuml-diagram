<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class ReturnMessage implements ItemInterface
{
    use QuoteTrait;

    public function __construct(private readonly AsyncMessage|string $value)
    {
    }

    /** @internal */
    public function render(string $indentation): string
    {
        if (is_string($this->value)) {
            return $indentation . 'return ' . $this->quote($this->value);
        }

        return $indentation . '@return ' . $this->value->render('');
    }
}
