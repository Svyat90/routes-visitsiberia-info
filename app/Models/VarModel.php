<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VarModel
 *
 * @mixin IdeHelperVarModel
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
