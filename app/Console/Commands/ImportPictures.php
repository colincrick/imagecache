<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\PictureImporter\PictureImporter;

class ImportPictures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:pictures {csv_directory : Path to directory containing csv import files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import pictures from the csv files in the given directory';

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
     * @return mixed
     */
    public function handle()
    {
        $importer = new PictureImporter($this->argument('csv_directory'));
        $importer->run();
    }
}
