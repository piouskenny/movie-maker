<?php

namespace App\Livewire;

use Livewire\Component;
use Creatomate\Client;
use Creatomate\Elements\Video;
use Creatomate\Elements\Audio;
use Creatomate\Elements\Text;
use Creatomate\Animations\TextSlide;
use Creatomate\Source;

class MovieMaker extends Component
{
    public $videoUrl;
    public $audioUrl;
    public $overlayText;
    public $result;

    protected $rules = [
        'videoUrl' => 'required|url',
        'audioUrl' => 'required|url',
        'overlayText' => 'nullable|string',
    ];


    public function render()
    {
        return view('livewire.movie-maker');
    }


    public function submit()
    {
        $this->validate();

        $client = new Client(env('CREATOMATE_API_KEY'));

        $elements = [
            new Video([
                'source' => $this->videoUrl,
            ]),
            new Audio([
                'source' => $this->audioUrl,
                'duration' => null,
                'audio_fade_out' => 2,
            ]),
        ];

        if (!empty($this->overlayText)) {
            $elements[] = new Text([
                'text' => $this->overlayText,
                'y' => '75%',
                'width' => '100%',
                'height' => '50%',
                'x_padding' => '5 vw',
                'y_padding' => '5 vh',
                'y_alignment' => '100%',
                'font_family' => 'Open Sans',
                'font_weight' => 700,
                'font_size_maximum' => '10.4 vmin',
                'background_color' => 'rgba(255,255,255,0.69)',
                'background_x_padding' => '23%',
                'background_y_padding' => '8%',
                'background_align_threshold' => '0%',
                'fill_color' => '#333333',
                'enter' => new TextSlide([
                    'duration' => '2 s',
                    'easing' => 'quadratic-out',
                    'split' => 'line',
                    'scope' => 'element',
                    'background_effect' => 'scaling-clip',
                ]),
            ]);
        }

        $source = new \Creatomate\Source([
            'output_format' => 'mp4',
            'frame_rate' => 60,
            'emoji_style' => 'apple',
            'elements' => $elements,
        ]);

        $renders = $client->render(['source' => $source]);

        $this->result = json_encode($renders, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
