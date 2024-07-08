<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'My Movie Maker' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <style>

        .loader {
            border-top-color: #3490dc;
            animation: spinner 0.6s linear infinite;
        }

    @keyframes spinner {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
        </style>

    </head>
    <body>
        {{ $slot }}
    </body>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                colors: {
                    primary: {
                    DEFAULT: '#f6b100',
                    light: '#fcc200',
                    },
                },
                },
            },
            variants: {},
            plugins: [],
        }

        document.addEventListener('livewire:load', function () {
            Livewire.on('videoGenerated', () => {
                document.getElementById('result-section').scrollIntoView({ behavior: 'smooth' });
            });
        });
      </script>
</html>
