<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PencapaianController extends Controller
{
    /**
     * Halaman Penghargaan (type = workshop)
     */
    public function penghargaan()
    {
        $events = Event::where('type', 'workshop')
            ->where('is_published', true)
            ->orderBy('date', 'desc')
            ->get();

        return view('penghargaan', compact('events'));
    }

    /**
     * Halaman Sertifikat (type = promo)
     */
    public function sertificate()
    {
        $events = Event::where('type', 'promo')
            ->where('is_published', true)
            ->orderBy('date', 'desc')
            ->get();

        return view('sertificate', compact('events'));
    }

    /**
     * Halaman Daftar Event (type = launch)
     */
    public function event()
    {
        $events = Event::where('type', 'launch')
            ->where('is_published', true)
            ->orderBy('date', 'desc')
            ->get();

        return view('event', compact('events'));
    }
}
