<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RoomsTable extends Table
{

    public function initialize(array $config):void
    {
        $this->hasOne('RoomCategory', ['className' => 'RoomsCategories']);
        $this->hasMany('Bookings');
        $this->belongsTo('Hotels');
    }
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
