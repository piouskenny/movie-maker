<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'My Movie Maker' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            .hero-bg {
                background-image: url('https://videogram.co.uk/wp-content/uploads/2017/10/vg_banner_350_01a.jpg');
                background-size: cover;
                background-position: center;
                height: 30vh;
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
      </script>
</html>
