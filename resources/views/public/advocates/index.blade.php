<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJK Bar Council Members Directory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(to bottom, #f8fafc 0%, #ffffff 100%);
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
            transform: translateY(20px);
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
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .search-box {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
        }

        .search-box:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border-color: #d1d5db;
        }

        .search-box:focus-within {
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15);
            border-color: #3b82f6;
        }

        .advanced-search {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .advanced-search.open {
            max-height: 600px;
        }

        .btn-primary {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }

        .logo-container {
            animation: fadeInScale 0.6s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
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
                <div class="text-center mb-6 md:mb-8 logo-container px-4">
                    <div class="flex items-center justify-center mb-3 md:mb-4">
                        <img src="{{ asset('icons-images/logo.jpg') }}" alt="AJK Bar Council Logo"
                            class="h-20 w-20 md:h-28 md:w-28 object-contain rounded-full shadow-lg ring-4 ring-blue-50">
                    </div>
                    <h1 class="logo-text text-3xl md:text-5xl mb-2 text-gray-900 dark:text-white">
                        AJK Bar Council
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base mt-2 font-medium">
                        Members Directory
                    </p>
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('public.advocates.index') }}" id="searchForm">

                    <!-- Main Search Box -->
                    <div class="search-box bg-white dark:bg-gray-800 rounded-full shadow-lg mb-4 md:mb-6">
                        <div class="flex items-center px-4 md:px-6 py-3 md:py-4">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search by name, mobile, email..."
                                class="flex-1 ml-3 md:ml-4 outline-none bg-transparent text-gray-700 dark:text-gray-200 text-base md:text-lg"
                                autofocus>
                            <button type="button"
                                onclick="document.getElementById('advancedSearch').classList.toggle('open')"
                                class="ml-2 md:ml-4 text-blue-600 hover:text-blue-700 font-medium text-xs md:text-sm whitespace-nowrap">
                                Advanced
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Search Filters -->
                    <div id="advancedSearch"
                        class="advanced-search bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 md:p-6 mb-4 md:mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">

                            <!-- Mobile Filter -->
                            <div>
                                <label
                                    class="block text-xs md:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    📱 Mobile Number
                                </label>
                                <input type="text" name="filter[mobile_no]" value="{{ request('filter.mobile_no') }}"
                                    placeholder="03XX XXXXXXX"
                                    class="w-full px-3 md:px-4 py-2 md:py-3 text-sm md:text-base border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Email Filter -->
                            <div>
                                <label
                                    class="block text-xs md:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ✉️ Email Address
                                </label>
                                <input type="email" name="filter[email_address]"
                                    value="{{ request('filter.email_address') }}" placeholder="advocate@example.com"
                                    class="w-full px-3 md:px-4 py-2 md:py-3 text-sm md:text-base border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Bar Association Filter -->
                            <div>
                                <label
                                    class="block text-xs md:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ⚖️ Bar Association
                                </label>
                                <select name="filter[bar_association_id]"
                                    class="w-full px-3 md:px-4 py-2 md:py-3 text-sm md:text-base border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                                <label
                                    class="block text-xs md:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    👤 Father's Name
                                </label>
                                <input type="text" name="filter[father_husband_name]"
                                    value="{{ request('filter.father_husband_name') }}"
                                    placeholder="Enter father's name"
                                    class="w-full px-3 md:px-4 py-2 md:py-3 text-sm md:text-base border border-gray-200 dark:border-gray-700 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Search Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 md:gap-4">
                        <button type="submit"
                            class="btn-primary w-full sm:w-auto px-6 md:px-8 py-3 rounded-lg font-semibold shadow-md text-sm md:text-base">
                            🔍 Search Members
                        </button>
                        <a href="{{ route('public.advocates.index') }}"
                            class="btn-secondary w-full sm:w-auto px-6 md:px-8 py-3 rounded-lg text-gray-700 dark:text-gray-200 font-semibold text-sm md:text-base">
                            Clear Filters
                        </a>
                    </div>
                </form>

            </div>
        </div>

        <!-- Results Section -->
        @if ($hasSearch && count($advocates) > 0)
        <div class="max-w-6xl mx-auto px-4 pb-12 w-full">

            <!-- Results Header - Google Style -->
            <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    About {{ number_format($advocates->total()) }} results
                </p>
            </div>

            <!-- Results List - Google Style -->
            <div class="space-y-6">
                @foreach ($advocates as $advocate)
                <div class="group">
                    <!-- Name and URL -->
                    <div class="flex items-start gap-3 mb-1">
                        <a href="{{ route('public.advocates.show', $advocate->id) }}"
                            class="text-xl text-blue-600 dark:text-blue-400 hover:underline visited:text-purple-600 dark:visited:text-purple-400">
                            {{ $advocate->name }}
                        </a>
                        <!-- Membership Status Badge -->
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $advocate->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                            {{ $advocate->is_active ? '✓ Active Member' : '✗ Inactive' }}
                        </span>
                    </div>

                    <!-- URL breadcrumb style -->
                    <div class="flex items-center gap-1 text-sm text-gray-600 dark:text-gray-400 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>{{ $advocate->barAssociation->name ?? 'N/A' }}</span>
                        @if($advocate->permanent_member_of_bar_association)
                        <span class="text-gray-400">›</span>
                        <span class="text-xs">{{ $advocate->permanent_member_of_bar_association }}</span>
                        @endif
                    </div>

                    <!-- Description / Details -->
                    <div class="text-sm text-gray-700 dark:text-gray-300 max-w-3xl">
                        <div class="flex flex-wrap gap-x-4 gap-y-1">
                            @if($advocate->mobile_no)
                            <span>📱 {{ $advocate->mobile_no }}</span>
                            @endif
                            @if($advocate->email_address)
                            <span>✉️ {{ $advocate->email_address }}</span>
                            @endif
                            @if($advocate->father_husband_name)
                            <span>👤 S/O {{ $advocate->father_husband_name }}</span>
                            @endif
                        </div>

                        <!-- Enrolment Info -->
                        @if($advocate->date_of_enrolment_lower_courts || $advocate->date_of_enrolment_high_court ||
                        $advocate->date_of_enrolment_supreme_court)
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-xs text-gray-600 dark:text-gray-400">
                            @if($advocate->date_of_enrolment_lower_courts)
                            <span>⚖️ Lower Courts: {{ $advocate->date_of_enrolment_lower_courts->format('M d, Y')
                                }}</span>
                            @endif
                            @if($advocate->date_of_enrolment_high_court)
                            <span>⚖️ High Court: {{ $advocate->date_of_enrolment_high_court->format('M d, Y') }}</span>
                            @endif
                            @if($advocate->date_of_enrolment_supreme_court)
                            <span>⚖️ Supreme Court: {{ $advocate->date_of_enrolment_supreme_court->format('M d, Y')
                                }}</span>
                            @endif
                        </div>
                        @endif

                        @if($advocate->complete_address)
                        <div class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            📍 {{ $advocate->complete_address }}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination - Google Style -->
            <div class="mt-12 flex justify-center">
                <div class="flex items-center gap-2">
                    {{ $advocates->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
        @endif

        @if ($hasSearch && count($advocates) === 0)
        <div class="max-w-6xl mx-auto px-4 pb-12 w-full">
            <div class="text-center py-8 md:py-12">
                <div class="text-5xl md:text-6xl mb-4">🔍</div>
                <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white mb-2">
                    No Results Found
                </h3>
                <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 mb-6 px-4">
                    Try different search terms or remove some filters
                </p>
                <a href="{{ route('public.advocates.index') }}"
                    class="btn-secondary px-6 py-3 rounded-lg text-gray-700 dark:text-gray-200 font-semibold inline-block text-sm md:text-base">
                    Clear All Filters
                </a>
            </div>
        </div>
        @endif

    </div>

    <!-- Footer -->
    <footer class="bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-4 md:py-6">
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between text-xs md:text-sm text-gray-600 dark:text-gray-400 gap-4">
                <div class="flex flex-wrap justify-center md:justify-start gap-4 md:gap-6">
                    <a href="#" class="hover:underline">About</a>
                    <a href="#" class="hover:underline">Help</a>
                    <a href="#" class="hover:underline">Privacy</a>
                    <a href="#" class="hover:underline">Terms</a>
                </div>
                <div class="text-center md:text-left">
                    <p>© 2025 AJK Bar Council Members Directory</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Auto-open advanced search if filters are active
        document.addEventListener('DOMContentLoaded', function() {
            const hasFilters = {{ (request()->has('filter') && (request('filter.mobile_no') || request('filter.email_address') || request('filter.bar_association_id') || request('filter.father_husband_name'))) ? 'true' : 'false' }};
            if (hasFilters) {
                document.getElementById('advancedSearch').classList.add('open');
            }
        });
    </script>

</body>

</html>