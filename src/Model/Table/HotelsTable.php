<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class HotelsTable extends Table
{

    public function initialize(array $config):void
    {
        // Specifying relationships
        $this->hasMany('Rooms');
    }

    // Validating the uploaded files, this ensures no harmful files get uploaded
	public function validationDefault(Validator $validator): Validator
	{
		return $validator
            ->allowEmptyFile('image')
            ->add( 'image', [
            'mimeType' => [
                'rule' => [ 'mimeType', [ 'image/jpg', 'image/png', 'image/jpeg' ] ],
                'message' => 'Please upload only jpg and png.',
            ],
        ])
            ->add('image_file', 'filename', [
            'rule' => function (UploadedFileInterface $file) {
                // filename must not be a path
                $filename = $file->getClientFilename();
                if (strcmp(basename($filename), $filename) === 0) {
                    return true;
                }

                return false;
            }
        ]);
	}
}
