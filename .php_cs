<?php

$header = <<<EOF
This file is part of the mingyoung/dingtalk.

(c) mingyoung <mingyoungcheung@gmail.com>

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'header_comment' => ['header' => $header],
        'ordered_imports' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('vendor')
            ->in(__DIR__)
    )
;
