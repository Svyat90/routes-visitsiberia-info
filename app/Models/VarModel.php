<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VarModel
 *
 * @property int $id
 * @property string $val_ru
 * @property string $val_en
 */
class VarModel extends Model
{

    /**
     * @var string
     */
    protected $table = 'vars';

    /**
     * @var string[]
     */
    protected $fillable = [
        'val_ru', 'val_en'
    ];

}
