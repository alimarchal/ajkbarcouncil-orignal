<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJK Bar Council Members Directory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .search-box {
            transition: all 0.15s ease-in-out;
        }

        .search-box:hover {
            box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        }

        .search-box:focus-within {
            box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        }

        .google-btn {
            background-color: #f8f9fa;
            border: 1px solid #f8f9fa;
            color: #3c4043;
            font-family: arial, sans-serif;
            font-size: 14px;
            margin: 11px 4px;
            padding: 0 16px;
            line-height: 27px;
            height: 36px;
            min-width: 54px;
            text-align: center;
            cursor: pointer;
            user-select: none;
        }

        .google-btn:hover {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            border: 1px solid #dadce0;
            color: #202124;
        }

        body {
            font-family: arial, sans-serif;
        }

        .advanced-search {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .advanced-search.open {
            max-height: 800px;
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900">

    @if (!$hasSearch)
    <!-- Home Page - Google Style -->
    <div class="flex flex-col items-center justify-center min-h-screen px-4">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-6">
                <img src="{{ asset('icons-images/logo.jpg') }}" alt="AJK Bar Council Logo"
                    class="h-24 w-24 md:h-32 md:w-32 object-contain">
            </div>
            <h1 class="text-4xl md:text-6xl font-normal mb-2 text-gray-700 dark:text-gray-200"
                style="font-family: 'Product Sans', arial, sans-serif;">
                AJK Bar Council
            </h1>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('public.advocates.index') }}" class="w-full max-w-2xl">
            <!-- Search Box -->
            <div
                class="search-box flex items-center w-full bg-white dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-700 px-4 py-3 mb-8">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search advocates by name, mobile, email..."
                    class="flex-1 outline-none bg-transparent text-gray-700 dark:text-gray-200 text-base" autofocus>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-center gap-3">
                <button type="submit" class="google-btn rounded">
                    Search Members
                </button>
                <button type="button" onclick="document.getElementById('advancedFilters').classList.toggle('hidden')"
                    class="google-btn rounded">
                    Advanced Search
                </button>
            </div>

            <!-- Advanced Filters (Hidden by default) -->
            <div id="advancedFilters" class="hidden mt-8 bg-white dark:bg-gray-800 rounded-lg border p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Mobile Number
                        </label>
                        <input type="text" name="filter[mobile_no]" value="{{ request('filter.mobile_no') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address
                        </label>
                        <input type="email" name="filter[email_address]" value="{{ request('filter.email_address') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Bar Association
                        </label>
                        <select name="filter[bar_association_id]"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Associations</option>
                            @foreach ($barAssociations as $ba)
                            <option value="{{ $ba->id }}" {{ request('filter.bar_association_id')==$ba->id ? 'selected'
                                : '' }}>
                                {{ $ba->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Father's Name
                        </label>
                        <input type="text" name="filter[father_husband_name]"
                            value="{{ request('filter.father_husband_name') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </form>
    </div>

    @else
    <!-- Results Page - Google Style Header -->
    <div class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('public.advocates.index') }}" class="flex items-center gap-3 flex-shrink-0">
                    <img src="{{ asset('icons-images/logo.jpg') }}" alt="Logo" class="h-10 w-10 object-contain">
                    <span class="text-xl font-normal text-gray-700 dark:text-gray-200"
                        style="font-family: 'Product Sans', arial, sans-serif;">
                        AJK Bar Council
                    </span>
                </a>

                <!-- Search Form -->
                <form method="GET" action="{{ route('public.advocates.index') }}" class="flex-1 max-w-2xl">
                    <div
                        class="search-box flex items-center bg-white dark:bg-gray-800 rounded-full border border-gray-300 dark:border-gray-600 px-4 py-2">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="flex-1 outline-none bg-transparent text-gray-700 dark:text-gray-200 text-sm">
                        @if(request('search'))
                        <a href="{{ route('public.advocates.index') }}" class="ml-2">
                            <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif
                        <button type="submit" class="ml-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Hidden filters to maintain state -->
                    @foreach(request('filter', []) as $key => $value)
                    <input type="hidden" name="filter[{{ $key }}]" value="{{ $value }}">
                    @endforeach
                </form>
            </div>

            <!-- Navigation Tabs (Optional - like Google's All, Images, Videos, etc.) -->
            <div class="flex items-center gap-6 mt-4 ml-44 text-sm">
                <a href="#" class="flex items-center gap-2 pb-3 border-b-3 border-blue-600 text-blue-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    All
                </a>
            </div>
        </div>
    </div>

    <!-- Results Section -->
    @if ($hasSearch && count($advocates) > 0)
    <div class="max-w-3xl mx-auto px-4 py-6" style="margin-left: 180px;">

        <!-- Results Stats - Google Style -->
        <div class="mb-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                About {{ number_format($advocates->total()) }} results
            </p>
        </div>

        <!-- Results List - Google Style -->
        <div class="space-y-8">
            @foreach ($advocates as $advocate)
            <div class="max-w-2xl">
                <!-- Name (Title) -->
                <div class="mb-1">
                    <a href="{{ route('public.advocates.show', $advocate->id) }}"
                        class="text-xl text-blue-600 dark:text-blue-400 hover:underline visited:text-purple-600 dark:visited:text-purple-400"
                        style="font-family: arial, sans-serif;">
                        {{ $advocate->name }}
                    </a>
                    <!-- Membership Status Badge -->
                    <span
                        class="ml-3 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $advocate->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                        {{ $advocate->is_active ? '✓ Active' : '✗ Inactive' }}
                    </span>
                </div>

                <!-- URL (Bar Association) -->
                <div class="text-sm mb-2">
                    <span class="text-green-700 dark:text-green-400">{{ $advocate->barAssociation->name ?? 'N/A'
                        }}</span>
                    @if($advocate->permanent_member_of_bar_association)
                    <span class="text-gray-500"> › {{ $advocate->permanent_member_of_bar_association }}</span>
                    @endif
                </div>

                <!-- Description -->
                <div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                    <div class="mb-1">
                        @if($advocate->mobile_no)
                        <span class="mr-4">📱 {{ $advocate->mobile_no }}</span>
                        @endif
                        @if($advocate->email_address)
                        <span>✉️ {{ $advocate->email_address }}</span>
                        @endif
                    </div>

                    @if($advocate->father_husband_name)
                    <div class="mb-1">
                        S/O {{ $advocate->father_husband_name }}
                    </div>
                    @endif

                    @if($advocate->date_of_enrolment_lower_courts || $advocate->date_of_enrolment_high_court ||
                    $advocate->date_of_enrolment_supreme_court)
                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                        @if($advocate->date_of_enrolment_lower_courts)
                        Lower Courts: {{ $advocate->date_of_enrolment_lower_courts->format('M d, Y') }}
                        @endif
                        @if($advocate->date_of_enrolment_high_court)
                        • High Court: {{ $advocate->date_of_enrolment_high_court->format('M d, Y') }}
                        @endif
                        @if($advocate->date_of_enrolment_supreme_court)
                        • Supreme Court: {{ $advocate->date_of_enrolment_supreme_court->format('M d, Y') }}
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination - Google Style -->
        <div class="mt-12 flex justify-center">
            {{ $advocates->onEachSide(1)->links() }}
        </div>
    </div>
    @endif

    @if ($hasSearch && count($advocates) === 0)
    <div class="max-w-3xl mx-auto px-4 py-12" style="margin-left: 180px;">
        <div class="text-center">
            <div class="text-6xl mb-4">🔍</div>
            <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
                Your search did not match any members.
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-500">
                Suggestions:<br>
                • Make sure all words are spelled correctly<br>
                • Try different keywords<br>
                • Try more general keywords
            </p>
        </div>
    </div>
    @endif
    @endif

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400">
                <div class="flex gap-6">
                    <a href="#" class="hover:underline">About</a>
                    <a href="#" class="hover:underline">Privacy</a>
                    <a href="#" class="hover:underline">Terms</a>
                </div>
                <div>
                    © 2025 AJK Bar Council
                </div>
            </div>
        </div>
    </footer>

</body>

</html>