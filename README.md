## CommonMark Break Tag Extension

This package allows HTML break tags (`<br>`, `<br/>`, `<br />`) to be used in Markdown, while still escaping or stripping all other HTML input.

## Install
This project can be installed via composer:

`composer require cradeq/commonmark-br-extension`

## Usage
```php
use Cradeq\CommonMark\BreakTagExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;

$environment = new Environment();
$environment->addExtension(new CommonMarkCoreExtension);
$environment->addExtension(new BreakTagExtension);
```
