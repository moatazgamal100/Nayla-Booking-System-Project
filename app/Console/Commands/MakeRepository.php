<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        $modelName = $this->option('model');

        $this->createRepository($name, $modelName);

        $this->info("Repository {$name} created successfully!");

        return 0;
    }

    private function createRepository(string $name, ?string $modelName): void
    {
        $path = app_path('Repositories/' . $name . 'Repository.php');

        $stub = File::get(base_path('app\Repositories\HotelRepository.php'));

        $stub = str_replace(['DummyRepository', 'DummyModel'], [$name . 'Repository', $modelName], $stub);

        File::put($path, $stub);
    }
}
