<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            // $query->sql
            // $query->bindings
            // $query->time
            $sql = $query->sql;
            if (!Arr::isAssoc($query->bindings)) {
                foreach ($query->bindings as $key => $value) {
                    if ($value instanceof \DateTimeInterface) {
                        $value = $value->format('Y-m-d H:i:s');
                    } elseif (is_bool($value)) {
                        $value = (int)$value;
                    }
                    $sql = Str::replaceFirst('?', "'{$value}'", $sql);
                }
            }

            Log::debug(sprintf('[%s] %s', $query->time, $sql));
        });
    }
}
