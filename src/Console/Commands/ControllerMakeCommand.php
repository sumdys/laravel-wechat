<?php

namespace Sumdy\LaravelWechat\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Routing\Console\ControllerMakeCommand as Command;

class ControllerMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'swechat-make:controller';
    protected $name = 'swechat-make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new swechat controller class';

    protected $namespace = 'Sumdy\LaravelWechat\Http\Controllers';


    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        return $this->namespace.'\\'.$name;
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return app()->basePath().'/vendor/sumdy/laravel-wechat/src/'.str_replace('\\', '/', $name).'.php';
    }

    protected function rootNamespace()  
    {
        return 'Sumdy\LaravelWechat\\';
    }
}
