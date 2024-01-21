<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

enum LoopType: string
{
    case For = 'for';
    case Foreach = 'forEach';
    case Loop = 'loop';
    case While = 'while';
}
