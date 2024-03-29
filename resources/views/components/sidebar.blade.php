<!-- Sidebar backdrop -->
<div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
    style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>
<!-- Sidebar -->
<aside x-transition:enter="transition transform duration-300"
    x-transition:enter-start="-translate-x-full opacity-30  ease-in"
    x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300"
    x-transition:leave-start="translate-x-0 opacity-100 ease-out"
    x-transition:leave-end="-translate-x-full opacity-0 ease-in"
    class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white border-r shadow-lg lg:z-auto lg:static lg:shadow-none"
    :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}">
    <!-- sidebar header -->
    <div class="flex items-center justify-between flex-shrink-0 p-2" :class="{'lg:justify-center': !isSidebarOpen}">
        <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
            C<span :class="{'lg:hidden': !isSidebarOpen}">-OOLER</span>
        </span>
        <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
            <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <!-- Sidebar links -->
    <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
        <ul class="p-2 overflow-hidden">
            @can('dashboard-access')
            <li title="Dashboard">
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 space-x-2 hover:bg-gray-100
                    {{ (route('dashboard') == url()->current()) ? 'bg-gray-100' : '' }}"
                    :class="{'justify-center': !isSidebarOpen}">
                    <span>
                        <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                </a>
            </li>
            @endcan
            <li title="Accounting Entries" x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (! this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                }
            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                <a class="relative flex items-center w-full p-2 space-x-2 cursor-pointer hover:bg-gray-100
                    {{ (route('alljournal.index') == substr(url()->current(), 0, strlen(route('alljournal.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('cashreceiptjournal.index') == substr(url()->current(), 0, strlen(route('cashreceiptjournal.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('billingjournal.index') == substr(url()->current(), 0, strlen(route('billingjournal.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('materialissuedjournal.index') == substr(url()->current(), 0, strlen(route('materialissuedjournal.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('checkdisbursementjournal.index') == substr(url()->current(), 0, strlen(route('checkdisbursementjournal.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('generaljournal.index') == substr(url()->current(), 0, strlen(route('generaljournal.index')) )) ? 'bg-gray-100' : '' }}
                " :class="{'justify-center': !isSidebarOpen}" x-ref="button" x-on:click="toggle()"
                    :aria-expanded="open" :aria-controls="$id('dropdown-button')">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Accounting Entries</span>
                    <span class="absolute right-2" :class="{ 'lg:hidden': !isSidebarOpen }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-all"
                            :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
                <ul x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    :id="$id('dropdown-button')" style="display: none;">
                    @can('all-journal-show')
                    <li title="All Journal Transaction">
                        <a class="flex items-center p-2 space-x-2 text-sm border-t border-b hover:bg-gray-100
                        {{ (route('alljournal.index') == substr(url()->current(), 0, strlen(route('alljournal.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('alljournal.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">All Journal Transaction</span>
                        </a>
                    </li>
                    @endcan
                    @can('cash-receipt-journal-show')
                    <li title="Cash Receipt Journal">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('cashreceiptjournal.index') == substr(url()->current(), 0, strlen(route('cashreceiptjournal.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('cashreceiptjournal.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Cash Receipt Journal</span>
                        </a>
                    </li>
                    @endcan
                    @can('billing-show')
                    <li title="Billing Journal">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('billingjournal.index') == substr(url()->current(), 0, strlen(route('billingjournal.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('billingjournal.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Billing Journal</span>
                        </a>
                    </li>
                    @endcan
                    @can('material-journal-show')
                    <li title="Materials Stock Issue Journal">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('materialissuedjournal.index') == substr(url()->current(), 0, strlen(route('materialissuedjournal.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('materialissuedjournal.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                    <path fill-rule="evenodd"
                                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Materials Stock Issue Journal</span>
                        </a>
                    </li>
                    @endcan
                    @can('disbursement-journal-show')
                    <li title="Check Disbursement Journal">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('checkdisbursementjournal.index') == substr(url()->current(), 0, strlen(route('checkdisbursementjournal.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('checkdisbursementjournal.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm2.5 3a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm6.207.293a1 1 0 00-1.414 0l-6 6a1 1 0 101.414 1.414l6-6a1 1 0 000-1.414zM12.5 10a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Check Disbursement Journal</span>
                        </a>
                    </li>
                    @endcan
                    @can('general-journal-show')
                    <li title="General Journal">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('generaljournal.index') == substr(url()->current(), 0, strlen(route('generaljournal.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('generaljournal.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">General Journal</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li title="Report" x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (! this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                }
            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                <a class="relative flex items-center w-full p-2 space-x-2 cursor-pointer hover:bg-gray-100
                    {{ (route('journals.index') == substr(url()->current(), 0, strlen(route('journals.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('generalledger.index') == substr(url()->current(), 0, strlen(route('generalledger.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('fs.index') == substr(url()->current(), 0, strlen(route('fs.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('materialissuedjournal.index') == substr(url()->current(), 0, strlen(route('materialissuedjournal.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('checkdisbursementjournal.index') == substr(url()->current(), 0, strlen(route('checkdisbursementjournal.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('generaljournal.index') == substr(url()->current(), 0, strlen(route('generaljournal.index')) )) ? 'bg-gray-100' : '' }}
                " :class="{'justify-center': !isSidebarOpen}" x-ref="button" x-on:click="toggle()"
                    :aria-expanded="open" :aria-controls="$id('dropdown-button')">
                    <span>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                          </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Report Generation</span>
                    <span class="absolute right-2" :class="{ 'lg:hidden': !isSidebarOpen }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-all"
                            :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
                <ul x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    :id="$id('dropdown-button')" style="display: none;">
                    @can('all-journal-show')
                    <li title="Journals Report">
                        <a class="flex items-center p-2 space-x-2 text-sm border-t border-b hover:bg-gray-100
                        {{ (route('journals.index') == substr(url()->current(), 0, strlen(route('journals.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('journals.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                  </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Journals Report</span>
                        </a>
                    </li>
                    @endcan
                    @can('cash-receipt-journal-show')
                    <li title="General Ledger">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('generalledger.index') == substr(url()->current(), 0, strlen(route('generalledger.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('generalledger.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                  </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">General Ledger</span>
                        </a>
                    </li>
                    @endcan
                    @can('billing-show')
                    <li title="Financial Statement">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('fs.index') == substr(url()->current(), 0, strlen(route('fs.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('fs.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                  </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Financial Statement</span>
                        </a>
                    </li>
                    @endcan
                    @can('material-journal-show')
                    <li title="Annual Budget">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('materialissuedjournal.index') == substr(url()->current(), 0, strlen(route('materialissuedjournal.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('materialissuedjournal.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                                    <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                                  </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Annual Budget</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li title="Setup" x-data="{
                    open: false,
                    toggle() {
                        if (this.open) {
                            return this.close()
                        }

                        this.$refs.button.focus()

                        this.open = true
                    },
                    close(focusAfter) {
                        if (! this.open) return

                        this.open = false

                        focusAfter && focusAfter.focus()
                    }
                }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                <a class="relative flex items-center w-full p-2 space-x-2 cursor-pointer hover:bg-gray-100
                        {{ (route('annual-budget.index') == substr(url()->current(), 0, strlen(route('annual-budget.index')) )) ? 'bg-gray-100' : '' }}
                        {{ (route('beginningbalance.index') == substr(url()->current(), 0, strlen(route('beginningbalance.index')) )) ? 'bg-gray-100' : '' }}
                        {{ (route('accountchart.index') == substr(url()->current(), 0, strlen(route('accountchart.index')) )) ? 'bg-gray-100' : '' }}
                        {{ (route('submajoraccountgroup.index') == substr(url()->current(), 0, strlen(route('submajoraccountgroup.index')) )) ? 'bg-gray-100' : '' }}
                        {{ (route('majoraccountgroup.index') == substr(url()->current(), 0, strlen(route('majoraccountgroup.index')) )) ? 'bg-gray-100' : '' }}
                        {{ (route('accountgroup.index') == substr(url()->current(), 0, strlen(route('accountgroup.index')) )) ? 'bg-gray-100' : '' }}
                        {{ (route('bank.index') == substr(url()->current(), 0, strlen(route('bank.index')) )) ? 'bg-gray-100' : '' }}
                " :class="{'justify-center': !isSidebarOpen}" x-ref="button" x-on:click="toggle()"
                    :aria-expanded="open" :aria-controls="$id('dropdown-button')">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Setup</span>
                    <span class="absolute right-2" :class="{ 'lg:hidden': !isSidebarOpen }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-all"
                            :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
                <ul x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    :id="$id('dropdown-button')" style="display: none;">
                    @can('annual-budget-show')
                    <li title="Annual Budget">
                        <a class="flex items-center p-2 space-x-2 text-sm border-t border-b hover:bg-gray-100
                            {{ (route('annual-budget.index') == substr(url()->current(), 0, strlen(route('annual-budget.index')) )) ? 'bg-gray-100' : '' }}"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('annual-budget.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Annual Budget</span>
                        </a>
                    </li>
                    @endcan
                    @can('beginning-balance-show')
                    <li title="Beginning Balance">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('beginningbalance.index') == substr(url()->current(), 0, strlen(route('beginningbalance.index')) )) ? 'bg-gray-100' : '' }}" "
                            :class=" {'justify-center': !isSidebarOpen}" href="{{ route('beginningbalance.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Beginning Balance</span>
                        </a>
                    </li>
                    @endcan
                    @can('account-chart-show')
                    <li title="Accounts Code">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                            {{ (route('accountchart.index') == substr(url()->current(), 0, strlen(route('accountchart.index')) )) ? 'bg-gray-100' : '' }}"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('accountchart.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Accounts Chart</span>
                        </a>
                    </li>
                    @endcan
                    @can('account-group-show')
                    <li title="Sub Major Account Group">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                            {{ (route('submajoraccountgroup.index') == substr(url()->current(), 0, strlen(route('submajoraccountgroup.index')) )) ? 'bg-gray-100' : '' }}"
                            :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('submajoraccountgroup.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Sub Major Account Group</span>
                        </a>
                    </li>
                    @endcan
                    @can('account-group-show')
                    <li title="Major Account Group">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                            {{ (route('majoraccountgroup.index') == substr(url()->current(), 0, strlen(route('majoraccountgroup.index')) )) ? 'bg-gray-100' : '' }}"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('majoraccountgroup.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Major Account Group</span>
                        </a>
                    </li>
                    @endcan
                    @can('account-group-show')
                    <li title="Account Group">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                            {{ (route('accountgroup.index') == substr(url()->current(), 0, strlen(route('accountgroup.index')) )) ? 'bg-gray-100' : '' }}"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('accountgroup.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Account Group</span>
                        </a>
                    </li>
                    @endcan
                    @can('bank-show')
                    <li title="Bank">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                            {{ (route('bank.index') == substr(url()->current(), 0, strlen(route('bank.index')) )) ? 'bg-gray-100' : '' }}"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('bank.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                    <path fill-rule="evenodd"
                                        d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Bank</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li title="Security" x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (! this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                }
            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                <a class="relative flex items-center w-full p-2 space-x-2 cursor-pointer hover:bg-gray-100
                    {{ (route('users.index') == substr(url()->current(), 0, strlen(route('users.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('roles.index') == substr(url()->current(), 0, strlen(route('roles.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('permissions.index') == substr(url()->current(), 0, strlen(route('permissions.index')) )) ? 'bg-gray-100' : '' }}
                " :class="{'justify-center': !isSidebarOpen}" x-ref="button" x-on:click="toggle()"
                    :aria-expanded="open" :aria-controls="$id('dropdown-button')">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Security</span>
                    <span class="absolute right-2" :class="{ 'lg:hidden': !isSidebarOpen }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-all"
                            :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
                <ul x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    :id="$id('dropdown-button')" style="display: none;">
                    @can('user-show')
                    <li title="Users">
                        <a class="flex items-center p-2 space-x-2 text-sm border-t border-b hover:bg-gray-100
                        {{ (route('users.index') == substr(url()->current(), 0, strlen(route('users.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('users.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Users</span>
                        </a>
                    </li>
                    @endcan
                    @can('role-show')
                    <li title="Roles">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                            {{ (route('roles.index') == substr(url()->current(), 0, strlen(route('roles.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('roles.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Roles</span>
                        </a>
                    </li>
                    @endcan
                    @can('permission-show')
                    <li title="Permissions">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                            {{ (route('permissions.index') == substr(url()->current(), 0, strlen(route('permissions.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}" href="{{ route('permissions.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Permissions</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <!-- Sidebar Links... -->
        </ul>
    </nav>
    <!-- Sidebar footer -->
    <div class="flex-shrink-0 p-2 border-t max-h-14">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring">
            <span>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </span>
            <span :class="{'lg:hidden': !isSidebarOpen}"> Logout </span>
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>
    </div>
</aside>
