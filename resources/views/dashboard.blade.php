<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 mb-4 gap-6">
                <!-- Bar Associations Card -->
                <a href="{{ route('bar-associations.index') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-6 md:col-span-4 intro-y bg-white dark:bg-gray-800 block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="text-3xl font-bold leading-8">{{ \App\Models\BarAssociation::count() }}</div>
                            <div class="mt-1 text-base font-extrabold text-black dark:text-white">Bar Associations</div>
                        </div>
                        <img src="{{ url('icons-images/logo.jpg') }}" alt="Bar Association" class="h-16 w-16">
                    </div>
                </a>

                <!-- Advocates Card -->
                <a href="{{ route('advocates.index') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-6 md:col-span-4 intro-y bg-white dark:bg-gray-800 block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="text-3xl font-bold leading-8">{{ \App\Models\Advocate::count() }}</div>
                            <div class="mt-1 text-base font-extrabold text-black dark:text-white">Advocates</div>
                        </div>
                        <svg class="h-16 w-16 text-indigo-600 dark:text-indigo-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <!-- Total Users Card -->
                <div
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-6 md:col-span-4 intro-y bg-white dark:bg-gray-800 block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="text-3xl font-bold leading-8">{{ \App\Models\User::count() }}</div>
                            <div class="mt-1 text-base font-extrabold text-black dark:text-white">Total Users</div>
                        </div>
                        <svg class="h-16 w-16 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a6 6 0 00-9-5.197V7a1 1 0 00-2 0v.403A6 6 0 004 18v1h12z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Reports Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Reports</h3>
                <div class="grid grid-cols-12 gap-6">
                    <!-- Active Advocates Report -->
                    <div class="shadow-xl rounded-lg col-span-6 md:col-span-4 intro-y bg-white dark:bg-gray-800">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ \App\Models\Advocate::where('is_active', true)->count() }}
                                    </div>
                                    <div class="text-sm font-semibold text-gray-700 dark:text-gray-300 mt-1">
                                        Active Advocates
                                    </div>
                                </div>
                                <svg class="h-12 w-12 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Total: {{ \App\Models\Advocate::count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Inactive Advocates Report -->
                    <div class="shadow-xl rounded-lg col-span-6 md:col-span-4 intro-y bg-white dark:bg-gray-800">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-2xl font-bold text-red-600 dark:text-red-400">
                                        {{ \App\Models\Advocate::where('is_active', false)->count() }}
                                    </div>
                                    <div class="text-sm font-semibold text-gray-700 dark:text-gray-300 mt-1">
                                        Inactive Advocates
                                    </div>
                                </div>
                                <svg class="h-12 w-12 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Active: {{ \App\Models\Advocate::where('is_active', true)->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Active Bar Associations Report -->
                    <div class="shadow-xl rounded-lg col-span-6 md:col-span-4 intro-y bg-white dark:bg-gray-800">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                        {{ \App\Models\BarAssociation::where('is_active', true)->count() }}
                                    </div>
                                    <div class="text-sm font-semibold text-gray-700 dark:text-gray-300 mt-1">
                                        Active Bar Associations
                                    </div>
                                </div>
                                <svg class="h-12 w-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a6 6 0 00-9-5.197V7a1 1 0 00-2 0v.403A6 6 0 004 18v1h12z" />
                                </svg>
                            </div>
                            <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Total: {{ \App\Models\BarAssociation::count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>