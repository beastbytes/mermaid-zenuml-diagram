<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

use BeastBytes\Mermaid\CommentTrait;

/** https://zenuml.com/docs/language-guide/participant-and-group#participant-definition */
class Participant
{
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
        return $indentation
            . ($this->annotation === null ? '' : '@' . $this->annotation->name . ' ')
            . ($this->stereotype === '' ? '' : '<<' . $this->stereotype . '>> ')
            . $this->id
            . ($this->alias === '' ? '' : ' as ' . $this->alias)
        ;
    }
}
