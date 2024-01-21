<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\ZenumlDiagram;

trait QuoteTrait
{
    private function quote(string $str): string
    {
        if (preg_match( '/^(\w+\s+)+\w+$/', $str)) {
            return '"' . $str . '"';
        }

        return $str;
    }
}
