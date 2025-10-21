<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Create Advocate
        </h2>
        <div class="flex justify-center items-center float-right">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4 mt-4" />
                <div class="p-6">
                    <x-validation-errors class="mb-4 mt-4" />
                    <form method="POST" action="{{ route('advocates.store') }}">
                        @csrf

                        <!-- Bar Association -->
                        <div class="mb-4">
                            <x-label for="bar_association_id" value="Bar Association" :required="true" />
                            <select id="bar_association_id" name="bar_association_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                <option value="">Select Bar Association</option>
                                @foreach ($barAssociations as $bar)
                                <option value="{{ $bar->id }}" {{ old('bar_association_id')==$bar->id ? 'selected' : ''
                                    }}>{{ $bar->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Name -->
                            <div>
                                <x-label for="name" value="Name" :required="true" />
                                <x-input id="name" type="text" name="name" class="mt-1 block w-full"
                                    :value="old('name')" placeholder="Enter advocate name" required autofocus />
                            </div>

                            <!-- Father/Husband Name -->
                            <div>
                                <x-label for="father_husband_name" value="Father/Husband Name" :required="true" />
                                <x-input id="father_husband_name" type="text" name="father_husband_name"
                                    class="mt-1 block w-full" :value="old('father_husband_name')"
                                    placeholder="Enter father or husband name" required />
                            </div>

                            <!-- Mobile Number -->
                            <div>
                                <x-label for="mobile_no" value="Mobile Number" :required="true" />
                                <x-input id="mobile_no" type="text" name="mobile_no" class="mt-1 block w-full"
                                    :value="old('mobile_no')" placeholder="Enter mobile number" required />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-label for="email_address" value="Email Address" :required="true" />
                                <x-input id="email_address" type="email" name="email_address" class="mt-1 block w-full"
                                    :value="old('email_address')" placeholder="Enter email address" required />
                            </div>
                        </div>

                        <!-- Complete Address -->
                        <div class="mt-4">
                            <x-label for="complete_address" value="Complete Address" :required="true" />
                            <textarea id="complete_address" name="complete_address" rows="3"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                placeholder="Enter complete address" required>{{ old('complete_address') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <!-- Lower Courts Enrolment -->
                            <div>
                                <x-label for="date_of_enrolment_lower_courts" value="Lower Courts Enrolment Date" />
                                <x-input id="date_of_enrolment_lower_courts" type="date"
                                    name="date_of_enrolment_lower_courts" class="mt-1 block w-full"
                                    :value="old('date_of_enrolment_lower_courts')" />
                            </div>

                            <!-- High Court Enrolment -->
                            <div>
                                <x-label for="date_of_enrolment_high_court" value="High Court Enrolment Date" />
                                <x-input id="date_of_enrolment_high_court" type="date"
                                    name="date_of_enrolment_high_court" class="mt-1 block w-full"
                                    :value="old('date_of_enrolment_high_court')" />
                            </div>

                            <!-- Supreme Court Enrolment -->
                            <div>
                                <x-label for="date_of_enrolment_supreme_court" value="Supreme Court Enrolment Date" />
                                <x-input id="date_of_enrolment_supreme_court" type="date"
                                    name="date_of_enrolment_supreme_court" class="mt-1 block w-full"
                                    :value="old('date_of_enrolment_supreme_court')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Duration of Practice -->
                            <div>
                                <x-label for="duration_of_practice" value="Duration of Practice (Start Date)" />
                                <x-input id="duration_of_practice" type="date" name="duration_of_practice"
                                    class="mt-1 block w-full" :value="old('duration_of_practice')" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-label for="is_active" value="Status" :required="true" />
                                <select id="is_active" name="is_active"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('is_active')=='1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active')=='0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-label for="visitor_member_of_bar_association"
                                value="Visitor Member of Bar Association" />
                            <x-input id="visitor_member_of_bar_association" type="text"
                                name="visitor_member_of_bar_association" class="mt-1 block w-full"
                                :value="old('visitor_member_of_bar_association')" placeholder="Optional" />
                        </div>

                        <div class="mt-4">
                            <x-label for="voter_member_of_bar_association" value="Voter Member of Bar Association" />
                            <x-input id="voter_member_of_bar_association" type="text"
                                name="voter_member_of_bar_association" class="mt-1 block w-full"
                                :value="old('voter_member_of_bar_association')" placeholder="Optional" />
                        </div>

                        <div class="mt-4">
                            <x-label for="permanent_member_of_bar_association"
                                value="Permanent Member of Bar Association" />
                            <x-input id="permanent_member_of_bar_association" type="text"
                                name="permanent_member_of_bar_association" class="mt-1 block w-full"
                                :value="old('permanent_member_of_bar_association')" placeholder="Optional" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-button class="ml-4">
                                Create Advocate
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>