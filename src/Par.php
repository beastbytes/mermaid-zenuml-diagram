<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

final class Par extends Block
{
    private const TYPE = 'par';

    public function __construct()
    {
        $this->type = self::TYPE;
    }
}
