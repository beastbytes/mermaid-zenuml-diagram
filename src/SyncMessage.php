<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

/** @link https://zenuml.com/docs/language-guide/messages */
final class SyncMessage extends Block
{
    use CommentTrait;
    use ParameterTrait;

    private string $returnType = '';
    private string $returnValue = '';

    /**
     * @param string $message Message content
     * @param ?Participant $participant1 The Sender or the Recipient if in a CreateMessage or SyncMessage and
     *     $participant2 is NULL. If NULL the message is to self
     * @param ?Participant $participant2 The Recipient
     */
    public function __construct(
        private readonly string $message,
        private readonly ?Participant $participant1 = null,
        private readonly ?Participant $participant2 = null
    )
    {
    }

    public function withReturn(string $value, string $type = ''): self
    {
        $new = clone $this;
        $new->returnValue = $value;
        $new->returnType = $type;
        return $new;
    }

    /** @internal */
    public function render(string $indentation): string
    {
        $output = [];
        $this->renderComment($indentation, $output);

        $return = '';

        if ($this->returnValue !== '') {
            if ($this->returnType !== '') {
                $return .= $this->returnType . ' ';
            }

            $return .= $this->returnValue . ' = ';
        }

        if ($this->participant1 !== null) {
            if ($this->participant2 === null) {
                $participants = $this->participant1->getId();
            } else {
                $participants = $this->participant1->getId()
                    . ' -> '
                    . $this->participant2->getId();
            }

            $participants .= '.';
        } else {
            $participants = '';
        }

        $message = $return
            . $participants
            . $this->message
            . $this->renderParameters()
        ;

        if ($this->hasItems()) {
            $this->setType($message);
            $this->renderBlock($indentation, $output);
        } else {
            $output[] = $indentation . $message;
        }

        return implode("\n", $output);
    }
}
