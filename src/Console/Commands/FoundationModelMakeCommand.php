<?php

namespace Samsin33\Foundation\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;

class FoundationModelMakeCommand extends ModelMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'foundation:make-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Foundation model class';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        parent::handle();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__.'/../stubs/foundation-model.stub';
    }
}
