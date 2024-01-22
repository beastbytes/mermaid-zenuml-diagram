<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class TryCatch implements ItemInterface
{
    use CommentTrait;

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
        $this->renderComment($indentation, $output);

        $this
            ->try
            ->setType('try')
            ->renderBlock($indentation, $output)
        ;
        $this
            ->catch
            ->setType('catch')
            ->renderBlock($indentation, $output)
        ;
        $this
            ->finally
            ?->setType('finally')
            ->renderBlock($indentation, $output)
        ;

        return implode("\n", $output);
    }
}
