<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string model модель
 * @property string name имя
 * @property string format формат
 * @property int size размер файла
 * @property int model_id ID модели
 * @property string target цель
 */

class Media extends Model
{
    use HasFactory;

    protected $table = "medias";

    public function saveFile($image)
    {
        $this->model = 'модель';
        $this->name = $image->originalName;
        $this->format = $image->mimeType;
        $this->size = $image->size;
        $this->model_id = 12;
        $this->target = 'цель';
        $this->save();
    }

    public function getFile()
    {

    }
}
