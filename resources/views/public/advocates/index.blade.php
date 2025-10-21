<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJK Bar Council Members Directory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
        }

        .search-container {
            transition: all 0.3s ease;
        }

        .search-container.has-results {
            transform: translateY(-20vh);
        }

        .filter-chip {
            transition: all 0.2s ease;
        }

        .filter-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .result-card {
            animation: slideIn 0.3s ease forwards;
            opacity: 0;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .result-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .result-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .result-card:nth-child(4) {
            animation-delay: 0.2s;
        }

        .result-card:nth-child(5) {
            animation-delay: 0.25s;
        }

        .logo-text {
            font-family: 'Product Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-weight: 500;
        }

        .search-box {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .search-box:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .search-box:focus-within {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.16);
        }

        .advanced-search {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .advanced-search.open {
            max-height: 600px;
        }

        .btn-google {
            background: #f8f9fa;
            border: 1px solid #f8f9fa;
            transition: all 0.2s ease;
        }

        .btn-google:hover {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            border-color: #dadce0;
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900">

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">

        <!-- Search Section -->
        <div class="search-container flex-1 flex items-center justify-center {{ count($advocates) > 0 ? 'has-results' : '' }}"
            style="padding-top: {{ count($advocates) > 0 ? '10vh' : '0' }}">
            <div class="w-full max-w-3xl px-4">

                <!-- Logo -->
                <div class="text-center mb-8">
                    <h1 class="logo-text text-6xl mb-2">
                        <span class="text-blue-500">AJK</span>
                        <span class="text-red-500">Bar</span>
                        <span class="text-yellow-500">Council</span>
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                        وکیلوں کی ڈائریکٹری - Members Directory
                    </p>
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('public.advocates.index') }}" id="searchForm">

                    <!-- Main Search Box -->
                    <div class="search-box bg-white dark:bg-gray-800 rounded-full shadow-lg mb-6">
                        <div class="flex items-center px-6 py-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="filter[name]" value="{{ request('filter.name') }}"
                                placeholder="Search advocates by name, mobile, or email..."
                                class="flex-1 ml-4 outline-none bg-transparent text-gray-700 dark:text-gray-200 text-lg"
                                autofocus>
                            <button type="button"
                                onclick="document.getElementById('advancedSearch').classList.toggle('open')"
                                class="ml-4 text-blue-600 hover:text-blue-700 font-medium text-sm">
                                Advanced
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Search Filters -->
                    <div id="advancedSearch"
                        class="advanced-search bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Mobile Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    📱 Mobile Number
                                </label>
                                <input type="text" name="filter[mobile_no]" value="{{ request('filter.mobile_no') }}"
                                    placeholder="03XX XXXXXXX"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Email Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ✉️ Email Address
                                </label>
                                <input type="email" name="filter[email_address]"
                                    value="{{ request('filter.email_address') }}" placeholder="advocate@example.com"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Bar Association Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ⚖️ Bar Association
                                </label>
                                <select name="filter[bar_association_id]"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Associations</option>
                                    @foreach ($barAssociations as $ba)
                                    <option value="{{ $ba->id }}" {{ request('filter.bar_association_id')==$ba->id ?
                                        'selected' : '' }}>
                                        {{ $ba->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Father Name Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    👤 Father's Name
                                </label>
                                <input type="text" name="filter[father_husband_name]"
                                    value="{{ request('filter.father_husband_name') }}" placeholder="والد کا نام"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Search Buttons -->
                    <div class="flex items-center justify-center space-x-4">
                        <button type="submit"
                            class="btn-google px-8 py-3 rounded-md text-gray-700 dark:text-gray-200 font-medium">
                            🔍 Search
                        </button>
                        <a href="{{ route('public.advocates.index') }}"
                            class="btn-google px-8 py-3 rounded-md text-gray-700 dark:text-gray-200 font-medium">
                            Clear
                        </a>
                    </div>
                </form>

            </div>
        </div>

        <!-- Results Section -->
        @if (count($advocates) > 0)
        <div class="max-w-6xl mx-auto px-4 pb-12 w-full">

            <!-- Results Header -->
            <div class="mb-6">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    About <span class="font-semibold text-gray-900 dark:text-white">{{ $advocates->total() }}</span>
                    results
                    @if(request()->has('filter'))
                    <span class="ml-2">
                        @foreach(request('filter') as $key => $value)
                        @if($value)
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 ml-1">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ is_numeric($value) && $key ==
                            'bar_association_id' ? $barAssociations->find($value)->name ?? $value : $value }}
                            <a href="{{ request()->fullUrlWithQuery(['filter' => array_merge(request('filter', []), [$key => null])]) }}"
                                class="ml-1 hover:text-blue-900">×</a>
                        </span>
                        @endif
                        @endforeach
                    </span>
                    @endif
                </p>
            </div>

            <!-- Results List -->
            <div class="space-y-4">
                @foreach ($advocates as $advocate)
                <div
                    class="result-card bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <!-- Name and Title -->
                                <div class="mb-3">
                                    <a href="{{ route('public.advocates.show', $advocate->id) }}"
                                        class="text-xl font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                        {{ $advocate->name }}
                                    </a>
                                    <p class="text-sm text-green-700 dark:text-green-400 mt-1">
                                        {{ $advocate->barAssociation->name ?? 'N/A' }}
                                    </p>
                                </div>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">

                                    <!-- Contact Info -->
                                    <div class="space-y-2">
                                        @if($advocate->mobile_no)
                                        <div class="flex items-center text-gray-600 dark:text-gray-400">
                                            <span class="w-5">📱</span>
                                            <span class="ml-2 font-mono">{{ $advocate->mobile_no }}</span>
                                        </div>
                                        @endif

                                        @if($advocate->email_address)
                                        <div class="flex items-center text-gray-600 dark:text-gray-400">
                                            <span class="w-5">✉️</span>
                                            <span class="ml-2 break-all">{{ $advocate->email_address }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Family Info -->
                                    <div class="space-y-2">
                                        @if($advocate->father_husband_name)
                                        <div class="flex items-start text-gray-600 dark:text-gray-400">
                                            <span class="w-5">👤</span>
                                            <div class="ml-2">
                                                <span class="text-xs text-gray-500 dark:text-gray-500">Father's
                                                    Name:</span>
                                                <p class="font-medium">{{ $advocate->father_husband_name }}</p>
                                            </div>
                                        </div>
                                        @endif

                                        @if($advocate->complete_address)
                                        <div class="flex items-start text-gray-600 dark:text-gray-400">
                                            <span class="w-5">📍</span>
                                            <span class="ml-2 text-xs">{{ Str::limit($advocate->complete_address, 60)
                                                }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Enrolment Dates -->
                                    <div class="space-y-2 text-xs">
                                        @if ($advocate->date_of_enrolment_lower_courts)
                                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                            <span>Lower Courts:</span>
                                            <span class="font-medium">{{
                                                $advocate->date_of_enrolment_lower_courts->format('d M Y') }}</span>
                                        </div>
                                        @endif

                                        @if ($advocate->date_of_enrolment_high_court)
                                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                            <span>High Court:</span>
                                            <span class="font-medium">{{
                                                $advocate->date_of_enrolment_high_court->format('d M Y') }}</span>
                                        </div>
                                        @endif

                                        @if ($advocate->date_of_enrolment_supreme_court)
                                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                            <span>Supreme Court:</span>
                                            <span class="font-medium">{{
                                                $advocate->date_of_enrolment_supreme_court->format('d M Y') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="ml-4">
                                <a href="{{ route('public.advocates.show', $advocate->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors text-sm font-medium">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $advocates->links() }}
            </div>
        </div>
        @endif

        @if (request()->has('filter') && count($advocates) === 0)
        <div class="max-w-6xl mx-auto px-4 pb-12 w-full">
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">
                    No results found
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Try different search terms or remove some filters
                </p>
                <a href="{{ route('public.advocates.index') }}"
                    class="btn-google px-6 py-3 rounded-md text-gray-700 dark:text-gray-200 font-medium inline-block">
                    Clear All Filters
                </a>
            </div>
        </div>
        @endif

    </div>

    <!-- Footer -->
    <footer class="bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <div class="flex flex-wrap items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                <div class="flex space-x-6">
                    <a href="#" class="hover:underline">About</a>
                    <a href="#" class="hover:underline">Help</a>
                    <a href="#" class="hover:underline">Privacy</a>
                    <a href="#" class="hover:underline">Terms</a>
                </div>
                <div class="mt-4 md:mt-0">
                    <p>© 2025 AJK Bar Council - وکیلوں کی ڈائریکٹری</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Auto-open advanced search if filters are active
        document.addEventListener('DOMContentLoaded', function() {
            const hasFilters = {{ request()->has('filter') && (request('filter.mobile_no') || request('filter.email_address') || request('filter.bar_association_id') || request('filter.father_husband_name')) ? 'true' : 'false' }};
            if (hasFilters) {
                document.getElementById('advancedSearch').classList.add('open');
            }
        });
    </script>

</body>

</html>