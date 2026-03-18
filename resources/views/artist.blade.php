<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artistName }} | Generated Artist Site</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-black text-white">
    <main class="mx-auto w-full max-w-4xl p-4 sm:p-6 lg:p-8">
        <header class="mb-5 flex flex-wrap items-start justify-between gap-3 border-b border-white/10 pb-3">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400">generated page</p>
                <h1 class="mt-2 max-w-3xl text-4xl font-black uppercase leading-[1.03] tracking-tight text-white sm:text-5xl">{{ $artistName }}</h1>
                <p class="mt-3 max-w-2xl text-sm text-slate-300">An automatically generated music promo site look that matches a minimal underground label style.</p>
            </div>
            <a href="/" class="rounded-full border border-white/20 bg-white/5 px-3 py-1 text-xs uppercase tracking-[0.2em] text-slate-200 hover:bg-white/10">Generator</a>
        </header>

        <div class="grid gap-5 lg:grid-cols-[1fr_0.8fr]">
            <section class="space-y-3">
                <div class="rounded-2xl border border-white/10 bg-slate-900/80 p-4">
                    <div class="flex flex-wrap items-start gap-2">
                        <span class="rounded-full border border-white/20 bg-white/5 px-2 py-1 text-xs uppercase tracking-[0.2em] text-slate-300">Artist</span>
                        <span class="rounded-full border border-white/20 bg-white/5 px-2 py-1 text-xs uppercase tracking-[0.2em] text-slate-300">{{ number_format($followers) }} fans</span>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2 text-xs text-slate-300">
                        @foreach ($genres as $genre)
                            <span class="rounded-full border border-white/20 bg-white/5 px-2 py-1 uppercase">{{ $genre }}</span>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="https://open.spotify.com/artist/{{ $artistId }}" target="_blank" class="rounded-full border border-white/20 bg-violet-500/20 px-3 py-2 text-xs font-semibold uppercase tracking-[0.15em] text-violet-100 hover:bg-violet-500/30">Listen on Spotify</a>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-slate-900/80 p-4">
                    <h2 class="text-xl font-semibold text-white">New Releases</h2>
                    <div class="mt-3 grid gap-2 sm:grid-cols-2">
                        @foreach ($albums as $album)
                            <article class="rounded-xl border border-white/10 bg-slate-800/70 p-2">
                                <div class="text-xs uppercase tracking-[0.15em] text-slate-300">{{ $album['release_date'] }}</div>
                                <p class="mt-1 text-sm font-semibold text-white">{{ $album['name'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <aside class="rounded-2xl border border-white/10 bg-gradient-to-br from-gray-900 via-slate-900 to-black p-3">
                <div class="overflow-hidden rounded-xl border border-white/10">
                    <img src="{{ $artistImage }}" alt="{{ $artistName }}" class="h-64 w-full object-cover" />
                </div>
                <div class="mt-3 space-y-2">
                    <div class="rounded-lg border border-white/10 bg-white/5 p-3">
                        <p class="text-xs uppercase tracking-[0.15em] text-slate-300">press kit</p>
                        <p class="mt-1 text-xs text-slate-200">Generated artist visuals, discography, and promo layout for quick demos.</p>
                    </div>
                    <div class="rounded-lg border border-white/10 bg-white/5 p-3 text-xs text-slate-200">
                        <p>Inspired by the Burial Waves aesthetic: condensed content, high contrast, strong typography.</p>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>