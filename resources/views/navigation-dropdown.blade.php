<nav x-data="{ open: false }" class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
    <!-- Primary Navigation Menu -->
    {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16"> --}}
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 text-white mr-6">
                    <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
                    <span class="font-semibold text-xl tracking-tight">Tailwind CSS</span>
                  </div>
                  <div class="block lg:hidden">
                    <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                      <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                  </div>
                  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div class="text-sm lg:flex-grow">
                      <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                        Docs
                      </a>
                      <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                        Examples
                      </a>
                      <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
                        Blog
                      </a>
                    </div>

                    @if (Route::has('login'))
                      <div>
                          @auth
                          <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ optional(Auth::user())->profile_photo_url }}" alt="{{ optional(Auth::user())->name }}" />
                                            </button>
                                        @else
                                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                <div>{{ optional(Auth::user())->name }}</div>

                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Account') }}
                                        </div>

                                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Profile') }}
                                        </x-jet-dropdown-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                                {{ __('API Tokens') }}
                                            </x-jet-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Management -->
                                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>

                                            <!-- Team Settings -->
                                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                {{ __('Team Settings') }}
                                            </x-jet-dropdown-link>

                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                                    {{ __('Create New Team') }}
                                                </x-jet-dropdown-link>
                                            @endcan

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-jet-switchable-team :team="$team" />
                                            @endforeach

                                            <div class="border-t border-gray-100"></div>
                                        @endif

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                            this.closest('form').submit();">
                                                {{ __('Logout') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>

                            <!-- Hamburger -->
                            <div class="-mr-2 flex items-center sm:hidden">
                                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                              <!-- Responsive Navigation Menu -->
                            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                                <div class="pt-2 pb-3 space-y-1">
                                    <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-jet-responsive-nav-link>
                                </div>

                                <!-- Responsive Settings Options -->
                                <div class="pt-4 pb-1 border-t border-gray-200">
                                    <div class="flex items-center px-4">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="{{ optional(Auth::user())->profile_photo_url }}" alt="{{ optional(Auth::user())->name }}" />
                                        </div>

                                        <div class="ml-3">
                                            <div class="font-medium text-base text-gray-800">{{ optional(Auth::user())->name }}</div>
                                            <div class="font-medium text-sm text-gray-500">{{ optional(Auth::user())->email }}</div>
                                        </div>
                                    </div>

                                    <div class="mt-3 space-y-1">
                                        <!-- Account Management -->
                                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                            {{ __('Profile') }}
                                        </x-jet-responsive-nav-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                                {{ __('API Tokens') }}
                                            </x-jet-responsive-nav-link>
                                        @endif

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                {{ __('Logout') }}
                                            </x-jet-responsive-nav-link>
                                        </form>

                                        <!-- Team Management -->
                                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>

                                            <!-- Team Settings -->
                                            <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                                {{ __('Team Settings') }}
                                            </x-jet-responsive-nav-link>

                                            <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                                {{ __('Create New Team') }}
                                            </x-jet-responsive-nav-link>

                                            <div class="border-t border-gray-200"></div>

                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                          @else
                              <a href="{{ route('login') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white ml-4">Login</a>

                              @if (Route::has('register'))
                                  <a href="{{ route('register') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Register</a>
                              @endif
                          @endif
                      </div>
                  @endif
                </div>
        {{-- </div>
    </div> --}}


</nav>

