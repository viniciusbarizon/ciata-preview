<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/artist/{artistId}', function (string $artistId) {
    $seed = crc32($artistId ?: now()->timestamp);

    $artistNames = ['Neon Echo', 'Skyline Pulse', 'Moonlit Jet', 'Violet Echoes', 'Glass Forest'];
    $genreOptions = ['pop', 'electronic', 'indie', 'alt', 'synthwave', 'alt-pop'];
    $imageOptions = [
        'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1487412912498-0447578fcca8?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1200&q=80',
    ];

    $artist = [
        'name' => $artistNames[$seed % count($artistNames)] . " #" . strtoupper(substr($artistId, 0, 4)),
        'genres' => array_slice($genreOptions, 0, 2 + ($seed % 3)),
        'followers' => rand(120_000, 9_900_000),
        'images' => [['url' => $imageOptions[$seed % count($imageOptions)]]],
    ];

    $albums = collect([1, 2, 3, 4, 5])->map(fn ($index) => [
        'name' => "{$artist['name']} Album {$index}",
        'image' => $imageOptions[($seed + $index) % count($imageOptions)],
        'release_date' => now()->subDays($index * 90)->toDateString(),
    ])->values()->all();

    return view('artist', [
        'artistName' => $artist['name'],
        'artistImage' => $artist['images'][0]['url'],
        'genres' => $artist['genres'],
        'followers' => $artist['followers'],
        'albums' => $albums,
        'artistId' => $artistId,
        'spotifyError' => null,
    ]);
})->name('artist.site');
