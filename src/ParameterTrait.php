<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

trait ParameterTrait
{
    private array $parameters = [];

    /** @psalm-suppress PropertyTypeCoercion */
    public function withParameter(string ...$parameter): self
    {
        $new = clone $this;
        $new->parameters = $parameter;
        return $new;
    }

    public function renderParameters(): string
    {
        return ($this->parameters === [] ? '()' : '(' . implode(', ', $this->parameters) . ')');
    }
}
