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
                        <img src="{{ url('icons-images/region.avif') }}" alt="Bar Association" class="h-16 w-16">
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
        </div>
    </div>
</x-app-layout>