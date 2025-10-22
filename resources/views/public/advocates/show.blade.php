<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $advocate->name }} - Member Details | AJK Bar Council</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: #f9fafb;
        }

        /* Global table styles - screen and print */
        table,
        th,
        td {
            border: 1px solid #000 !important;
            border-collapse: collapse;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px !important;
            text-align: left !important;
            font-size: 14px;
        }

        /* Hover effect for screen */
        table tr:hover td {
            background-color: #f3f4f6;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            table,
            th,
            td {
                border: 1px solid #000 !important;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 4px 6px !important;
                font-size: 11px !important;
                text-align: left !important;
            }

            table {
                width: 100%;
                page-break-inside: avoid;
            }

            .print-wrapper {
                padding: 0.5cm;
            }

            tr:nth-child(even) {
                background-color: #f8f8f8 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .screen-only {
                display: none !important;
            }

            img {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            @page {
                margin: 10mm;
            }
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button (Screen Only) -->
            <div class="mb-4 screen-only">
                <a href="{{ route('public.advocates.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Search
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <!-- Header with Logo and Title -->
                    <div class="flex items-center justify-center mb-8 pb-8 border-b-2 border-gray-300">
                        <div class="flex items-center justify-center gap-4">
                            <img src="{{ asset('icons-images/logo.jpg') }}" alt="Bar Council Logo" class="h-24 w-24">
                            <div class="text-center">
                                <h1 class="text-3xl font-bold text-gray-900">Portal Azad Jammu & Kashmir Bar Council
                                </h1>
                                <p class="text-xl font-semibold text-gray-700 mt-2">{{ $advocate->barAssociation->name
                                    ?? 'N/A'
                                    }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Advocate Information Table -->
                    <table class="w-full">
                        <tbody>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Name of Advocate
                                </td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->name }}</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Father's Name</td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->father_husband_name ??
                                    'N/A'
                                    }}</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Complete Address
                                </td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->complete_address ??
                                    'N/A' }}
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Permanent Member of
                                    Bar Association</td>
                                <td class="px-2 py-2 border border-black text-left">{{
                                    $advocate->permanent_member_of_bar_association ?? $advocate->barAssociation->name ??
                                    'N/A' }}
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Visitor Member of
                                    Bar Association</td>
                                <td class="px-2 py-2 border border-black text-left">{{
                                    $advocate->visitor_member_of_bar_association ?? 'Nil' }}</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Date of Enrolment
                                    Lower Courts</td>
                                <td class="px-2 py-2 border border-black text-left">
                                    @if($advocate->date_of_enrolment_lower_courts)
                                    {{ $advocate->date_of_enrolment_lower_courts->format('d-m-Y') }}
                                    <span class="text-xs text-gray-600">({{
                                        $advocate->getDetailedAgeDifference($advocate->date_of_enrolment_lower_courts)
                                        }})</span>
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Date of Enrolment
                                    High Court</td>
                                <td class="px-2 py-2 border border-black text-left">
                                    @if($advocate->date_of_enrolment_high_court)
                                    {{ $advocate->date_of_enrolment_high_court->format('d-m-Y') }}
                                    <span class="text-xs text-gray-600">({{
                                        $advocate->getDetailedAgeDifference($advocate->date_of_enrolment_high_court)
                                        }})</span>
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Date of Enrolment
                                    Supreme Court</td>
                                <td class="px-2 py-2 border border-black text-left">
                                    @if($advocate->date_of_enrolment_supreme_court)
                                    {{ $advocate->date_of_enrolment_supreme_court->format('d-m-Y') }}
                                    <span class="text-xs text-gray-600">({{
                                        $advocate->getDetailedAgeDifference($advocate->date_of_enrolment_supreme_court)
                                        }})</span>
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Voter Member of Bar
                                    Association</td>
                                <td class="px-2 py-2 border border-black text-left">{{
                                    $advocate->voter_member_of_bar_association ?? 'N/A' }}</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Duration of Practice
                                </td>
                                <td class="px-2 py-2 border border-black text-left">
                                    @if($advocate->duration_of_practice)
                                    {{ $advocate->duration_of_practice->format('d-m-Y') }}
                                    <span class="text-xs text-gray-600">({{
                                        $advocate->getDetailedAgeDifference($advocate->duration_of_practice)
                                        }})</span>
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Mobile No</td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->mobile_no ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Email Address</td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->email_address ??
                                    'Nil' }}</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Status</td>
                                <td class="px-2 py-2 border border-black text-left">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $advocate->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $advocate->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-800 text-white py-8 mt-12 screen-only">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-400">
                © 2025 AJK Bar Council Members Directory
            </p>
        </div>
    </div>
</body>

</html>