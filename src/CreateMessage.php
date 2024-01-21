<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class CreateMessage extends Block implements ItemInterface
{
    use ParameterTrait;

    public function __construct(private readonly Participant $participant)
    {
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $message = $indentation
            . 'new '
            . $this->participant->getId()
            . $this->renderParameters()
        ;

        if ($this->hasItems()) {
            $output = [];
            $this->renderBlock($message, $indentation, $output);
            return implode("\n", $output);
        }

        return $message;
    }
}
