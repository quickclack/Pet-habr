<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewContract;

class HomeController extends Controller
{
    public function __invoke(): ViewContract
    {
        return View::make('welcome');
    }
}
