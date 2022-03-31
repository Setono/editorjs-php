# PHP library for easing your development with the EditorJS

[![Latest Version][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Code Coverage][ico-code-coverage]][link-code-coverage]
[![Mutation testing][ico-infection]][link-infection]

## Installation

```bash
composer require setono/editorjs-php
```

## Usage

Here is a full example going from json to html output.

```php
<?php
$json = '...'; // this is the actual json you receive from the EditorJS instance

$hydrator = new CompositeHydrator();
$hydrator->add(new BlockHydrator());
$hydrator->add(new EmbedBlockHydrator());
$hydrator->add(new HeaderBlockHydrator());
$hydrator->add(new ImageBlockHydrator());
$hydrator->add(new ListBlockHydrator());
$hydrator->add(new ParagraphBlockHydrator());
$hydrator->add(new RawBlockHydrator());

$parser = new Parser($hydrator);
$parserResult = $parser->parse($json);

$blockRenderer = new CompositeBlockRenderer();
$blockRenderer->add(new DelimiterBlockRenderer());
$blockRenderer->add(new HeaderBlockRenderer());
$blockRenderer->add(new ImageBlockRenderer());
$blockRenderer->add(new ListBlockRenderer());
$blockRenderer->add(new ParagraphBlockRenderer());
$blockRenderer->add(new RawBlockRenderer());

$renderer = new Renderer($blockRenderer);
$html = $renderer->render($parserResult);
```
## EditorJS plugins supported
- [ ] [attaches](https://github.com/editor-js/attaches)
- [ ] [checklist](https://github.com/editor-js/checklist)
- [ ] [code](https://github.com/editor-js/code)
- [x] [delimiter](https://github.com/editor-js/delimiter)
- [x] [embed](https://github.com/editor-js/embed)
- [x] [header](https://github.com/editor-js/header)
- [x] [image](https://github.com/editor-js/image)
- [ ] [inline-code](https://github.com/editor-js/inline-code)
- [ ] [link](https://github.com/editor-js/link)
- [ ] [link-autocomplete](https://github.com/editor-js/link-autocomplete)
- [x] [list](https://github.com/editor-js/list)
- [ ] [marker](https://github.com/editor-js/marker)
- [ ] [nested-list](https://github.com/editor-js/nested-list)
- [x] [paragraph](https://github.com/editor-js/paragraph)
- [ ] [personality](https://github.com/editor-js/personality)
- [ ] [quote](https://github.com/editor-js/quote)
- [x] [raw](https://github.com/editor-js/raw)
- [ ] [simple-image](https://github.com/editor-js/simple-image)
- [ ] [table](https://github.com/editor-js/table)
- [ ] [underline](https://github.com/editor-js/underline)
- [ ] [warning](https://github.com/editor-js/warning)

A PR adding support for any of the above plugins would be awesome! Thank you :tada:

[ico-version]: https://poser.pugx.org/setono/editorjs-php/v/stable
[ico-license]: https://poser.pugx.org/setono/editorjs-php/license
[ico-github-actions]: https://github.com/Setono/editorjs-php/workflows/build/badge.svg
[ico-code-coverage]: https://codecov.io/gh/Setono/editorjs-php/branch/0.2.x/graph/badge.svg
[ico-infection]: https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FSetono%2Feditorjs-php%2F0.2.x

[link-packagist]: https://packagist.org/packages/setono/editorjs-php
[link-github-actions]: https://github.com/Setono/editorjs-php/actions
[link-code-coverage]: https://codecov.io/gh/Setono/editorjs-php
[link-infection]: https://dashboard.stryker-mutator.io/reports/github.com/Setono/editorjs-php/0.2.x
