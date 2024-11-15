<?php

namespace Cradeq\CommonMark\BreakTagExtension\Tests;

use Cradeq\CommonMark\BreakTagExtension\BreakTagExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Renderer\HtmlRenderer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BreakTagTest extends TestCase {

    public function test_break_tag_is_filtered_away_without_extension(): void
    {
        $environment = new Environment([
            'html_input' => 'strip',
        ]);
        $environment->addExtension(new CommonMarkCoreExtension);

        $parser   = new MarkdownParser($environment);
        $renderer = new HtmlRenderer($environment);

        $document = $parser->parse('new<br>line');

        $html = (string) $renderer->renderDocument($document);

        $this->assertSame("<p>newline</p>\n", $html);
    }

    #[DataProvider('provideBreakTagData')]
    public function test_break_tag_is_allowed($string, $expected): void {
        $environment = new Environment([
            'html_input' => 'strip',
        ]);
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new BreakTagExtension);

        $parser   = new MarkdownParser($environment);
        $renderer = new HtmlRenderer($environment);

        $document = $parser->parse($string);

        $html = (string) $renderer->renderDocument($document);

        $this->assertSame($expected, $html);
    }

    public static function provideBreakTagData(): array {
        return [
            // Default behaviour
            // Single
            ["new<br>line", "<p>new<br>line</p>\n"],
            ["new<br/>line", "<p>new<br>line</p>\n"],
            ["new<br />line", "<p>new<br>line</p>\n"],

            // Multiple
            ["extra<br>new<br />line", "<p>extra<br>new<br>line</p>\n"],
            ["new<br><br>line", "<p>new<br><br>line</p>\n"],
            ["new<br /><br />line", "<p>new<br><br>line</p>\n"],

            // Start and end
            ["<br>newline", "<p><br>newline</p>\n"],
            ["newline<br>", "<p>newline<br></p>\n"],

            // As child node
            ["<div>extra<br>text</div>", ""],
            ["new<div>extra<br>text</div>line", "<p>newextra<br>textline</p>\n"],
            ["new<div extra<br>text>line", "<p>new&lt;div extra<br>text&gt;line</p>\n"],
            ["new<div extra<br>text>line</div>", "<p>new&lt;div extra<br>text&gt;line</p>\n"],
            ["new <div <br>>line</div>", "<p>new &lt;div <br>&gt;line</p>\n"],

            // Spaces
            ["new<br        />line", "<p>new<br>line</p>\n"],
            ["new<br\t/>line", "<p>new<br>line</p>\n"],

            // Invalid characters
            ["new<br a>line", "<p>newline</p>\n"],
            ["new<br href=''>line", "<p>newline</p>\n"],
            ["new<brr>line", "<p>newline</p>\n"],
        ];
    }
}