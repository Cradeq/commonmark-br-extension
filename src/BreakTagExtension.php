<?php

namespace Cradeq\CommonMark\BreakTagExtension;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ExtensionInterface;

final class BreakTagExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addInlineParser(new BreakTagParser, 50);
        $environment->addRenderer(BreakTag::class, new BreakTagRenderer);
    }
}
