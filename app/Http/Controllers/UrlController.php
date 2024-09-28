<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Url;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function create()
    {
        return view('urls.create');
    }

    public function shorten(Request $request, UrlShortenerService $service)
    {

        session()->forget('shortUrl');

        $request->validate([
            'original_url' => 'required|url',
        ]);

        $result = $service->shortenUrl($request->input('original_url'));

        Url::create([
            'user_id' => auth()->id(),
            'original_url' => $result['original_url'],
            'short_url' => $result['short_url'],
        ]);

        session([
            'shortUrl' => $result['short_url'],
            'originalUrl' => $result['original_url'],
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
