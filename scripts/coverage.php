#!/usr/bin/env php
<?php

declare(strict_types=1);

const MIN_LINE_COVERAGE = 57.0;

$phpBinary = PHP_BINARY;
$phpVersion = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;

if (!extension_loaded('pcov') && !extension_loaded('xdebug')) {
    fwrite(STDERR, <<<TEXT
No code coverage driver available.

PHPUnit needs the PCOV or Xdebug PHP extension to collect coverage.

Install PCOV (recommended, fast):

  Ubuntu/Debian:
    sudo apt install php{$phpVersion}-pcov

  Fedora:
    sudo dnf install php-pcov

  macOS (Homebrew):
    pecl install pcov

Then verify:
  {$phpBinary} -m | grep -E 'pcov|xdebug'

And run again:
  composer test:coverage

HTML report (optional):
  vendor/bin/phpunit --coverage-html build/coverage

CI runs coverage with PCOV on PHP 8.3 (see .github/workflows/tests.yml).

TEXT);
    exit(1);
}

$args = array_slice($argv, 1);
$command = array_merge(
    [__DIR__ . '/../vendor/bin/phpunit', '--coverage-text'],
    $args,
);

ob_start();
passthru(implode(' ', array_map('escapeshellarg', $command)), $exitCode);
$output = (string) ob_get_clean();
fwrite(STDOUT, $output);

if ($exitCode !== 0) {
    exit($exitCode);
}

if (!preg_match('/^\s*Lines:\s+([\d.]+)%/m', $output, $matches)) {
    fwrite(STDERR, "Could not parse line coverage from PHPUnit output.\n");
    exit(1);
}

$lineCoverage = (float) $matches[1];
if ($lineCoverage < MIN_LINE_COVERAGE) {
    fwrite(STDERR, sprintf(
        "Line coverage %.2f%% is below the %.2f%% threshold.\n",
        $lineCoverage,
        MIN_LINE_COVERAGE,
    ));
    exit(1);
}

exit(0);
