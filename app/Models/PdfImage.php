<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfImage extends Model
{
    use HasFactory;

  //  protected $fillable = ['pdf_id', 'image_path', 'page_number'];
    // Spécifier les champs que tu peux massivement assigner
    protected $fillable = ['pdf_id', 'image_path', 'page_number'];
    public function pdf()
    {
        return $this->belongsTo(Pdf::class);
    }
}
