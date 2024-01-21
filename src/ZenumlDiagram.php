<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\MermaidInterface;
use BeastBytes\Mermaid\RenderItemsTrait;
use BeastBytes\Mermaid\TitleTrait;
use Stringable;

final class ZenumlDiagram implements MermaidInterface, Stringable
{
    use ItemTrait;
    use RenderItemsTrait;
    use TitleTrait;

    private const TYPE = 'zenuml';

    /** @var list<Group|Participant> */
    private array $participants = [];

    public function __toString(): string
    {
        return $this->render();
    }

    public function addParticipant(Group|Participant ...$participant): self
    {
        $new = clone $this;
        $new->participants = array_merge($new->participants, $participant);
        return $new;
    }

    public function withParticipant(Group|Participant ...$participant): self
    {
        $new = clone $this;
        $new->participants = $participant;
        return $new;
    }

    public function render(): string
    {
        $output = [];

        $output[] = self::TYPE;

        if ($this->title !== '') {
            $output[] = Mermaid::INDENTATION . 'title ' . $this->title;
        }

        foreach ($this->participants as $participant) {
            $output[] = $participant->render(Mermaid::INDENTATION);
        }

        $this->renderItems($this->items, '', $output);

        return Mermaid::render($output);
    }
}