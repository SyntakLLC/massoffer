<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FormController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Form');
    }
}
