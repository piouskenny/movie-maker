<div>
    <div class="w-full h-[30vh]">

        <img src="{{ asset('Images/vg_banner_350_01a (1).jpg') }}" alt="">

    </div>

    <div class="p-6 min-h-screen flex flex-col items-center mt-[10vh]">
        <h1 class="text-primary text-3xl text-center mb-6"> <span class="text-gray-800">Use</span> my Movie Maker to create your own great movie</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <form wire:submit.prevent="upload" class="space-y-4">
                <div>
                    <label for="videoUpload" class="block text-gray-700">Upload Video File</label>
                    <input
                        type="file"
                        id="videoUpload"
                        wire:model="videoFile"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-light focus:border-primary-light sm:text-sm"
                    >
                    @error('videoFile')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full bg-primary-light text-white font-bold py-2 px-4 rounded hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary-light focus:ring-opacity-50"
                    >
                        Upload Video
                    </button>
                </div>
            </form>

            <form wire:submit.prevent="edit" class="space-y-4 mt-[20px]">
                <div>
                    <label for="videoId" class="block text-gray-700">Video url<label>
                    <input
                        type="text"
                        id="videoId"
                        wire:model="videoId"
                        placeholder="Video ID"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-light focus:border-primary-light sm:text-sm"
                    >
                    @error('videoId')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="options" class="block text-gray-700">Editing Options (JSON)</label>
                    <textarea
                        id="options"
                        wire:model="options"
                        placeholder="Editing Options (JSON)"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-light focus:border-primary-light sm:text-sm"
                    ></textarea>
                    @error('options')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full bg-primary-light text-white font-bold py-2 px-4 rounded hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary-light focus:ring-opacity-50"
                    >
                        Edit Video
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
