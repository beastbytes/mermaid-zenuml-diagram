<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class CreateMessage extends Block
{
    use CommentTrait;
    use ParameterTrait;

    public function __construct(private readonly Participant $participant)
    {
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderComment($indentation, $output);

        $message = $indentation
            . 'new '
            . $this->participant->getId()
            . $this->renderParameters()
        ;

        if ($this->hasItems()) {
            $this->type = $message;
            $this->renderBlock($indentation, $output);
        } else {
            $output[] =  $message;
        }

        return implode("\n", $output);
    }
}
