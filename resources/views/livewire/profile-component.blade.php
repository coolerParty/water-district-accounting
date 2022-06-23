<div>
    @section('title', 'Profile / ' . $name)
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Profile <span class="text-base text-gray-400">/</span> <span
                class="text-2xl">{{ $name }}</span></h1>
    </div>
    <div class="max-w-full max-h-screen md:bg-gray-300 md:p-4">

        <section
            class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md md:grid md:grid-cols-3 md:gap-4 dark:bg-gray-800">
            <div class="relative flex justify-center w-full">
                @if ($newImage)
                <img class="object-cover rounded place-content-center w-70 h-70" src="{{ $newImage->temporaryUrl() }}"
                    alt="">
                <x-link-danger type="button" wire:click="removeImage" class="absolute cursor-pointer bottom-1 right-1">
                    Remove Selected Image</x-link-danger>
                @elseif ($image)
                <img class="object-cover rounded place-content-center w-70 h-70"
                    src="{{ asset('storage/assets/profile/medium') }}/{{ auth()->user()->profile_photo_path }}"
                    alt="Extra large avatar">
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="rounded w-70 h-70 place-content-center"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
                @endif
            </div>
            <div class="md:col-span-2">
                @if(Session::has('message'))
                <div x-data="{ msg:'true'}">
                    <template x-if="msg">
                        <div class="w-full text-white bg-emerald-500">
                            <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                <div class="flex">
                                    <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                        <path
                                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                                        </path>
                                    </svg>

                                    <p class="mx-3">{{ Session::get('message') }}</p>
                                </div>

                                <button @click="msg = '' "
                                    class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                @endif
                <x-jet-validation-errors class="mb-4" />
                <form wire:submit.prevent="update">
                    <div class="mt-4">
                        <div>
                            <label class="text-gray-700 dark:text-gray-200" for="name">name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" wire:model="name"
                                required autofocus autocomplete="name"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        </div>
                    </div>

                    <div class="mt-4">
                        <div>
                            <label class="text-gray-700 dark:text-gray-200" for="title">email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" wire:model="email"
                                required autofocus autocomplete="email"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        </div>
                    </div>

                    <div class="mt-4">
                        <div>
                            <label class="text-gray-700 dark:text-gray-200" for="newImage">Image</label>
                            <input id="newImage" type="file" name="newImage" wire:model="newImage"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            <div class="block w-full px-4 py-2 m-1 text-white bg-emerald-500" wire:loading
                                wire:target="newImage">
                                Uploading...
                            </div>


                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
