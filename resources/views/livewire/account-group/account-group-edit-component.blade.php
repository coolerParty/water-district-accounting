<div>
    @section('title', 'Account Group / Edit / ' . $name)
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Account Group <span class="text-base text-gray-400">/</span>
            Edit <span class="text-base text-gray-400">/</span> <span class="text-2xl">{{ $name }}</span></h1>
        <a href="{{ route('accountgroup.index') }}"
            class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </span>
            <span>Back</span>
        </a>
    </div>
    <div class="max-w-full max-h-screen md:bg-gray-300 md:p-4">

        <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
            <x-jet-validation-errors class="mb-4" />
            <form wire:submit.prevent="update">

                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="seq_no">seq No.</label>
                        <input id="seq_no" type="numeric" name="seq_no" value="{{ old('seq_no') }}" wire:model="seq_no"
                            required autofocus autocomplete="seq_no"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="code">code</label>
                        <input id="code" type="text" name="code" value="{{ old('code') }}" wire:model="code" required
                            autofocus autocomplete="code"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="name">name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" wire:model="name" required
                            autofocus autocomplete="name"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label for="type" class="text-gray-700 dark:text-gray-200">type</label>
                        <select id="type" name="type" autocomplete="type-name" wire:model="type"
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm">
                            <option value="">Select Type</option>
                            <option value="1">Account Group</option>
                            <option value="2">Major Account Group</option>
                            <option value="3">Sub Major Account Group</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Update</button>
                </div>
            </form>
        </section>
    </div>
</div>
