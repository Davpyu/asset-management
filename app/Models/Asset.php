<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'qty',
        'brand'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function output()
    {
        return [
            'id'            => $this->id,
            'kode_aset'     => $this->code,
            'nama_aset'     => $this->name,
            'jumlah'        => $this->qty,
            'merk'          => $this->brand
        ];
    }
}
