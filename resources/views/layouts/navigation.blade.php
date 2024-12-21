<nav x-data="{ open: false, userMenu: false }" class="navbar">
    <style>
        .navbar {
            width: 100%;
            height: 75px;
            margin: auto;
            padding: 15px 0;
        }
        
        .icon {
            float: left;
            margin-left: 30px;
        }
        
        .logo {
            color: #ff7200;
            font-size: 35px;
            font-family: Arial;
            padding-left: 20px;
            float: left;
            padding-top: 10px;
        }
        
        .menu {
            float: left;
            margin-left: 50px;
        }
        
        .menu ul {
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }
        
        .menu ul li {
            list-style: none;
            margin-left: 62px;
            margin-top: 27px;
            font-size: 14px;
        }
        
        .menu ul li a {
            text-decoration: none;
            color: #333;
            font-family: Arial;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }
        .menu ul li a.active {
            color: #ff7200;
        }
        
        .menu ul li a:hover {
            color: #ff7200;
        }
        
        .search {
            float: right;
            margin-right: 30px;
            margin-top: 20px;
        }
        
        .srch {
            font-family: 'Times New Roman';
            width: 200px;
            height: 40px;
            background: #e8e3df;
            border: none;
            margin-right: 10px;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
        }
        
        .btn {
            width: 100px;
            height: 40px;
            background: #ff7200;
            border: none;
            color: #fff;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .btn:hover {
            background: #ff7200;
        }

        /* User Menu Styles */
        .user-menu {
            float: right;
            margin-right: 20px;
            margin-top: 20px;
            position: relative;
        }

        .user-menu-button {
            background: transparent;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
        }

        .user-menu-button:hover {
            background: #f5f5f5;
            color: #ff7200;
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 5px;
            z-index: 1000;
        }

        .user-dropdown a,
        .user-dropdown button {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            width: 100%;
            text-align: left;
            border: none;
            background: none;
            font-size: 14px;
        }

        .user-dropdown a:hover,
        .user-dropdown button:hover {
            background: #f5f5f5;
            color: #ff7200;
        }
        
        @media (max-width: 768px) {
            .menu-mobile {
                display: block;
                margin-top: 20px;
                width: 100%;
            }
            
            .menu {
                display: none;
            }
            
            .search {
                width: 100%;
                margin: 20px 0;
                text-align: center;
            }
            
            .srch {
                width: 60%;
            }

            .user-menu {
                display: none;
            }
        }
    </style>

    <div class="icon">
        <h2 class="logo">LMS</h2>
    </div>

    <!-- Desktop Menu -->
    <div class="menu hidden md:block">
    <ul>
        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">HOME</a></li>
        <li><a href="{{ route('achievements') }}" class="{{ request()->routeIs('achievements') ? 'active' : '' }}">ACHIEVEMENTS</a></li>
        <li><a href="{{ route('courses') }}" class="{{ request()->routeIs('courses') ? 'active' : '' }}">COURSES & WORKSHOPS</a></li>
        <li><a href="{{ route('internships') }}" class="{{ request()->routeIs('internships') ? 'active' : '' }}">INTERNSHIPS</a></li>
        <li><a href="{{ route('publications') }}" class="{{ request()->routeIs('publications') ? 'active' : '' }}">PUBLICATIONS</a></li>
    </ul>
    </div>

    

    <!-- User Menu (Desktop) -->
    @auth
    <div class="user-menu hidden md:block">
        <button @click="userMenu = !userMenu" class="user-menu-button">
            <span>{{ Auth::user()->name }}</span>
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="userMenu" @click.away="userMenu = false" class="user-dropdown">
            <a href="{{ route('profile.edit') }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Log Out</button>
            </form>
            <a href="#">Contact us</a>
        </div>
    </div>
    @endauth

    <!-- Mobile menu button -->
    <div class="md:hidden absolute right-4 top-4">
        <button @click="open = !open" class="text-gray-800 p-2">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden menu-mobile">
        <ul class="flex flex-col space-y-4 px-4">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">HOME</a></li>
            <li><a href="{{ route('achievements')}}" class="{{ request()->routeIs('achievements') ? 'active' : '' }}">ACHIEVEMENTS</a></li>
            <li><a href="{{ route('courses') }}"class="{{ request()->routeIs('courses') ? 'active' : '' }}">COURSES & WORKSHOPS</a></li>
            <li><a href="{{ route('internships') }}"class="{{ request()->routeIs('internships') ? 'active' : '' }}">INTERNSHIPS</a></li>
            <li><a href="{{ route('publications') }}"class="{{ request()->routeIs('publications') ? 'active' : '' }}">PUBLICATIONS</a></li>
        </ul>
        
        <div class="search">
            <input class="srch" type="search" placeholder="Type To text">
            <button class="btn">Search</button>
        </div>

        <!-- Authentication for mobile -->
        @auth
            <div class="mt-4 px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <a href="{{ route('profile.edit') }}" class="block mt-2 text-gray-600">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block mt-2 text-gray-600">Log Out</button>
                </form>
            </div>
        @endauth
    </div>
</nav>