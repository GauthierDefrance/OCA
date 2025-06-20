<header>
    @yield('header')
    <a href="/" class="sub-border"><img src="{{url("img/website_logo.png")}}" alt="Website logo"/></a>

    <nav class="navbar">
        <ul class="nav-links">
            @auth
                @if(auth()->user()->is_admin)
                    <li><a href="/admin">
                            <img src="/icons/admin.svg" alt="Admin" width="24" height="24" class="icon"/>
                            {{ __("partial.header.Admin") }}
                        </a></li>
                @endif
                <li><a href="/channels">
                        <img src="/icons/chats.svg" alt="Conversation" width="24" height="24" class="icon"/>
                        {{ __("partial.header.Channels") }}
                    </a></li>

                <li><a href="/account">
                        <img src="/icons/user.svg" alt="User" width="24" height="24" class="icon"/>
                        {{ __("partial.header.Accounts") }}
                    </a></li>
            @endauth
        </ul>
    </nav>

    <nav class="navbar">
        <ul class="nav-links">
            @guest
                <li><a href="/connect">
                        <img src="/icons/login.svg" alt="Login" width="24" height="24" class="icon"/>
                        {{ __("partial.header.Connection") }}
                    </a></li>
            @endguest
            @auth
                <li><a href="/connect/logout">
                        <img src="/icons/logout.svg" alt="Logout" width="24" height="24" class="icon"/>
                        {{ __("partial.header.logout") }}
                    </a></li>
            @endauth

            <!-- Bouton langues -->
            <li class="dropdown">

                <div class="dropbtn">
                    <img src="/icons/language.svg" alt="Language" width="24" height="24" class="icon"/>
                    {{ __("partial.header.language") }}
                </div>

                <ul class="dropdown-content">
                    <li><a href="locale/fr">
                            <img src="/icons/france-flag.svg" alt="FranceFlag" width="24" height="24" class="icon"/>
                            {{ __("partial.header.french") }}
                        </a></li>
                    <li><a href="locale/en">
                            <img src="/icons/uk-flag.svg" alt="EnglishFlag" width="24" height="24" class="icon"/>
                            {{ __("partial.header.english") }}
                        </a></li>
                    <li><a href="locale/es">
                            <img src="/icons/spain-flag.svg" alt="SpainFlag" width="24" height="24" class="icon"/>
                            {{ __("partial.header.spanish") }}
                        </a></li>
                    <li><a href="locale/ch">
                            <img src="/icons/china-flag.svg" alt="SpainFlag" width="24" height="24" class="icon"/>
                            {{ __("partial.header.chinese") }}
                        </a></li>
                </ul>
            </li>

        </ul>
    </nav>


</header>
