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
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            body {
                margin: 0;
                padding: 0;
                background: white !important;
            }

            .max-w-6xl {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .py-6 {
                padding: 0 !important;
            }

            .bg-white {
                background-color: white !important;
                box-shadow: none !important;
            }

            .shadow-xl {
                box-shadow: none !important;
            }

            .sm\:rounded-lg {
                border-radius: 0 !important;
            }

            .p-8 {
                padding: 10px !important;
            }

            table,
            th,
            td {
                border: 1px solid #000 !important;
                border-collapse: collapse;
                background-color: white !important;
                color: black !important;
            }

            th,
            td {
                padding: 6px 8px !important;
                font-size: 12px !important;
                text-align: left !important;
                background-color: white !important;
            }

            /* Make first column (labels) bold */
            td:first-child {
                font-weight: bold !important;
            }

            table {
                width: 100%;
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
                background-color: white !important;
            }

            /* Remove all badge styling */
            .badge,
            .inline-flex,
            span {
                background-color: transparent !important;
                color: black !important;
                padding: 0 !important;
                border-radius: 0 !important;
                display: inline !important;
            }

            .bg-green-100,
            .bg-red-100,
            .text-green-800,
            .text-red-800 {
                background-color: transparent !important;
                color: black !important;
            }

            /* Remove header hr line */
            .border-b-2 {
                border-bottom: none !important;
            }

            .border-gray-300 {
                border-color: transparent !important;
            }

            .screen-only {
                display: none !important;
            }

            .print-only {
                display: block !important;
            }

            img {
                max-width: 60px !important;
                max-height: 60px !important;
            }

            h1 {
                font-size: 18px !important;
                line-height: 1.2 !important;
                color: black !important;
            }

            p.text-xl {
                font-size: 14px !important;
                color: black !important;
            }

            .mb-8 {
                margin-bottom: 12px !important;
            }

            .pb-8 {
                padding-bottom: 12px !important;
            }

            .text-gray-600,
            .text-xs {
                color: black !important;
            }

            @page {
                size: auto;
                margin: 10mm;
            }
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Action Buttons (Screen Only) -->
            <div class="mb-4 screen-only flex justify-between items-center">
                <a href="{{ route('homepage.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Search
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
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <!-- Header with Logo and Title -->
                    <div class="flex items-center justify-center mb-2 pb-4">
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

                    <!-- Print Verification Footer (Print Only) -->
                    <div class="print-only" style="display: none;">
                        <div style="margin-top: 30px; padding-top: 20px; font-size: 11px; color: #000;">
                            <p style="margin: 5px 0;"><strong>Verification Information:</strong></p>
                            <p style="margin: 5px 0;">You can verify this information from: <strong>{{ url()->current()
                                    }}</strong></p>
                            <p style="margin: 5px 0;">Advocate ID: <strong>{{ $advocate->id }}</strong></p>
                            <p style="margin: 5px 0;">Printed on: <strong>{{ now()->format('l, d F Y h:i:s A')
                                    }}</strong></p>
                            <p style="margin: 5px 0; font-size: 10px; font-style: italic;">This is a computer-generated
                                document from AJK Bar Council Members Directory.</p>

                            <div style="margin-top: 20px; padding-top: 15px; ">
                                <p style="margin: 5px 0;"><strong>Developed by Jointly Venture:</strong></p>
                                <p style="margin: 5px 0;">MOON CREATIONS - UAN: +92-300-9857816</p>
                                <p style="margin: 5px 0;">SeeChange Innovative - UAN: +92-335-9991441</p>
                            </div>
                        </div>
                    </div>
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