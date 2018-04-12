<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handlePenetapanDosbing(Request $request) {
        $request->keys()
    }

    private function validateTopik(array $topic) {
        return Validator::make($topic, [
            'judul' => 'required|string|max:255',
            'keilmuan' => 'required|string|max:255',
            'calon_pembimbing1' => 'required|integer',
            'calon_pembimbing2' => 'nullable|integer',
            'calon_'
        ]);
    }
}
