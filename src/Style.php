<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

enum Style:string
{
    case Bold = 'font-bold';
    case Italic = 'italic';
    case LineThrough = 'line-through';
    case Underline = 'underline';
}
