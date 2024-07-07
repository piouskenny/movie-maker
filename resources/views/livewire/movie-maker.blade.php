<div>
    <div class="w-full h-[30vh]">
        <img src="{{ asset('Images/vg_banner_350_01a (1).jpg') }}" alt="">
    </div>

    <div class="p-6 min-h-screen flex flex-col items-center mt-[10vh]">
        <h1 class="text-primary text-3xl text-center mb-6">
            <span class="text-gray-800">Use</span> my Movie Maker to create your own great movie
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
            <div class="mx-auto py-8">
                <form wire:submit.prevent="submit" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                    <p class="block text-gray-700 text-sm mb-2">
                        Step 1: Upload video to your Google Drive or YouTube, copy and paste the URL below
                    </p>

                    <div class="mb-6">
                        <label for="videoUrl" class="block text-gray-700 text-sm font-bold mb-2">Video URL:</label>
                        <input type="url" id="videoUrl" wire:model="videoUrl" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('videoUrl') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <p class="block text-gray-700 text-sm mb-2">Step 2: Upload your audio file to your Google Drive or YouTube, copy and paste the URL below -</p>
                        <label for="audioUrl" class="block text-gray-700 text-sm font-bold mb-2">Audio URL:</label>
                        <input type="url" id="audioUrl" wire:model="audioUrl" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('audioUrl') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <p class="block text-gray-700 text-sm mb-2">Step 3: Add overlay text and click submit</p>
                        <label for="overlayText" class="block text-gray-700 text-sm font-bold mb-2">Overlay Text:</label>
                        <textarea id="overlayText" wire:model="overlayText" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        @error('overlayText') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Submit
                        </button>
                    </div>
                </form>

                <div wire:loading wire:target="submit" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
                    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
                </div>

                @if ($result)
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <h3 class="text-gray-700 text-lg font-bold mb-4">Render Result:</h3>
                        <video controls class="w-full">
                            <source src="{{ $result }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


