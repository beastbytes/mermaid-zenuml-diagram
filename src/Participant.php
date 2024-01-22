<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

/** https://zenuml.com/docs/language-guide/participant-and-group#participant-definition */
class Participant
{
    use CommentTrait;

    public function __construct(
        private readonly string $id,
        private readonly string $alias = '',
        private readonly ?Annotation $annotation = null,
        private readonly string $stereotype = ''
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderComment($indentation, $output);

        $output[] = $indentation
            . ($this->annotation === null ? '' : '@' . $this->annotation->name . ' ')
            . ($this->stereotype === '' ? '' : '<<' . $this->stereotype . '>> ')
            . $this->id
            . ($this->alias === '' ? '' : ' as ' . $this->alias)
        ;

        return implode("\n", $output);
    }
}
