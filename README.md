## CommonMark Break Tag Extension

This package allows break tags (`<br>`, `<br/>`, `<br />`) to be used in Markdown, while still allowing all other HTML input to be escaped or stripped.

## Install
This project can be installed via composer:

`composer require cradeq/commanmark-br-extension`

## Usage
```php
use Cradeq\CommonMark\BreakTagExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;

$environment->addExtension(new CommonMarkCoreExtension);
$environment->addExtension(new BreakTagExtension);
```