<?php

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

/**
 * Запустить команду в фоновом режиме
 * @param string $command Команда
 * @param array $data Параметры
 * @return void
 */
function runArtisanCommandInBackground(string $command, array $data = []): void
{
    $phpPath = (new PhpExecutableFinder())->find();
    $process = new Process([$phpPath, base_path('artisan'), $command, ...$data]);
    $process->setoptions(['create_new_console' => true]);
    $process->start();
}
