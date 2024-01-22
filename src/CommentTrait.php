<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

trait CommentTrait
{
    private array $comments = [];
    private array $styles = [];

    public function withComment(string ...$comment): self
    {
        $new = clone $this;
        $new->comments = $comment;
        return $new;
    }

    public function withStyle(Style ...$style): self
    {
        $new = clone $this;

        foreach ($style as $s) {
            $new->styles[] = $s->value;
        }

        return $new;
    }

    private function renderComment(string $indentation, array &$output): void
    {
        foreach ($this->comments as $comment) {
            $output[] = $indentation . '// ' . $comment;
        }

        if ($this->styles !== []) {
            $output[] = $indentation . '// [' . implode(', ', $this->styles) . ']';
        }
    }
}
