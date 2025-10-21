<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $advocate->name }} - Member Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Member Details
            </h1>
            <a href="{{ route('public.advocates.index') }}"
                class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-300">
                ← Back
            </a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Advocate Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-8 py-12 text-white">
                <div class="flex items-center gap-6">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-4xl font-bold mb-2">{{ $advocate->name }}</h2>
                        <p class="text-blue-100 text-lg">{{ $advocate->barAssociation->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8 space-y-8">
                <!-- Personal Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <span
                            class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-lg">👤</span>
                        Personal Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Name</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{ $advocate->name }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Father/Husband Name</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{
                                $advocate->father_husband_name ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg md:col-span-2">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Complete Address</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{
                                $advocate->complete_address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <span
                            class="bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-lg">📞</span>
                        Contact Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Mobile Number</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1 font-mono">{{
                                $advocate->mobile_no ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Email</p>
                            <p class="text-lg font-bold text-blue-600 dark:text-blue-400 mt-1 break-all">{{
                                $advocate->email_address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Bar Association Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <span
                            class="bg-purple-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-lg">⚖️</span>
                        Bar Association Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Bar Association</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{
                                $advocate->barAssociation->name ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Permanent Member</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{
                                $advocate->permanent_member_of_bar_association ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Visitor Member</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{
                                $advocate->visitor_member_of_bar_association ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Voter Member</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{
                                $advocate->voter_member_of_bar_association ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Enrolment Information -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <span
                            class="bg-orange-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-lg">📋</span>
                        Enrolment Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Lower Courts</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                @if ($advocate->date_of_enrolment_lower_courts)
                                {{ $advocate->date_of_enrolment_lower_courts->format('d-m-Y') }}
                                <span class="text-xs text-gray-600 dark:text-gray-400 block mt-1">
                                    ({{ $advocate->getDetailedAgeDifference($advocate->date_of_enrolment_lower_courts)
                                    }})
                                </span>
                                @else
                                N/A
                                @endif
                            </p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">High Court</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                @if ($advocate->date_of_enrolment_high_court)
                                {{ $advocate->date_of_enrolment_high_court->format('d-m-Y') }}
                                <span class="text-xs text-gray-600 dark:text-gray-400 block mt-1">
                                    ({{ $advocate->getDetailedAgeDifference($advocate->date_of_enrolment_high_court) }})
                                </span>
                                @else
                                N/A
                                @endif
                            </p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Supreme Court</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                @if ($advocate->date_of_enrolment_supreme_court)
                                {{ $advocate->date_of_enrolment_supreme_court->format('d-m-Y') }}
                                <span class="text-xs text-gray-600 dark:text-gray-400 block mt-1">
                                    ({{ $advocate->getDetailedAgeDifference($advocate->date_of_enrolment_supreme_court)
                                    }})
                                </span>
                                @else
                                N/A
                                @endif
                            </p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg md:col-span-3">
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Duration of Practice</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                @if ($advocate->duration_of_practice)
                                {{ $advocate->duration_of_practice->format('d-m-Y') }}
                                <span class="text-xs text-gray-600 dark:text-gray-400 block mt-1">
                                    ({{ $advocate->getDetailedAgeDifference($advocate->duration_of_practice) }})
                                </span>
                                @else
                                N/A
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="bg-gray-50 dark:bg-gray-700 px-8 py-6 flex justify-between items-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Last Updated: {{ $advocate->updated_at->format('d-m-Y H:i') }}
                </p>
                <a href="{{ route('public.advocates.index') }}"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-300">
                    ← Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-400">
                © 2025 AJK Bar Council Members Directory
            </p>
        </div>
    </div>
</body>

</html>