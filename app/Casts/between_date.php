<?php
namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class between_date implements CastsAttributes
{
    private $start_date, $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function get($model, $key, $value, $attributes)
    {
        return $value;
    }

    /**
     * Verinin belirtilen tarih aralığında bulunup bulunmadığını
     * kontrol eder.
     */
    public function set($model, $key, $value, $attributes)
    {
        /**
         * TODO: Burası düzenlenecek.
         */
        $p_start_date = strtotime(preg_match('@\$[a-zA-Z0-9_]+)@', $this->start_date) ? $attributes->{$this->start_date} : $this->start_date);
        $p_end_date = strtotime(preg_match('@\$[a-zA-Z0-9_]+@', $this->end_date) ? $attributes->{$this->end_date} : $this->end_date);
        $p_value = strtotime($value);

        if ($p_value >= $p_start_date && $p_value <= $p_end_date)
            return $value;
        else
            throw \InvalidArgumentException('Invalid date.');
    }
}