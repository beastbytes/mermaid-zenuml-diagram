<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

use Stringable;

/** @link https://zenuml.com/docs/language-guide/messages */
final class AsyncMessage implements ItemInterface
{
    /**
     * @param string $message Message content
     * @param Participant $participant1 The Sender or the Recipient if in a CreateMessage or SyncMessage and $participant2 is NULL
     * @param ?Participant $participant2 The Recipient
     */
    public function __construct(
        private readonly string $message,
        private readonly Participant $participant1,
        private readonly ?Participant $participant2 = null
    )
    {
    }

    /** @internal */
    public function render(string $indentation): string
    {
        return $indentation
            . $this->participant1->getId()
            . ($this->participant2 === null ? '' : ' -> ' . $this->participant2->getId())
            . ': '
            . $this->message
        ;
    }
}
