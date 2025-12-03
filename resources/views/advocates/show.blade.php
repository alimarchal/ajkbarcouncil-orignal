<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ $advocate->name }}
        </h2>
        <div class="flex justify-center items-center float-right gap-2 screen-only">
            <a href="{{ route('advocates.edit', $advocate) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
            <button onclick="window.print()"
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231a1.125 1.125 0 01-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>
                Print
            </button>
            <a href="{{ route('advocates.index') }}"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <x-status-message />
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
                                    }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Advocate Information Table -->
                    <!-- Advocate Information Table -->
                    <table class="w-full">
                        <tbody>
                            <tr class="hidden print:table-row print-header-row">
                                <td colspan="2" class="p-4 text-left border border-black">
                                    <div class="print-header-title">Advocate Information Record</div>
                                    <div>
                                        <strong>Name:</strong> {{ $advocate->name }} |
                                        <strong>Bar Association:</strong> {{ $advocate->barAssociation->name }} |
                                        <strong>Generated:</strong> {{ now()->format('d M, Y') }}
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Name of Advocate
                                </td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->name }}</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Father's Name</td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->father_husband_name
                                    }}</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Complete Address
                                </td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->complete_address }}
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Permanent Member of
                                    Bar Association</td>
                                <td class="px-2 py-2 border border-black text-left">{{
                                    $advocate->permanent_member_of_bar_association ?? $advocate->barAssociation->name }}
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
                                <td class="px-2 py-2 border border-black text-left font-semibold">Practice Since
                                </td>
                                <td class="px-2 py-2 border border-black text-left">
                                    @if($advocate->duration_of_practice)
                                    Since {{ $advocate->duration_of_practice->format('Y') }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 print:hover:bg-white">
                                <td class="px-2 py-2 border border-black text-left font-semibold">Mobile No</td>
                                <td class="px-2 py-2 border border-black text-left">{{ $advocate->mobile_no }}</td>
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

                    <!-- Print Styles -->
                    <style>
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

                        /* Header row styling */
                        .print-header-row {
                            background-color: #f0f0f0;
                        }

                        .print-header-row td {
                            padding: 12px !important;
                            font-size: 14px !important;
                            text-align: center !important;
                        }

                        .print-header-title {
                            font-size: 18px;
                            font-weight: bold;
                            margin-bottom: 8px;
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

                            .print-header-row {
                                display: table-row !important;
                                background-color: #f0f0f0 !important;
                                -webkit-print-color-adjust: exact;
                                print-color-adjust: exact;
                            }

                            .print-header-row td {
                                padding: 8px !important;
                                font-size: 12px !important;
                                text-align: center !important;
                            }

                            .print-header-title {
                                font-size: 16px !important;
                                font-weight: bold !important;
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>