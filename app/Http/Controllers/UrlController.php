<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function create()
    {
        return view('urls.create');
    }

    public function shorten(Request $request)
    {

        session()->forget('shortUrl');

        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortUrl = Str::random(6);

        while (Url::where('short_url', $shortUrl)->exists()) {
            $shortUrl = Str::random(6);
        }

        Url::create([
            'user_id' => auth()->id() ? auth()->id() : null,
            'original_url' => $request->input('original_url'),
            'short_url' => $shortUrl,
        ]);

        session([
            'shortUrl' => $shortUrl,
            'originalUrl' => $request->input('original_url'),
        ]);

        return redirect()->route('home')->with('success', 'URL shortened successfully!');
    }

    public function redirect($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->firstOrFail();

        $url->increment('clicks');

        return redirect($url->original_url);
    }

    public function delete($id)
    {
        $url = Url::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $url->delete();

        return redirect()->back()->with('success', 'URL deleted successfully!');
    }
}
