<?php

namespace NasuhTurkmen\Admin\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sso:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the sso package';

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initDatabase();

        $this->initAdminDirectory();
    }

    /**
     * Create tables and seed it.
     *
     * @return void
     */
    public function initDatabase()
    {
        $this->call('migrate');

        $userModel = config('sso.database.users_model');

       /* if ($userModel::count() == 0) {
            $this->call('db:seed', ['--class' => \NasuhTurkmen\Admin\Auth\Database\AdminTablesSeeder::class]);
        }*/
    }

    /**
     * Initialize the admAin directory.
     *
     * @return void
     */
    protected function initAdminDirectory()
    {
        $this->directory = config('sso.directory');

        if (is_dir($this->directory)) {
            $this->line("<error>{$this->directory} directory already exists !</error> ");

            return;
        }

        $this->makeDir('/');
        $this->line('<info>Admin directory was created:</info> '.str_replace(base_path(), '', $this->directory));

        $this->makeDir('Controllers');

        $this->createAuthController();

        $this->createBootstrapFile();
        $this->createRoutesFile();
    }


    /**
     * Create AuthController.
     *
     * @return void
     */
    public function createAuthController()
    {
        $authController = $this->directory.'/Controllers/AuthController.php';
        $contents = $this->getStub('AuthController');

        $this->laravel['files']->put(
            $authController,
            str_replace('DummyNamespace', config('sso.route.namespace'), $contents)
        );
        $this->line('<info>AuthController file was created:</info> '.str_replace(base_path(), '', $authController));
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createBootstrapFile()
    {
        $file = $this->directory.'/bootstrap.php';

        $contents = $this->getStub('bootstrap');
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Bootstrap file was created:</info> '.str_replace(base_path(), '', $file));
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createRoutesFile()
    {
        $file = $this->directory.'/routes.php';

        $contents = $this->getStub('routes');
        $this->laravel['files']->put($file, str_replace('DummyNamespace', config('sso.route.namespace'), $contents));
        $this->line('<info>Routes file was created:</info> '.str_replace(base_path(), '', $file));
    }

    /**
     * Get stub contents.
     *
     * @param $name
     *
     * @return string
     */
    protected function getStub($name)
    {
        return $this->laravel['files']->get(__DIR__."/stubs/$name.stub");
    }

    /**
     * Make new directory.
     *
     * @param string $path
     */
    protected function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }
}
