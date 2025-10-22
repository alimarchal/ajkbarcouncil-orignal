<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJK Bar Council Members Directory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Google Search Box Styles */
        .search-container {
            width: 100%;
            max-width: 584px;
            margin: 0 auto;
        }

        .search-box {
            width: 100%;
            height: 44px;
            background: #fff;
            display: flex;
            border: 1px solid #dfe1e5;
            box-shadow: 0 1px 3px rgba(32, 33, 36, 0.1);
            border-radius: 24px;
            z-index: 3;
            transition: box-shadow 0.2s, border-color 0.2s;
            align-items: center;
            padding: 0 14px;
        }

        .search-box:hover {
            box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
            border-color: rgba(223, 225, 229, 0);
        }

        .search-box-focused {
            box-shadow: 0 2px 8px rgba(32, 33, 36, 0.35);
            border-color: rgba(223, 225, 229, 0);
        }

        .search-icon {
            color: #9aa0a6;
            height: 20px;
            width: 20px;
            margin-right: 13px;
            flex-shrink: 0;
        }

        .search-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
            color: #202124;
            padding: 0;
            font-family: arial, sans-serif;
        }

        .search-input:focus {
            outline: none;
            border: none;
            box-shadow: none;
        }

        .clear-icon {
            padding: 0 8px;
            cursor: pointer;
            color: #70757a;
            height: 20px;
            width: 20px;
            display: none;
        }

        .search-input:not(:placeholder-shown)~.clear-icon {
            display: block;
        }

        .voice-icon {
            height: 24px;
            width: 24px;
            cursor: pointer;
            color: #4285f4;
            margin-left: 8px;
        }

        /* Google Button Styles */
        .button-container {
            padding-top: 18px;
            text-align: center;
        }

        .google-button {
            background-color: #f8f9fa;
            border: 1px solid #f8f9fa;
            border-radius: 4px;
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
            display: inline-block;
        }

        .google-button:hover {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            border: 1px solid #dadce0;
            color: #202124;
        }

        /* Dark mode styles */
        .dark .search-box {
            background: #303134;
            border: 1px solid #5f6368;
        }

        .dark .search-box:hover {
            background: #303134;
            box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
            border-color: rgba(0, 0, 0, 0.0);
        }

        .dark .search-input {
            color: #e8eaed;
        }

        .dark .google-button {
            background-color: #303134;
            border: 1px solid #303134;
            color: #e8eaed;
        }

        .dark .google-button:hover {
            border: 1px solid #5f6368;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        /* Advanced Search Styles */
        .advanced-search {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.4s ease, opacity 0.3s ease, margin-top 0.3s ease;
            margin-top: 0;
        }

        .advanced-search.open {
            max-height: 1000px;
            opacity: 1;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .advanced-search-container {
            background: #fff;
            border: 1px solid #dfe1e5;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            max-width: 75%;
            margin: 0 auto;
        }

        .advanced-search-title {
            margin: 0 0 24px 0;
            font-size: 18px;
            color: #202124;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .advanced-search-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .advanced-search-field {
            position: relative;
        }

        .advanced-search-label {
            display: block;
            font-size: 13px;
            color: #5f6368;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .advanced-search-input,
        .advanced-search-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #dfe1e5;
            border-radius: 6px;
            font-size: 14px;
            font-family: arial, sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
            color: #202124;
        }

        .advanced-search-input:focus,
        .advanced-search-select:focus {
            outline: none;
            border-color: #4285f4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }

        .advanced-search-input:hover,
        .advanced-search-select:hover {
            border-color: #4285f4;
        }

        .advanced-button {
            background-color: #1a73e8;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-family: arial, sans-serif;
            font-size: 14px;
            font-weight: 500;
            padding: 10px 24px;
            cursor: pointer;
            transition: background-color 0.2s, box-shadow 0.2s;
            margin-top: 16px;
        }

        .advanced-button:hover {
            background-color: #1765cc;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .advanced-button:active {
            background-color: #1557b0;
        }

        /* Results Header (Small Search Box) */
        .results-header {
            padding: 12px 20px 0 180px;
        }

        .results-search-box {
            height: 44px;
            max-width: 584px;
            background: #fff;
            display: flex;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            align-items: center;
            padding: 0 14px;
        }

        .results-search-box:hover {
            box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        }

        /* Navigation Tabs */
        .nav-tabs {
            padding: 0 20px 0 180px;
            border-bottom: 1px solid #e8eaed;
        }

        .nav-tab {
            display: inline-flex;
            align-items: center;
            color: #5f6368;
            padding: 12px 12px 10px 12px;
            font-size: 13px;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            margin-right: 22px;
        }

        .nav-tab:hover {
            color: #202124;
        }

        .nav-tab.active {
            color: #1a73e8;
            border-bottom-color: #1a73e8;
        }

        .nav-tab svg {
            height: 16px;
            width: 16px;
            margin-right: 6px;
        }

        /* Results Styles */
        .results-container {
            padding: 20px 20px 0 180px;
            max-width: 652px;
        }

        .results-count {
            color: #70757a;
            font-size: 14px;
            margin-bottom: 26px;
        }

        .result-item {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #e8eaed;
            position: relative;
        }

        .result-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: -180px;
            right: -9999px;
            height: 1px;
            background-color: #e8eaed;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-item:last-child::after {
            display: none;
        }

        .result-url {
            display: flex;
            align-items: center;
            font-size: 16px;
            line-height: 1.3;
            margin-bottom: 6px;
        }

        .result-url-text {
            color: #202124;
            font-weight: 500;
        }

        .result-title {
            font-size: 24px;
            line-height: 1.3;
            font-weight: normal;
            margin: 0 0 8px 0;
            padding: 0;
        }

        .result-title a {
            color: #1a0dab;
            text-decoration: none;
            cursor: pointer;
            font-weight: 400;
            font-size: 24px;
        }

        .result-title a:visited {
            color: #681da8;
        }

        .result-title a:hover {
            text-decoration: underline;
        }

        .result-snippet {
            color: #4d5156;
            font-size: 16px;
            line-height: 1.6;
            word-wrap: break-word;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            margin-left: 8px;
        }

        .badge-active {
            background-color: #e6f4ea;
            color: #137333;
        }

        .badge-inactive {
            background-color: #fce8e6;
            color: #c5221f;
        }

        /* No Results */
        .no-results {
            padding: 100px 20px 0 180px;
            max-width: 652px;
        }

        .no-results-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .no-results-text {
            color: #70757a;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .no-results-suggestions {
            color: #70757a;
            font-size: 14px;
            line-height: 1.58;
        }

        /* Footer */
        .footer {
            background: #f2f2f2;
            border-top: 1px solid #e4e4e4;
            width: 100%;
            margin-top: auto;
        }

        .footer-location {
            padding: 15px 30px;
            border-bottom: 1px solid #dadce0;
            font-size: 15px;
            color: #70757a;
        }

        .footer-links {
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #70757a;
            font-size: 14px;
            text-decoration: none;
            padding: 0 15px;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        /* Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            height: 150px;
            width: 200px;
            object-fit: contain;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .results-header,
            .nav-tabs,
            .results-container,
            .no-results {
                padding-left: 20px;
            }

            .advanced-search-container {
                max-width: 95%;
            }

            .advanced-search-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900">
    <div style="flex: 1;">
        @if (!$hasSearch)
        <!-- Home Page - Exact Google Style -->
        <div style="padding-top: 8vh;">
            <!-- Logo -->
            <div class="logo-container">
                <a href="{{ route('public.advocates.index') }}">
                    <img src="{{ asset('icons-images/logo.jpg') }}" alt="AJK Bar Council Logo" class="logo">
                </a>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('public.advocates.index') }}">
                <div class="search-container">
                    <!-- Search Box -->
                    <div class="search-box" id="searchBox">
                        <svg class="search-icon" focusable="false" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                            </path>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                            title="Search" autocomplete="off" id="searchInput" autofocus
                            placeholder="Search advocates by name, mobile, email...">
                        <span class="clear-icon" id="clearButton"
                            onclick="document.getElementById('searchInput').value=''; this.style.display='none';">
                            <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                height="20">
                                <path fill="currentColor"
                                    d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <!-- Buttons -->
                    <div class="button-container">
                        <button type="submit" class="google-button">
                            Search Members
                        </button>
                        <button type="button" onclick="toggleAdvanced()" class="google-button">
                            Advanced Search
                        </button>
                    </div>
                </div>

                <!-- Advanced Filters -->
                <div id="advancedFilters" class="advanced-search">
                    <div class="advanced-search-container">
                        <h3 class="advanced-search-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z" fill="#5f6368" />
                            </svg>
                            Advanced Search Options
                        </h3>
                        <div class="advanced-search-grid">
                            <div class="advanced-search-field">
                                <label class="advanced-search-label">📱 Mobile Number</label>
                                <input type="text" name="filter[mobile_no]" value="{{ request('filter.mobile_no') }}"
                                    class="advanced-search-input" placeholder="Enter mobile number">
                            </div>
                            <div class="advanced-search-field">
                                <label class="advanced-search-label">✉️ Email Address</label>
                                <input type="email" name="filter[email_address]"
                                    value="{{ request('filter.email_address') }}" class="advanced-search-input"
                                    placeholder="Enter email address">
                            </div>
                            <div class="advanced-search-field">
                                <label class="advanced-search-label">🏛️ Bar Association</label>
                                <select name="filter[bar_association_id]" class="advanced-search-select">
                                    <option value="">All Associations</option>
                                    @foreach ($barAssociations as $ba)
                                    <option value="{{ $ba->id }}" {{ request('filter.bar_association_id')==$ba->id
                                        ? 'selected' : '' }}>
                                        {{ $ba->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="advanced-search-field">
                                <label class="advanced-search-label">👤 Father's Name</label>
                                <input type="text" name="filter[father_husband_name]"
                                    value="{{ request('filter.father_husband_name') }}" class="advanced-search-input"
                                    placeholder="Enter father's name">
                            </div>
                        </div>
                        <div
                            style="text-align: right; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e8eaed;">
                            <button type="button" onclick="toggleAdvanced()"
                                style="background: transparent; border: 1px solid #dadce0; border-radius: 4px; color: #5f6368; font-size: 14px; padding: 8px 16px; cursor: pointer; margin-right: 8px;">
                                Cancel
                            </button>
                            <button type="submit" class="advanced-button">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @else
        <!-- Results Page - Google Style -->
        <div style="padding: 20px 0;">
            <!-- Results Header with Search Box -->
            <form method="GET" action="{{ route('public.advocates.index') }}">
                <div class="results-header" style="display: flex; align-items: center; gap: 32px;">
                    <!-- Logo -->
                    <a href="{{ route('public.advocates.index') }}" style="flex-shrink: 0;">
                        <img src="{{ asset('icons-images/logo.jpg') }}" alt="Logo"
                            style="height: 40px; width: 40px; object-fit: contain;">
                    </a>

                    <!-- Search Box -->
                    <div class="results-search-box" style="flex: 1;">
                        <svg class="search-icon" focusable="false" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                            </path>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                            autocomplete="off">
                        @if(request('search'))
                        <a href="{{ route('public.advocates.index') }}" style="padding: 0 8px;">
                            <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                height="20">
                                <path fill="#70757a"
                                    d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">
                                </path>
                            </svg>
                        </a>
                        @endif
                        <button type="submit" style="background: none; border: none; padding: 0 8px; cursor: pointer;">
                            <svg class="search-icon" focusable="false" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path fill="#4285f4"
                                    d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Hidden filters -->
                @foreach(request('filter', []) as $key => $value)
                <input type="hidden" name="filter[{{ $key }}]" value="{{ $value }}">
                @endforeach
            </form>

            <!-- Navigation Tabs -->
            <div class="nav-tabs">
                <a href="#" class="nav-tab active">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    All
                </a>
            </div>

            <!-- Results -->
            @if (count($advocates) > 0)
            <div class="results-container">
                <!-- Results Count -->
                <div class="results-count">
                    About {{ number_format($advocates->total()) }} results
                </div>

                <!-- Results List -->
                @foreach ($advocates as $advocate)
                <div class="result-item">
                    <!-- URL/Bar Association -->
                    <div class="result-url">
                        <span class="result-url-text" style="color: #dc2626;">{{ $advocate->barAssociation->name ??
                            'N/A' }}</span>
                        @if($advocate->permanent_member_of_bar_association)
                        <span style="color: #70757a; margin: 0 4px;">›</span>
                        <span style="color: #70757a;">{{ $advocate->permanent_member_of_bar_association }}</span>
                        @endif
                    </div>

                    <!-- Title/Name -->
                    <h3 class="result-title">
                        <a href="{{ route('public.advocates.show', $advocate->id) }}"
                            style="display: inline-flex; align-items: center; gap: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" style="width: 20px; height: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $advocate->name }}</span>
                        </a>
                        <span class="badge {{ $advocate->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $advocate->is_active ? '✓ Active' : '✗ Inactive' }}
                        </span>
                    </h3>

                    <!-- Snippet/Description -->
                    <div class="result-snippet">
                        @if($advocate->mobile_no || $advocate->email_address)
                        <div style="margin-bottom: 8px; display: flex; gap: 20px; flex-wrap: wrap;">
                            @if($advocate->mobile_no)
                            <a href="tel:{{ $advocate->mobile_no }}"
                                style="color: #1a0dab; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                                <span>📱</span>
                                <span><strong>Mobile:</strong> {{ $advocate->mobile_no }}</span>
                            </a>
                            @endif
                            @if($advocate->email_address)
                            <a href="mailto:{{ $advocate->email_address }}"
                                style="color: #1a0dab; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                                <span>✉️</span>
                                <span><strong>Email:</strong> {{ $advocate->email_address }}</span>
                            </a>
                            @endif
                        </div>
                        @endif

                        @if($advocate->father_husband_name)
                        <div style="margin-bottom: 6px;"><strong>Son/Daughter/Father:</strong> {{
                            $advocate->father_husband_name }}
                        </div>
                        @endif

                        @if($advocate->date_of_enrolment_lower_courts || $advocate->date_of_enrolment_high_court ||
                        $advocate->date_of_enrolment_supreme_court)
                        <div style="color: #5f6368; margin-top: 8px; line-height: 1.8;">
                            @if($advocate->date_of_enrolment_lower_courts)
                            <div><strong>Lower Courts:</strong> {{ $advocate->date_of_enrolment_lower_courts->format('M
                                d, Y') }}</div>
                            @endif
                            @if($advocate->date_of_enrolment_high_court)
                            <div><strong>High Court:</strong> {{ $advocate->date_of_enrolment_high_court->format('M d,
                                Y') }}</div>
                            @endif
                            @if($advocate->date_of_enrolment_supreme_court)
                            <div><strong>Supreme Court:</strong> {{
                                $advocate->date_of_enrolment_supreme_court->format('M d, Y') }}</div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div style="margin-top: 40px;">
                    {{ $advocates->onEachSide(1)->links() }}
                </div>
            </div>
            @endif

            <!-- No Results -->
            @if (count($advocates) === 0)
            <div class="no-results">
                <div class="no-results-icon">🔍</div>
                <div class="no-results-text">
                    Your search - <strong>{{ request('search') }}</strong> - did not match any members.
                </div>
                <div class="no-results-suggestions">
                    <p style="margin: 10px 0;"><strong>Suggestions:</strong></p>
                    <ul style="margin: 0; padding-left: 20px; line-height: 1.8;">
                        <li>Make sure all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        <li>Try using the advanced search options.</li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-location" style="text-align: center">
            Azad Jammu and Kashmir Bar Council - Member Directory
        </div>
        <div class="footer-links">
            <div>
                <a href="#" class="footer-link">Home</a>
                <a href="#" class="footer-link">Advertising</a>
                <a href="#" class="footer-link">Business</a>
                <a href="#" class="footer-link">How Search works</a>
            </div>
            <div>
                <a href="#" class="footer-link">Privacy</a>
                <a href="#" class="footer-link">Terms</a>
                <a href="#" class="footer-link">Settings</a>
            </div>
        </div>
    </div>

    <script>
        // Search box focus effect
        const searchBox = document.getElementById('searchBox');
        const searchInput = document.getElementById('searchInput');
        const clearButton = document.getElementById('clearButton');

        if (searchInput) {
            searchInput.addEventListener('focus', function () {
                if (searchBox) {
                    searchBox.classList.add('search-box-focused');
                }
            });

            searchInput.addEventListener('blur', function () {
                if (searchBox) {
                    searchBox.classList.remove('search-box-focused');
                }
            });

            searchInput.addEventListener('input', function () {
                if (clearButton) {
                    clearButton.style.display = this.value ? 'block' : 'none';
                }
            });
        }

        // Toggle advanced search
        function toggleAdvanced() {
            const filters = document.getElementById('advancedFilters');
            if (filters) {
                filters.classList.toggle('open');
            }
        }
    </script>

</body>

</html>