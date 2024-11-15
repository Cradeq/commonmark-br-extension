<?php

namespace Cradeq\CommonMark\BreakTagExtension;

use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

class BreakTagParser implements InlineParserInterface
{

    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex('<br\s*\/?>');
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $inlineContext->getCursor()->advanceBy($inlineContext->getFullMatchLength());
        $inlineContext->getContainer()->appendChild(new BreakTag);

        return true;
    }
}