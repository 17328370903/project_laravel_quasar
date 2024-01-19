<?php

namespace Tw\Admin\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangMiddleware
{

    protected array $languages = [
        'en', 'zh_CN'
    ];

    public function handle($request, Closure $next)
    {
        $lang = $request->header('lang') ?? 'en';
        if (!in_array($lang, $this->languages)) {
            $lang = 'en';
        }
        App::setLocale($lang);
        return $next($request);
    }

}
