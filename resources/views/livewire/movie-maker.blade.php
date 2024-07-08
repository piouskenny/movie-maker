<div>
    <div class="w-full h-[30vh]">
        <img src="{{ asset('Images/vg_banner_350_01a (1).jpg') }}" alt="">
    </div>

    <div class="p-6 min-h-screen flex flex-col items-center mt-[10vh]">
        <h1 class="text-primary text-3xl text-center mb-6">
            <span class="text-gray-800">Use</span> my Movie Maker to create your own great movie
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl">
            <div class="mx-auto py-8 space-y-12">
                <form wire:submit.prevent="submit" class="bg-white rounded px-8 pt-6 pb-8 mb-4 space-y-8">

                    <div class="step bg-gray-100 p-6 rounded-lg">
                        <p class="block text-gray-700 text-sm mb-4 font-semibold">Step 1: Upload video to your Google Drive or YouTube, copy and paste the URL below</p>
                        <div class="mb-6">
                            <label for="videoUrl" class="block text-gray-700 text-sm font-bold mb-2">Video URL:</label>
                            <input type="url" id="videoUrl" wire:model="videoUrl" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('videoUrl') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="step bg-gray-50 p-6 rounded-lg">
                        <p class="block text-gray-700 text-sm mb-4 font-semibold">Step 2: Upload your audio file to your Google Drive or YouTube, copy and paste the URL below</p>
                        <div class="mb-6">
                            <label for="audioUrl" class="block text-gray-700 text-sm font-bold mb-2">Audio URL:</label>
                            <input type="url" id="audioUrl" wire:model="audioUrl" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('audioUrl') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="step bg-gray-100 p-6 rounded-lg">
                        <p class="block text-gray-700 text-sm mb-4 font-semibold">Step 3: Add overlay text and click submit</p>
                        <div class="mb-6">
                            <label for="overlayText" class="block text-gray-700 text-sm font-bold mb-2">Overlay Text:</label>
                            <textarea id="overlayText" wire:model="overlayText" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            @error('overlayText') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                            Submit
                        </button>
                    </div>
                </form>

                <div wire:loading wire:target="submit" role="status" class="flex justify-center mt-4">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-primary" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
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
