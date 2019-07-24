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
        // find the picture or create a new one
        $picture = Picture::firstOrNew([
            'picture_title' => $row['picture_title']
        ]);

        // if the picture is new, or the url has changed, or the picture exists but has no filename (previously failed download)
        // then download the image content
        if ($row['picture_url'] != $picture->picture_url || !$picture->picture_filename)
        {
            // save only if successfully downloaded (dont overwrite a working filename with a failed one)
            if ($image = $this->getPicture($row['picture_url']))
            {
                $filename = md5($picture->picture_title).'.jpg';
                $picture->picture_filename = $filename;
                file_put_contents(config('app.pictures_directory').$filename, $image);
            }
        }

        // fill the url and description
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

    /**
     * Get picture content from url
     * @param $picture_url
     * @return bool|false|string
     */
    private function getPicture($picture_url)
    {
        try {
            $headers = get_headers($picture_url);

            if (substr($headers[0], 9, 3) == '200')
            {
                return file_get_contents($picture_url);
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}