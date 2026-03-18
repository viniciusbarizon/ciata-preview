<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Preview | {{ $artistName }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <div class="mx-auto max-w-5xl p-4 sm:p-6 lg:p-10">
        <a href="/" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-sm text-white hover:bg-white/20">← Back to generator</a>
        @if (!empty($spotifyError))
            <div class="mt-3 rounded-xl border border-rose-300/30 bg-rose-500/10 p-3 text-sm text-rose-200">{{ $spotifyError }}</div>
        @endif

        <div class="mt-6 rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-950 p-5 shadow-2xl md:p-8">
            <div class="grid gap-5 md:grid-cols-[1fr_1.2fr]">
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ $artistImage }}" alt="{{ $artistName }}" class="h-72 w-full object-cover sm:h-96" />
                </div>
                <div class="space-y-3 text-slate-100">
                    <p class="text-xs uppercase tracking-[0.2em] text-indigo-300/80">Generated Artist Website</p>
                    <h1 class="text-3xl font-extrabold text-white">{{ $artistName }}</h1>
                    <p class="text-sm text-slate-300">Followers: {{ number_format($followers ?? 0) }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($genres as $genre)
                            <span class="rounded-full bg-indigo-500/20 px-2 py-1 text-xs text-indigo-200">{{ ucfirst($genre) }}</span>
                        @endforeach
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="https://open.spotify.com/artist/{{ $artistId }}" target="_blank" class="rounded-full bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white">Open on Spotify</a>
                    </div>
                </div>
            </div>

            <div class="mt-7">
                <div class="mb-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-300/70">Albums</p>
                        <h2 class="text-xl font-semibold text-white">Latest Releases</h2>
                    </div>
                </div>

                @if (count($albums) === 0)
                    <div class="rounded-xl border border-white/10 bg-slate-800/50 p-4 text-slate-200">No albums found.</div>
                @else
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($albums as $album)
                            <article class="rounded-2xl border border-white/10 bg-slate-900/70 p-3">
                                <div class="h-32 overflow-hidden rounded-xl bg-slate-800">
                                    <img src="{{ $album['image'] }}" alt="{{ $album['name'] }}" class="h-full w-full object-cover" />
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm font-semibold text-white">{{ $album['name'] }}</p>
                                    @if (! empty($album['release_date']))
                                        <p class="text-xs text-slate-300">{{ $album['release_date'] }}</p>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>