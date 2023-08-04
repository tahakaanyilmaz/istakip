<?php
namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class in implements CastsAttributes
{
    private $relatedModel, $relatedColumn;

    public function __construct($relatedModel, $relatedColumn)
    {
        $this->relatedModel = $relatedModel;
        $this->relatedColumn = $relatedColumn;
    }

    public function get($model, $key, $value, $attributes)
    {
        return $value;
    }

    /**
     * Verinin karşı tabloda bulunup bulunmadığını
     * kontrol eder.
     */
    public function set($model, $key, $value, $attributes)
    {
        $model = sprintf('\App\Models\%s', $this->relatedModel);

        if ($model::where($this->relatedColumn, $value)->first())
            return $value;
        else
            throw new \InvalidArgumentException(sprintf('There is no related value in the %s table.', $this->relatedModel));
    }
}