<?php

namespace Cradeq\CommonMark\BreakTagExtension;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Xml\XmlNodeRendererInterface;

final class BreakTagRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param Marker $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        BreakTag::assertInstanceOf($node);

        return '<br>';
    }

    public function getXmlTagName(Node $node): string
    {
        return 'br';
    }

    public function getXmlAttributes(Node $node): array
    {
        return [];
    }
}
