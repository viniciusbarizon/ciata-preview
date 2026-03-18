<?php

use Livewire\Component;

new class extends Component
{
    public string $artistId = '';
    public ?string $savedArtistId = null;
    public ?string $artistName = null;
    public ?string $artistImage = null;
    public array $genres = [];
    public ?int $followers = null;
    public ?string $previewUrl = null;
    public ?string $errorMessage = null;
    public ?string $spotifyError = null;
    public bool $isLoading = false;
    public bool $previewReady = false;

    protected function rules(): array
    {
        return [
            'artistId' => ['required', 'string', 'min:5'],
        ];
    }

    public function submit(): void
    {
        $this->reset(['errorMessage']);
        $this->validate();

        $this->isLoading = true;

        $artistNameOptions = ['Neon Echo', 'Skyline Pulse', 'Moonlit Jet', 'Violet Echoes', 'Glass Forest'];
        $genreOptions = ['pop', 'electronic', 'house', 'indie', 'alt pop', 'synthwave'];
        $imageOptions = [
            'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1487412912498-0447578fcca8?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=900&q=80',
        ];

        $seed = crc32($this->artistId ?: now()->timestamp);
        $artistName = $artistNameOptions[$seed % count($artistNameOptions)];
        $genreCount = 2 + ($seed % 3);
        shuffle($genreOptions);

        $this->artistName = "{$artistName} {$this->artistId}";
        $this->genres = array_slice($genreOptions, 0, $genreCount);
        $this->followers = rand(120_000, 9_900_000);
        $this->artistImage = $imageOptions[$seed % count($imageOptions)];

        $this->savedArtistId = $this->artistId;
        $this->previewUrl = url("/artist/{$this->artistId}");
        $this->previewReady = true;
        $this->isLoading = false;
    }
};
?>

<div class="min-h-screen text-slate-100" style="background: linear-gradient(180deg, #0f0b24 0%, #110e34 100%); transition: none !important;">
    <div class="mx-auto flex w-full max-w-4xl flex-col gap-5 px-4 py-10 md:px-6 lg:py-14">
        <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-indigo-900/90 via-slate-900/80 to-black/90 p-5 shadow-2xl backdrop-blur-md md:p-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="text-xs uppercase tracking-[0.24em] text-slate-300/80">Website Generator</p>
                    <h1 class="mt-2 text-3xl font-extrabold text-white md:text-4xl">Generate a mini site from a Spotify artist ID</h1>
                    <p class="mt-2 max-w-2xl text-slate-300">Paste a Spotify artist ID and this demo will generate a site preview card with artist metadata and site-ready branding content.</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-indigo-500/30 bg-slate-900/80 p-5 shadow-xl md:p-6">
            <div class="grid gap-5 md:grid-cols-[1.05fr_0.95fr]">
                <div class="rounded-2xl p-5 text-white shadow-lg always-purple" style="transition: none !important;">
                    <div class="rounded-xl bg-white/10 p-3 text-xs font-semibold uppercase tracking-[0.2em] text-white/90">What this does</div>
                    <h2 class="mt-3 text-2xl font-bold">Generate site content from artist ID</h2>
                    <p class="mt-2 text-sm text-indigo-50/90">This form generates a homepage-style preview with artist name, followers, genres, and a “visit Spotify” CTA.</p>
                    <div class="mt-4 grid gap-2 text-xs leading-5 text-indigo-100">
                        <span class="rounded-lg bg-white/10 px-2 py-1">• Clean UI</span>
                        <span class="rounded-lg bg-white/10 px-2 py-1">• Live validation</span>
                        <span class="rounded-lg bg-white/10 px-2 py-1">• Realtime updates</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-700/70 bg-slate-800/90 p-4 shadow-inner">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.16em] text-slate-300">Enter ID</p>
                            <h3 class="text-xl font-semibold text-white">Artist ID form</h3>
                        </div>
                        <span class="rounded-full bg-emerald-300/20 px-3 py-1 text-xs font-semibold text-emerald-300">Fast</span>
                    </div>

                    <form wire:submit.prevent="submit" class="mt-4 space-y-3">
                        <label for="artistId" class="block text-sm font-medium text-slate-200">Spotify Artist ID</label>
                        <input id="artistId" wire:model.live="artistId" type="text" placeholder="1vCWHaC5f2uS3yhpwWbIA6" class="w-full rounded-xl border border-slate-600 bg-slate-900 px-3 py-2 text-slate-100 placeholder:text-slate-400 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/30" />
                        @if ($errors->has('artistId'))
                            <p class="text-rose-300 text-sm">{{ $errors->first('artistId') }}</p>
                        @endif
                        <button type="submit" class="w-full rounded-xl px-4 py-2 text-white font-semibold" style="background: linear-gradient(90deg, #22d3ee 0%, #6366f1 50%, #a855f7 100%); transition: none !important;">Build site preview</button>
                    </form>

                    <div wire:loading class="mt-3 rounded-xl border border-cyan-300/30 bg-cyan-500/10 p-3 text-sm text-cyan-100">
                        Generating site preview...
                    </div>

                    @if ($spotifyError)
                        <div class="mt-3 rounded-xl border border-rose-300/30 bg-rose-500/10 p-3 text-sm text-rose-200">{{ $spotifyError }}</div>
                    @endif

                    @if ($errorMessage)
                        <div class="mt-3 rounded-xl border border-rose-300/30 bg-rose-500/10 p-3 text-sm text-rose-200">{{ $errorMessage }}</div>
                    @endif

                    @if ($previewReady)
                        <div class="mt-3 rounded-xl border border-indigo-300/40 bg-slate-800/60 p-3 text-sm text-slate-200">
                            <div class="flex items-center gap-3">
                                <div class="h-12 w-12 overflow-hidden rounded-xl bg-slate-700">
                                    <img class="h-full w-full object-cover" src="{{ $artistImage }}" alt="Artist image" />
                                </div>
                                <div>
                                    <div class="text-xs uppercase text-slate-300">Generated Site</div>
                                    <div class="text-lg font-semibold text-white">{{ $artistName }}</div>
                                </div>
                            </div>
                            <div class="mt-2 flex flex-wrap gap-2 text-xs text-slate-300">
                                @foreach ($genres as $genre)
                                    <span class="rounded-full border border-indigo-300/40 bg-indigo-500/20 px-2 py-0.5">{{ ucfirst($genre) }}</span>
                                @endforeach
                            </div>
                            <div class="mt-3 text-sm text-slate-200">Followers: {{ number_format($followers ?? 0) }}</div>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <a href="https://open.spotify.com/artist/{{ $savedArtistId }}" target="_blank" class="inline-flex items-center gap-2 rounded-md border border-white/20 bg-indigo-500/20 px-3 py-1.5 text-xs font-semibold text-indigo-200 hover:bg-indigo-500/30">Open on Spotify</a>
                                @if ($previewUrl)
                                    <a href="{{ $previewUrl }}" target="_blank" class="inline-flex items-center gap-2 rounded-md border border-fuchsia-300/30 bg-fuchsia-500/20 px-3 py-1.5 text-xs font-semibold text-fuchsia-200 hover:bg-fuchsia-500/30">Open generated artist site</a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>