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

    public function show($id)
    {
        $url = Url::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$url) {
            return response()->json(['error' => 'URL not found or unauthorized!'], 404);
        }

        return response()->json($url);
    }

    public function update(Request $request)
    {
        $url = Url::where('id', $request->input('id'))->where('user_id', auth()->id())->first();

        if (!$url) {
            return redirect()->back()->with('error', 'URL not found or unauthorized!');
        }

        $url->update([
            'original_url' => $request->input('original_url')
        ]);

        return redirect()->back()->with('success', 'URL updated successfully!');
    }

    public function delete($id)
    {
        $url = Url::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$url) {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }

        $url->delete();

        return redirect()->route('dashboard')->with('success', 'URL deleted successfully!');
    }

    // API methods
    public function shortenApi(Request $request, UrlShortenerService $service)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $result = $service->shortenUrl($request->input('original_url'));

        $url = Url::create([
            'original_url' => $result['original_url'],
            'short_url' => $result['short_url'],
        ]);

        return response()->json([
            'short_url' => route('url.redirect', $url->short_url),
        ]);
    }

    public function getOriginalUrlApi($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->firstOrFail();

        return response()->json([
            'original_url' => $url->original_url,
        ]);
    }

    public function updateApi(Request $request)
    {
        $url = Url::where('id', $request->input('id'))->first();

        if (!$url) {
            return response()->json(['error' => 'URL not found or unauthorized!'], 404);
        }

        $url->update([
            'original_url' => $request->input('original_url')
        ]);

        return response()->json(['message' => 'URL updated successfully']);
    }

    public function deleteApi($id)
    {
        $url = Url::where('id', $id)->first();

        if (!$url) {
            return response()->json(['error' => 'URL not found'], 404);
        }

        $url->delete();

        return response()->json(['message' => 'URL deleted successfully']);
    }

    public function listUrlsApi()
    {
        $urls = Url::all();

        return response()->json($urls);
    }
}
