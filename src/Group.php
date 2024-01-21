<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

use BeastBytes\Mermaid\RenderItemsTrait;

/** https://zenuml.com/docs/language-guide/participant-and-group#participant-group */
final class Group
{
    use RenderItemsTrait;

    private array $participants = [];

    public function __construct(private readonly string $name)
    {
    }

    public function addParticipant(Participant ...$participant): self
    {
        $new = clone $this;
        $new->participants = array_merge($new->participants, $participant);
        return $new;
    }

    public function withParticipant(Participant ...$participant): self
    {
        $new = clone $this;
        $new->participants = $participant;
        return $new;
    }

    public function render(string $indentation): string
    {
        $output = [];

        $output[] = $indentation . 'group ' . $this->name . ' {';
        $this->renderItems($this->participants, '', $output);
        $output[] = '}';

        return $indentation . implode("\n$indentation", $output);
    }
}
