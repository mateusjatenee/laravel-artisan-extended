<?php

namespace Mateusjatenee\LaravelArtisanExtended\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeTransformerCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */

    protected $signature = 'make:transformer {name} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new transformer class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Transformer';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/transformer.stub';
    }

    protected function getModel()
    {
        $model = $this->argument('model');

        if (Str::contains($model, '/')) {
            $model = str_replace('/', '\\', $model);
        }

        return $model;
    }

    protected function getVariable()
    {
        $model = $this->getModel();

        if (Str::contains($model, '/')) {
            $model = str_replace('/', '\\', $model);
        }

        $model = explode('\\', $model);

        return strtolower(
            end($model)
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Transformers';
    }

    protected function replaceModel(&$stub, $name)
    {

        $stub = str_replace('DummyModel', $name, $stub);

        $stub = str_replace('DummyVariable', $this->getVariable(), $stub);

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name . 'Transformer');

        return str_replace('DummyClass', $class, $stub);
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceModel($stub, $this->getModel())
            ->replaceClass($stub, $name);
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $model = $this->getModel();

        $name = $this->parseName($this->getNameInput());

        $file_name = $name . 'Transformer';

        $path = $this->getPath($file_name);

        if ($this->alreadyExists($this->getNameInput() . 'Transformer')) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $model = $this->getModel();

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type . ' created successfully.');
    }

}
