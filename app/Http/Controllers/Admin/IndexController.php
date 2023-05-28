<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View as ViewContract;

class IndexController extends Controller
{
    public function __invoke(): ViewContract
    {
        return View::make('admin.index');
    }
}
