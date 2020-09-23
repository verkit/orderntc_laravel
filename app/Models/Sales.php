<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'data_sales';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Disable timestamps
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * Mendapatkan data user dari pelanggan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
