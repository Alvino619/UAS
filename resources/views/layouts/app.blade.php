<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO dan Performance improvements -->
    <meta name="description" content="@yield('meta_description', 'EduApp - Platform pembelajaran online terpercaya')">
    <meta name="keywords" content="@yield('meta_keywords', 'education, learning, courses, online learning')">
    
    <title>{{ config('app.name', 'EduMate') }} - @yield('title')</title>
    
    <!-- Preload critical resources untuk performance -->
    {{-- <link rel="preload" href="{{ asset('fonts/inter-var.woff2') }}" as="font" type="font/woff2" crossorigin> --}}
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- CSS untuk smooth transitions dan improved animations -->
    <style>
        /* Smooth transitions untuk semua interactive elements */
        * {
            transition: all 0.2s ease-in-out;
        }
        
        /* Custom focus styles untuk accessibility */
        .focus-visible:focus {
            outline: 2px solid #4f46e5;
            outline-offset: 2px;
        }
        
        /* Improved dropdown animations */
        .dropdown-enter {
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .dropdown-enter-active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Loading state untuk buttons */
        .btn-loading {
            pointer-events: none;
            opacity: 0.6;
        }
        
        /* Improved mobile menu animations */
        .mobile-menu-transition {
            transition: max-height 0.3s ease-in-out;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen">
    <!-- Skip to content link untuk accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-indigo-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Navigation dengan improved accessibility dan responsive design -->
    <nav class="bg-white shadow-sm sticky top-0 z-40" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo dengan improved accessibility -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" 
                           class="text-xl font-bold text-indigo-600 hover:text-indigo-700 focus-visible:focus rounded-md px-2 py-1"
                           aria-label="EduApp - Go to homepage">
                            <span class="sr-only">EduApp</span>
                            <svg class="h-8 w-8 mr-2 inline-block" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7V10C2 16 6 20.5 12 22C18 20.5 22 16 22 10V7L12 2Z"/>
                            </svg>
                            EduApp
                        </a>
                    </div>
                    
                    <!-- Navigation Links dengan improved active state detection -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8" role="menubar">
                        @php
                            $currentRoute = request()->route()->getName();
                        @endphp
                        
                        <a href="{{ route('home') }}" 
                           class="@if($currentRoute === 'home') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium focus-visible:focus rounded-t-md"
                           role="menuitem"
                           @if($currentRoute === 'home') aria-current="page" @endif>
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Home
                        </a>
                        
                        <a href="{{ route('courses.index') }}" 
                           class="@if(str_contains($currentRoute, 'courses')) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium focus-visible:focus rounded-t-md"
                           role="menuitem"
                           @if(str_contains($currentRoute, 'courses')) aria-current="page" @endif>
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Courses
                        </a>
                        
                        @auth
                            <a href="{{ route('dashboard') }}" 
                               class="@if($currentRoute === 'dashboard') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium focus-visible:focus rounded-t-md"
                               role="menuitem"
                               @if($currentRoute === 'dashboard') aria-current="page" @endif>
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Dashboard
                            </a>
                        @endauth
                    </div>
                </div>
                
                <!-- Right Side Of Navbar dengan improved accessibility -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @guest
                        <a href="{{ route('login') }}" 
                           class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium rounded-md focus-visible:focus">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Register
                        </a>
                    @else
                        <!-- Notifications button (new feature) -->
                        <button type="button" 
                                class="relative p-2 text-gray-400 hover:text-gray-500 focus-visible:focus rounded-full"
                                aria-label="View notifications">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <!-- Notification badge -->
                            <span class="absolute -top-1 -right-1 h-3 w-3 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Profile dropdown dengan improved accessibility -->
                        <div class="ml-3 relative">
                            <div>
                                <button type="button" 
                                        class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:ring-2 hover:ring-offset-2 hover:ring-indigo-300" 
                                        id="user-menu-button" 
                                        aria-expanded="false" 
                                        aria-haspopup="true"
                                        aria-label="Open user menu">
                                    <span class="sr-only">Open user menu</span>
                                    @if(auth()->user()->avatar)
                                        <img class="h-8 w-8 rounded-full object-cover" 
                                             src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                             alt="{{ auth()->user()->name }}'s avatar">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </button>
                            </div>
                            
                            <!-- Dropdown menu dengan improved animations -->
                            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden opacity-0 scale-95" 
                                 role="menu" 
                                 id="user-menu"
                                 aria-orientation="vertical"
                                 aria-labelledby="user-menu-button">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('dashboard') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none" 
                                   role="menuitem">
                                    <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="#" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none" 
                                   role="menuitem">
                                    <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Profile Settings
                                </a>
                                <div class="border-t border-gray-100 mt-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50 focus:bg-red-50 focus:outline-none" 
                                            role="menuitem">
                                        <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
                
                <!-- Mobile menu button dengan improved accessibility -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" 
                            id="mobile-menu-button"
                            aria-expanded="false"
                            aria-controls="mobile-menu"
                            aria-label="Open main menu">
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger icon -->
                        <svg class="block h-6 w-6" id="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close icon (hidden by default) -->
                        <svg class="hidden h-6 w-6" id="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu dengan improved UX -->
        <div class="sm:hidden hidden mobile-menu-transition" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1 bg-gray-50 border-t border-gray-200">
                <a href="{{ route('home') }}" 
                   class="@if($currentRoute === 'home') bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
                   @if($currentRoute === 'home') aria-current="page" @endif>
                    <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home
                </a>
                <a href="{{ route('courses.index') }}" 
                   class="@if(str_contains($currentRoute, 'courses')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
                   @if(str_contains($currentRoute, 'courses')) aria-current="page" @endif>
                    <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Courses
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="@if($currentRoute === 'dashboard') bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
                       @if($currentRoute === 'dashboard') aria-current="page" @endif>
                        <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Dashboard
                    </a>
                @endauth
            </div>
            
            @guest
                <div class="pt-4 pb-3 border-t border-gray-200 bg-white">
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('login') }}" 
                           class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="flex items-center px-4 py-2 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 mx-4 rounded-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Register
                        </a>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-3 border-t border-gray-200 bg-white">
                    <div class="flex items-center px-4 mb-3">
                        @if(auth()->user()->avatar)
                            <img class="h-10 w-10 rounded-full object-cover" 
                                 src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                 alt="{{ auth()->user()->name }}'s avatar">
                        @else
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-semibold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Dashboard
                        </a>
                        <a href="#" 
                           class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Profile Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center w-full px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </nav>

    <!-- Page Content dengan improved semantic structure -->
    <main id="main-content" role="main">
        <!-- Flash Messages dengan improved styling -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button type="button" class="inline-flex text-green-400 hover:text-green-600" onclick="this.parentElement.parentElement.parentElement.style.display='none'">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button type="button" class="inline-flex text-red-400 hover:text-red-600" onclick="this.parentElement.parentElement.parentElement.style.display='none'">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main content area -->
        @yield('content')
    </main>

    <!-- Footer dengan improved design dan accessibility -->
    <footer class="bg-white border-t border-gray-200 mt-12" role="contentinfo">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <!-- Footer navigation -->
            <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer navigation">
                <div class="px-5 py-2">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors focus-visible:focus rounded-md px-2 py-1">About</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors focus-visible:focus rounded-md px-2 py-1">Blog</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors focus-visible:focus rounded-md px-2 py-1">Privacy</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors focus-visible:focus rounded-md px-2 py-1">Terms</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors focus-visible:focus rounded-md px-2 py-1">Contact</a>
                </div>
            </nav>
            
            <!-- Social media links -->
            <div class="mt-8 flex justify-center space-x-6">
                <a href="#" class="text-gray-400 hover:text-gray-500 transition-colors" aria-label="Facebook">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500 transition-colors" aria-label="Twitter">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500 transition-colors" aria-label="LinkedIn">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
            </div>
            
            <!-- Copyright -->
            <p class="mt-8 text-center text-gray-400">
                &copy; {{ date('Y') }} EduApp. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Back to top button -->
    <button id="back-to-top" 
            class="fixed bottom-4 right-4 bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 opacity-0 invisible"
            aria-label="Back to top">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Improved JavaScript dengan better performance dan accessibility -->
    <script>
        // Improved mobile menu toggle dengan accessibility
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileMenuButton.addEventListener('click', function() {
            const isOpen = !mobileMenu.classList.contains('hidden');
            
            if (isOpen) {
                // Close menu
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            } else {
                // Open menu
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'true');
            }
        });

        // Improved user dropdown toggle dengan smooth animations
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        if (userMenuButton && userMenu) {
            userMenuButton.addEventListener('click', function() {
                const isOpen = !userMenu.classList.contains('hidden');
                
                if (isOpen) {
                    // Close dropdown
                    userMenu.classList.add('hidden', 'opacity-0', 'scale-95');
                    userMenu.classList.remove('opacity-100', 'scale-100');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                } else {
                    // Open dropdown
                    userMenu.classList.remove('hidden', 'opacity-0', 'scale-95');
                    userMenu.classList.add('opacity-100', 'scale-100');
                    userMenuButton.setAttribute('aria-expanded', 'true');
                }
            });
        }

        // Close dropdowns when clicking outside dengan improved performance
        document.addEventListener('click', function(event) {
            // Close user dropdown
            if (userMenuButton && userMenu && 
                !userMenuButton.contains(event.target) && 
                !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden', 'opacity-0', 'scale-95');
                userMenu.classList.remove('opacity-100', 'scale-100');
                userMenuButton.setAttribute('aria-expanded', 'false');
            }
            
            // Close mobile menu
            if (!mobileMenuButton.contains(event.target) && 
                !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });

        // Keyboard navigation support
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                // Close all dropdowns on Escape key
                if (userMenu && !userMenu.classList.contains('hidden')) {
                    userMenu.classList.add('hidden', 'opacity-0', 'scale-95');
                    userMenu.classList.remove('opacity-100', 'scale-100');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                    userMenuButton.focus();
                }
                
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                    mobileMenuButton.focus();
                }
            }
        });

        // Back to top button functionality
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Flash message auto-dismiss
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                if (alert.style.display !== 'none') {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 300);
                }
            });
        }, 5000);

        // Improved focus management untuk accessibility
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Tab') {
                // Add visible focus indicator
                event.target.classList.add('focus-visible');
            }
        });

        document.addEventListener('mousedown', function(event) {
            // Remove focus indicator when clicking
            event.target.classList.remove('focus-visible');
        });

        // Preload hover states untuk better UX
        const hoverElements = document.querySelectorAll('a, button');
        hoverElements.forEach(function(element) {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Performance optimization: debounce scroll events
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Apply debounce to scroll events
        window.addEventListener('scroll', debounce(function() {
            // Scroll-based functionality here
            const scrolled = window.pageYOffset;
            const navbar = document.querySelector('nav');
            
            if (scrolled > 50) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }
        }, 10));
    </script>
</body>
</html>