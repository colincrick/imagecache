<?php

namespace App\Libraries\PictureImporter;

use App\Models\Picture;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PictureImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure
{
    /**
     * Turn an imported row into a model
     * @param array $row
     * @return Picture
     */
    public function model(array $row)
    {
        $picture = Picture::firstOrNew([
            'picture_title' => $row['picture_title']
        ]);

        $picture->picture_url = $row['picture_url'];
        $picture->picture_description = $row['picture_description'];

        return $picture;
    }

    /**
     * Validation rules
     * @return array
     */
    public function rules(): array
    {
        return [
            'picture_title' => 'required',
            'picture_url'   => 'required',
        ];
    }

    /**
     * Process failed rows
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        // Do nothing with invalid rows
    }
}