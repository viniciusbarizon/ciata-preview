<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciata</title>
    <style>
        html, body { background: linear-gradient(180deg, #1f123a 0%, #090d1f 100%) !important; color: #fff !important; min-height: 100%; transition: none !important; }
        body { min-height: 100vh; }
        .always-purple { background: linear-gradient(135deg, #c026d3 0%, #7c3aed 40%, #6366f1 100%) !important; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="text-slate-100" style="background: linear-gradient(180deg, #1f123a 0%, #090d1f 100%); min-height:100vh;">
    <livewire:spotify-artist-input />
    @livewireScripts
</body>
</html>
