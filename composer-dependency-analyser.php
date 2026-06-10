<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration())
    // PHPUnit is provided by the setono/code-quality-pack
    ->ignoreErrorsOnPackage('phpunit/phpunit', [ErrorType::SHADOW_DEPENDENCY])
;
