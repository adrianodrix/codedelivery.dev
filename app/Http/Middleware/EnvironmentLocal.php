<?php

namespace CodeDelivery\Http\Middleware;


use Closure;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class EnvironmentLocal
{
    const PATH_LOG = '/logs/sql.log';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Methods only Environment local
         *
         */
        if (\App::environment('local')) {
            $this->logSQL();
            $this->listRoutes();
            $this->showLogSQL();
        }

        return $next($request);
    }

    /**
     * Display all SQL executed in Eloquent
     * in a storage/logs/sql.log file
     *
     */
    public function logSQL()
    {
        \DB::listen(function ($sql, $bindings, $time) {
            $xsql = explode("?", $sql);
            $nsql = "";
            for ($i = 0; $i < count($xsql) - 1; $i++) {
                $nsql .= $xsql[$i] . $bindings[$i];
            }
            $view_log = new Logger("SQL");
            $view_log->pushHandler(
                new StreamHandler(storage_path() . self::PATH_LOG)
            );
            $view_log->addInfo($nsql ?: $sql);
        });
    }

    /**
     * Display all routes in browser
     *
     */
    public function listRoutes()
    {
        \Route::get('routes', function () {
            \Artisan::call('route:list');
            return "<pre>" . \Artisan::output();
        });
    }

    public function showLogSQL()
    {
        \Route::get('log-sql', function () {
            return "<pre>" . \File::get(storage_path() . self::PATH_LOG );
        });
    }
}

