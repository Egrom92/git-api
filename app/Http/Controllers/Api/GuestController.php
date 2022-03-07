<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Testing\Browser\Pages\Page;
use OptimistDigital\NovaSettings\NovaSettings;

class GuestController extends Controller
{
    static function getGuest($slug, Guest $guest)
    {
        return $guest->where('slug', $slug)->first();
    }
}
