<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ $advocate->name }}
        </h2>
        <div class="flex justify-center items-center float-right gap-2">
            <a href="{{ route('advocates.edit', $advocate) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('advocates.destroy', $advocate) }}" method="POST" class="inline"
                onsubmit="return confirm('Are you sure you want to delete this advocate?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                </button>
            </form>
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-status-message />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Basic Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $advocate->name }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Father/Husband Name
                                </h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{
                                    $advocate->father_husband_name }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</h4>
                                <p class="mt-1 text-lg text-blue-600 dark:text-blue-400">{{ $advocate->email_address }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Mobile Number</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $advocate->mobile_no }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Complete Address</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $advocate->complete_address
                                    }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Bar Association</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{
                                    $advocate->barAssociation->name }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</h4>
                                <p class="mt-1">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $advocate->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                        {{ $advocate->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolment Information -->
                    <div class="mb-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Enrolment Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Lower Courts</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->date_of_enrolment_lower_courts?->format('d M, Y') ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">High Court</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->date_of_enrolment_high_court?->format('d M, Y') ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Supreme Court</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->date_of_enrolment_supreme_court?->format('d M, Y') ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Additional Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration of Practice
                                </h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->duration_of_practice ? $advocate->duration_of_practice . ' years' :
                                    'N/A' }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Visitor Member</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->visitor_member_of_bar_association ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Voter Member</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->voter_member_of_bar_association ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Permanent Member</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->permanent_member_of_bar_association ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Information -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Audit Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created By</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->createdByUser?->name ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated By</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->updatedByUser?->name ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->created_at->format('d M, Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</h4>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                    {{ $advocate->updated_at->format('d M, Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>