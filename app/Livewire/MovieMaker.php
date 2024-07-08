<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Creatomate\Client;
use Creatomate\Elements\Video;
use Creatomate\Elements\Audio;
use Creatomate\Elements\Text;
use Creatomate\Animations\TextSlide;
use Creatomate\Source;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class MovieMaker extends Component
{
    use WithFileUploads;

    public $videoUrl;
    public $videoFile;
    public $audioUrl;
    public $overlayText;
    public $result;
    public $loading = false;
    public $errorMessage;
    public $maxDuration;
    public $showScrollMessage = false;


    protected $rules = [
        'videoUrl' => 'nullable|url',
        'videoFile' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
        'audioUrl' => 'required|url',
        'overlayText' => 'nullable|string',
        'maxDuration' => 'nullable|integer|min:1',
    ];

    public function render()
    {
        return view('livewire.movie-maker');
    }

    public function submit()
{
    $this->validate();

    $this->loading = true;

    // Upload video to WordPress if file is provided
    if ($this->videoFile) {
        $this->videoUrl = $this->uploadVideoToWordPress($this->videoFile);
        if (!$this->videoUrl) {
            $this->addError('videoFile', 'Failed to upload video.');
            $this->loading = false;
            return;
        }
    }

    $client = new Client(env('CREATOMATE_API_KEY'));

    $elements = [
        new Video([
            'source' => $this->videoUrl,
            'trim_duration' => $this->maxDuration ? $this->maxDuration : null,
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

    $source = new Source([
        'output_format' => 'mp4',
        'frame_rate' => 60,
        'emoji_style' => 'apple',
        'elements' => $elements,
    ]);

    try {
        $renders = $client->render(['source' => $source]);
        $this->result = $renders[0]['url'];
        $this->emit('videoGenerated'); // Emit the event after video generation
    } catch (RequestException $e) {
        // Handle request exceptions (e.g., 4xx and 5xx responses)
        $this->addError('result', 'Error: ' . $e->getMessage());
    } catch (ConnectException $e) {
        // Handle connection exceptions (e.g., network issues)
        $this->addError('result', 'Network Error: ' . $e->getMessage());
    } catch (\Exception $e) {
        // Handle any other exceptions
        $this->addError('result', 'Unexpected Error: ' . $e->getMessage());
    } finally {
        $this->loading = false;
        $this->showScrollMessage = true; // Set the message visibility to true
    }
}




    public function download()
    {
        if ($this->result) {
            $filename = basename($this->result);
            $path = storage_path('app/public/videos/' . $filename);

            if (!file_exists($path)) {
                return response()->json(['error' => 'File not found.'], 404);
            }

            return response()->download($path, $filename, [
                'Content-Type' => 'video/mp4',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        } else {
            return response()->json(['error' => 'No video to download.'], 400);
        }
    }

    private function uploadVideoToWordPress($videoFile)
    {
        $wpToken = 'YOUR_WORDPRESS_API_TOKEN'; // Replace with actual token

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $wpToken,
        ])->attach(
            'file', file_get_contents($videoFile->getRealPath()), $videoFile->getClientOriginalName()
        )->post('https://your-wordpress-site.com/wp-json/wp/v2/media');

        if ($response->successful()) {
            return $response->json()['source_url'];
        } else {
            $this->addError('videoFile', $response->json()['message']);
            return null;
        }
    }
}
