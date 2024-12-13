<?php

namespace NasuhTurkmen\Admin\Console;

use Illuminate\Console\Command;

class UninstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sso:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall the sso package';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->confirm('Are you sure to uninstall nt-sso?')) {
            return;
        }

        $this->removeFilesAndDirectories();

        $this->line('<info>Uninstalling nt-sso!</info>');
    }

    /**
     * Remove files and directories.
     *
     * @return void
     */
    protected function removeFilesAndDirectories()
    {
        $this->laravel['files']->deleteDirectory(config('sso.directory'));
        $this->laravel['files']->deleteDirectory(public_path('vendor/nasuhturkmen/'));
        $this->laravel['files']->delete(config_path('admin.php'));
    }
}
