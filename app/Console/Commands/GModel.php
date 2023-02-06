<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:GModel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Default Model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @param $rootNamespace
     * @return int
     */
    protected function handle($rootNamespace)
    {
        return "{$rootNamespace}\Models";
    }
}
