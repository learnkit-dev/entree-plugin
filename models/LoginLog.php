<?php namespace LearnKit\Entree\Models;

use Model;

/**
 * Model
 */
class LoginLog extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'learnkit_entree_login_logs';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    protected $jsonable = [
        'login_attributes',
    ];

    protected $fillable = [
        'login_attributes',
    ];
}
