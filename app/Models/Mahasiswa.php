<?php 
namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 

class Mahasiswa extends Model 
{ 
    protected $table = 'mahasiswa'; 
    protected $fillable = ['nama', 'nim', 'alamat']; 

    public function nilai() 
    { 
        return $this->hasMany(Nilai::class); 
    } 
}
