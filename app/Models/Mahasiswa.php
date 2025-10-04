<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Clas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Prompts\Table;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = [
        'nama',
        'nim',
        'kelas_id'
    ];

    public function Kelas()
    {
        return $this->BelongsTo(Clas::class);
    }
}
