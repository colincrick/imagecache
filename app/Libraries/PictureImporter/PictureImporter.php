<?php

namespace App\Libraries\PictureImporter;

use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class PictureImporter
{
    /**
     * @var
     */
    private $csv_directory;

    /**
     * PictureImporter constructor.
     * @param $csv_directory
     */
    public function __construct($csv_directory)
    {
        $this->csv_directory = $csv_directory;
    }

    /**
     * Import all csv files in the directory
     */
    public function run()
    {
        if (File::exists($this->csv_directory))
        {
            foreach (new \DirectoryIterator($this->csv_directory) as $fileInfo)
            {
                if ($fileInfo->getExtension() == 'csv')
                {
                    Excel::import(new PictureImport, $fileInfo->getPathname());
                }
            }
        }
    }
}