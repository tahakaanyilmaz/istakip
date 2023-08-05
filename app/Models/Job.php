<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'job_title',
        'job_short_description',
        'job_description',
        'job_start_date',
        'job_end_date',
        'job_total_price',
        'job_payment_method',
        'job_status',
    ];

    protected $rules = [
        'customer' => 'required|exists:users,id',
        'job_title' => 'required|string|min:10|max:150',
        'job_short_description' =>'required|string|min:10|max:150',
        'job_description' =>'required|string|min:10|max:150',
        'job_start_date' =>'required|date|App\Casts\between_date:today,$job_end_date - 1 days',
        'job_end_date' =>'required|date|App\Casts\between_date:$job_start_date + 1 days',
        'job_total_price' => 'required|float|min:0|max:999999999',
        'job_payment_method' =>'required|in:start,end,step-by-step',
        'job_status' =>'required|in:in-process,awaiting,completed',
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
