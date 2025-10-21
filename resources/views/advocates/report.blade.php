<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Advocates Report
        </h2>

        <div class="flex justify-center items-center float-right">
            <button id="toggle"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Search
            </button>
            <a href="{{ route('advocates.index') }}"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
            <button onclick="window.print();"
                class="inline-flex items-center ml-2 px-4 py-2 bg-green-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a60.773 60.773 0 012.25-.605m0 0a837.36 837.36 0 015.68-.236c.527.046 1.055.057 1.582.024m0 0a60.728 60.728 0 012.25.605M9 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Print
            </button>
        </div>
    </x-slot>

    <!-- FILTER SECTION -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg" id="filters"
            style="display: none">
            <div class="p-6">
                <form method="GET" action="{{ route('advocates.report') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Name Search -->
                        <div>
                            <x-input-filters name="name" label="Name" type="text" />
                        </div>

                        <!-- Email Search -->
                        <div>
                            <x-input-filters name="email_address" label="Email" type="email" />
                        </div>

                        <!-- Mobile Number Search -->
                        <div>
                            <x-input-filters name="mobile_no" label="Mobile Number" type="text" />
                        </div>

                        <!-- Father/Husband Name Search -->
                        <div>
                            <x-input-filters name="father_husband_name" label="Father/Husband Name" type="text" />
                        </div>

                        <!-- Status Filter -->
                        <x-select-filter label="Status" name="is_active" filterKey="is_active"
                            :options="['1' => 'Active', '0' => 'Inactive']" placeholder="All Status" />

                        <!-- Bar Association Filter -->
                        <x-select-filter label="Bar Association" name="bar_association_id"
                            filterKey="bar_association_id" :options="$barAssociations->pluck('name', 'id')"
                            placeholder="All Associations" />

                        <!-- Visitor Member Search -->
                        <div>
                            <x-input-filters name="visitor_member_of_bar_association" label="Visitor Member"
                                type="text" />
                        </div>

                        <!-- Voter Member Search -->
                        <div>
                            <x-input-filters name="voter_member_of_bar_association" label="Voter Member" type="text" />
                        </div>

                        <!-- Permanent Member Search -->
                        <div>
                            <x-input-filters name="permanent_member_of_bar_association" label="Permanent Member"
                                type="text" />
                        </div>

                        <!-- Lower Courts Enrolment Date From -->
                        <div>
                            <x-input-filters name="date_of_enrolment_lower_courts_from" label="Lower Courts From"
                                type="date" />
                        </div>

                        <!-- Lower Courts Enrolment Date To -->
                        <div>
                            <x-input-filters name="date_of_enrolment_lower_courts_to" label="Lower Courts To"
                                type="date" />
                        </div>

                        <!-- High Court Enrolment Date From -->
                        <div>
                            <x-input-filters name="date_of_enrolment_high_court_from" label="High Court From"
                                type="date" />
                        </div>

                        <!-- High Court Enrolment Date To -->
                        <div>
                            <x-input-filters name="date_of_enrolment_high_court_to" label="High Court To" type="date" />
                        </div>

                        <!-- Supreme Court Enrolment Date From -->
                        <div>
                            <x-input-filters name="date_of_enrolment_supreme_court_from" label="Supreme Court From"
                                type="date" />
                        </div>

                        <!-- Supreme Court Enrolment Date To -->
                        <div>
                            <x-input-filters name="date_of_enrolment_supreme_court_to" label="Supreme Court To"
                                type="date" />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <x-submit-button />
                </form>
            </div>
        </div>
    </div>

    <!-- REPORT TABLE SECTION -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2 pb-16">
        <x-status-message />
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            @if ($advocates->count() > 0)
            <div class="relative overflow-x-auto rounded-lg print:overflow-visible">
                <table class="min-w-max w-full table-auto text-sm">
                    <thead>
                        <tr class="bg-green-800 text-white uppercase text-xs print:bg-gray-300 print:text-black">
                            <th class="py-2 px-2 text-center border">#</th>
                            <th class="py-2 px-2 text-left border">Name</th>
                            <th class="py-2 px-2 text-left border">Father/Husband</th>
                            <th class="py-2 px-2 text-left border">Email</th>
                            <th class="py-2 px-2 text-left border">Mobile</th>
                            <th class="py-2 px-2 text-left border">Bar Association</th>
                            <th class="py-2 px-2 text-left border">Visitor Member</th>
                            <th class="py-2 px-2 text-left border">Voter Member</th>
                            <th class="py-2 px-2 text-left border">Permanent Member</th>
                            <th class="py-2 px-2 text-center border">Lower Courts</th>
                            <th class="py-2 px-2 text-center border">High Court</th>
                            <th class="py-2 px-2 text-center border">Supreme Court</th>
                            <th class="py-2 px-2 text-center border">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-black text-xs leading-normal print:text-black">
                        @foreach ($advocates as $key => $advocate)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 print:border-b-2 print:border-gray-400">
                            <td
                                class="py-2 px-2 text-center text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $key + 1 }}
                            </td>
                            <td class="py-2 px-2 text-left border print:border">
                                {{ $advocate->name }}
                            </td>
                            <td
                                class="py-2 px-2 text-left text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->father_husband_name }}
                            </td>
                            <td
                                class="py-2 px-2 text-left text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->email_address }}
                            </td>
                            <td
                                class="py-2 px-2 text-left text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->mobile_no }}
                            </td>
                            <td
                                class="py-2 px-2 text-left text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->barAssociation->name }}
                            </td>
                            <td
                                class="py-2 px-2 text-left text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->visitor_member_of_bar_association ?? '-' }}
                            </td>
                            <td
                                class="py-2 px-2 text-left text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->voter_member_of_bar_association ?? '-' }}
                            </td>
                            <td
                                class="py-2 px-2 text-left text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->permanent_member_of_bar_association ?? '-' }}
                            </td>
                            <td
                                class="py-2 px-2 text-center text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->date_of_enrolment_lower_courts?->format('d/m/Y') ?? '-' }}
                            </td>
                            <td
                                class="py-2 px-2 text-center text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->date_of_enrolment_high_court?->format('d/m/Y') ?? '-' }}
                            </td>
                            <td
                                class="py-2 px-2 text-center text-gray-600 dark:text-gray-400 border print:border print:text-black">
                                {{ $advocate->date_of_enrolment_supreme_court?->format('d/m/Y') ?? '-' }}
                            </td>
                            <td class="py-2 px-2 text-center border print:border">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $advocate->is_active ? 'bg-green-100 text-green-800 print:bg-green-200' : 'bg-red-100 text-red-800 print:bg-red-200' }}">
                                    {{ $advocate->is_active ? 'A' : 'I' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-2 py-2 print:hidden">
                {{ $advocates->links() }}
            </div>
            <div class="px-4 py-4 print:block hidden">
                <p class="text-sm text-gray-600">Total Advocates: {{ $advocates->total() }}</p>
                <p class="text-sm text-gray-600">Generated on: {{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
            @else
            <p class="text-gray-700 dark:text-gray-300 text-center py-4">
                No advocates found matching your criteria.
                <a href="{{ route('advocates.report') }}" class="text-blue-600 hover:underline">
                    Reset filters
                </a>.
            </p>
            @endif
        </div>
    </div>

    @push('modals')
    <script>
        const targetDiv = document.getElementById("filters");
            const btn = document.getElementById("toggle");

            function showFilters() {
                targetDiv.style.display = 'block';
                targetDiv.style.opacity = '0';
                targetDiv.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    targetDiv.style.opacity = '1';
                    targetDiv.style.transform = 'translateY(0)';
                }, 10);
            }

            function hideFilters() {
                targetDiv.style.opacity = '0';
                targetDiv.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    targetDiv.style.display = 'none';
                }, 300);
            }

            btn.onclick = function(event) {
                event.stopPropagation();
                if (targetDiv.style.display === "none") {
                    showFilters();
                } else {
                    hideFilters();
                }
            };

            // Hide filters when clicking outside
            document.addEventListener('click', function(event) {
                if (targetDiv.style.display === 'block' && !targetDiv.contains(event.target) && event.target !== btn) {
                    hideFilters();
                }
            });

            // Prevent clicks inside the filter from closing it
            targetDiv.addEventListener('click', function(event) {
                event.stopPropagation();
            });

            // Add CSS for smooth transitions
            const style = document.createElement('style');
            style.textContent = `#filters {transition: opacity 0.3s ease, transform 0.3s ease;}`;
            document.head.appendChild(style);
    </script>
    @endpush
</x-app-layout>