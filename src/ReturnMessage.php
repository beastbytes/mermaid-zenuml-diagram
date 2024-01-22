<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

/** @link https://zenuml.com/docs/language-guide/messages */
final class ReturnMessage implements ItemInterface
{
    use CommentTrait;
    use QuoteTrait;

    public function __construct(private readonly AsyncMessage|string $value)
    {
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderComment($indentation, $output);

        $output[] = $indentation
            . (is_string($this->value)
                ? 'return ' . $this->quote($this->value)
                : '@return ' . $this->value->render('')
            )
        ;

        return implode("\n", $output);
    }
}
