<div>
    @section('title', 'Account Chart / Create')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Account Chart <span class="text-base text-gray-400">/</span>
            <span class="text-2xl">Create</span>
        </h1>
        <a href="{{ route('accountchart.index') }}"
            class="inline-flex items-center px-6 py-2 space-x-1 text-white bg-purple-600 rounded-md shadow hover:bg-opacity-95">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </span>
            <span>Back</span>
        </a>
    </div>
    <div class="max-w-full md:p-4">
        <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
            @if(session()->has('failures'))
            <table class="min-w-full overflow-x-scroll divide-y divide-gray-200 table-auto">
                <thead class="bg-red-400">
                    <tr>
                        <th scope="col"
                                    class="px-6 py-3 text-xs tracking-wider text-left text-gray-900 uppercase border font-xs">Row</th>
                        <th scope="col"
                                    class="px-6 py-3 text-xs tracking-wider text-left text-gray-900 uppercase border font-xs">Attribute</th>
                        <th scope="col"
                                    class="px-6 py-3 text-xs tracking-wider text-left text-gray-900 uppercase border font-xs">Errors</th>
                        <th scope="col"
                                    class="px-6 py-3 text-xs tracking-wider text-left text-gray-900 uppercase border font-xs">Value</th>
                    </tr>
                </thead>
                 <tbody class="bg-red-300">
                    @foreach(session()->get('failures') as $validation)
                <tr>
                    <td  class="p-1 text-xs text-gray-900 border">{{ $validation->row() }}</td>
                    <td  class="p-1 text-xs text-gray-900 border">{{ $validation->attribute() }}</td>
                    <td  class="p-1 text-xs text-gray-900 border">
                        <ul>
                            @foreach($validation->errors() as $e)
                            <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td  class="p-1 text-xs text-gray-900 border">
                        {{ $validation->values()[$validation->attribute()] }}
                    </td>
                </tr>
                @endforeach
                 </tbody>

            </table>
            @endif
            <form wire:submit.prevent="importFile">
                <div class="mt-4">
                    <label class="text-gray-700 dark:text-gray-200" for="seq_no">Upload Account Group Excel File</label>
                    <input type="file" wire:model="file" name="file" id="file"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <div class="w-full p-2 m-1 text-white bg-red-400 rounded" wire:loading wire:target="file">
                        Uploading...
                    </div>
                    <p class="mt-2 text-xs italic">Column 1: code, Column 2: name, Column 3: seq_no,</p>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Import</button>
                </div>
            </form>
        </section>
    </div>
    <div class="max-w-full mt-1 md:p-4">

        <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
            <x-jet-validation-errors class="mb-4" />
            <form wire:submit.prevent="store">

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
                        <label for="acctgrp_id" class="text-gray-700 dark:text-gray-200">Account Group</label>
                        <select id="acctgrp_id" name="acctgrp_id" autocomplete="type-name" wire:model="acctgrp_id"
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm">
                            <option value="">Select Account group</option>
                            @foreach($accountgroups as $accountgroup)
                            <option value="{{ $accountgroup->id }}">{{ $accountgroup->code . ' - ' . $accountgroup->name
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label for="mjracctgrp_id" class="text-gray-700 dark:text-gray-200">Major Account Group</label>
                        <select id="mjracctgrp_id" name="mjracctgrp_id" autocomplete="mjracctgrp_id-name"
                            wire:model="mjracctgrp_id"
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm">
                            <option value="">Select Major Account group</option>
                            @foreach($majorAccountGroups as $majorAccountGroup)
                            <option value="{{ $majorAccountGroup->id }}">{{ $majorAccountGroup->code . ' - ' . $majorAccountGroup->name
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label for="submjracctgrp_id" class="text-gray-700 dark:text-gray-200">Sub Major Account
                            Group</label>
                        <select id="submjracctgrp_id" name="submjracctgrp_id" autocomplete="submjracctgrp_id-name"
                            wire:model="submjracctgrp_id"
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm">
                            <option value="">Select Sub Major Account group</option>
                            @foreach($subMajorAccountGroups as $subMajorAccountGroup)
                            <option value="{{ $subMajorAccountGroup->id }}">{{ $subMajorAccountGroup->code . ' - ' . $subMajorAccountGroup->name
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                </div>
            </form>
        </section>
    </div>
</div>
