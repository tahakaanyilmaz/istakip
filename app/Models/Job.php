<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * Modifikasyonuna müsaade edilen sütunlar.
     */
    protected $fillable = [
        'job_user',
        'job_title',
        'job_description',
        'job_type',
        'job_location',
    ];

    /**
     * Veri sütunlarının tip kontrolü.
     */
    protected $casts = [
        'job_user' => 'int',
        'job_title' => 'string',
        'job_description' => 'string',
        'job_type' => 'string',
        'job_location' => 'string',
    ];

    public static function boot() {
        
        parent::boot();

        /**
         * Veri tabanına her kaydedilişte güvenlik önemli olarak
         * html içerebilecek verilerimizi önce dönüştürüyoruz sonra
         * boşlukları kaldırıyoruz.
         */
        static::saving(function($job) {
            
            $job->job_title = trim(htmlspecialchars($job->job_title));
            $job->job_description = trim(htmlspecialchars($job->job_description));

        });

    }
}
