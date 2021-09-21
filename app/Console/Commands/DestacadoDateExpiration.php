<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DestacadoDateExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destacado:date-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change expired date of destacados';

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
     * @return int
     */
    public function handle()
    {
        $destacados = new Destacados();
        $destacados->expireDay();
        return $destacados;
    }
}
