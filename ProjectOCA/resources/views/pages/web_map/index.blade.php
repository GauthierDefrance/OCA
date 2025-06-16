@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.map.page_name"))
@section("meta_desc", __("pages.map.page_description"))
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")
    <!--- <script src="/js/app.js" defer></script> le defer est important ! --->

@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>@lang("pages.map.title")</h1>
    <section class="sitemap" style="background-color: #1e293b">
        <ul class="sitemap__list">
            {{-- Section principale --}}
            <li class="sitemap__item">
                <a href="{{ route('home') }}" class="sitemap__link">
                    <img src="/icons/house.svg" alt="Home" width="20" height="20" class="icon" />
                    @lang("pages.map.home")
                </a>
            </li>
            <li class="sitemap__item">
                <a href="{{ route('about.index') }}" class="sitemap__link">
                    <img src="/icons/info.svg" alt="About" width="20" height="20" class="icon" />
                    @lang("pages.map.about")
                </a>
            </li>
            <li class="sitemap__item">
                <a href="{{ route('contact.index') }}" class="sitemap__link">
                    <img src="/icons/phone.svg" alt="Contact" width="20" height="20" class="icon" />
                    @lang("pages.map.contact")
                </a>
            </li>
            <li class="sitemap__item">
                <a href="{{ route('stats.index') }}" class="sitemap__link">
                    <img src="/icons/stats.svg" alt="Stats" width="20" height="20" class="icon" />
                    @lang("pages.map.stats")
                </a>
            </li>

            {{-- Authentification --}}
            <li class="sitemap__item">
                <a href="{{ route('connect') }}" class="sitemap__link">
                    <img src="/icons/login.svg" alt="Sign In" width="20" height="20" class="icon" />
                    @lang("pages.map.signin")
                </a>
                <ul class="sitemap__sublist">
                    <li class="sitemap__subitem">
                        <a href="{{ route('connect.check_email') }}" class="sitemap__link">
                            @lang("pages.map.email_check")
                        </a>
                    </li>
                    <li class="sitemap__subitem">
                        <a href="{{ route('connect.ask_check_email') }}" class="sitemap__link">
                            @lang("pages.map.email_send")
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Fonctions de discussion --}}
            <li class="sitemap__item">
                <a href="{{ route('channels.index') }}" class="sitemap__link">
                    <img src="/icons/chats.svg" alt="Channels" width="20" height="20" class="icon" />
                    @lang("pages.map.channels")
                </a>
                <ul class="sitemap__sublist">
                    <li class="sitemap__subitem">
                        <a href="{{ route('channels.idchannels.add', ['id' => 'xx']) }}" class="sitemap__link">
                            <img src="/icons/user-plus.svg" alt="Charts" width="20" height="20" class="icon"/>
                            @lang("pages.map.add")
                        </a>
                    </li>
                    <li class="sitemap__subitem">
                        <a href="{{ route('channels.idchannels.list', ['id' => 'xx']) }}" class="sitemap__link">
                            <img src="/icons/group.svg" alt="Charts" width="20" height="20" class="icon"/>
                            @lang("pages.map.members_list")
                        </a>
                    </li>
                    <li class="sitemap__subitem">
                        <a href="{{ route('channels.idchannels.quit', ['id' => 'xx']) }}" class="sitemap__link">
                            <img src="/icons/door-open.svg" alt="Charts" width="20" height="20" class="icon"/>
                            @lang("pages.map.quit")
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Contenu --}}
            <li class="sitemap__item">
                <a href="{{ route('articles.index') }}" class="sitemap__link">
                    <img src="/icons/article.svg" alt="Articles" width="20" height="20" class="icon" />
                    @lang("pages.map.articles")
                </a>
            </li>

            {{-- Outils --}}
            <li class="sitemap__item">
                <a href="{{ route('map.index') }}" class="sitemap__link">
                    <img src="/icons/map.svg" alt="Map" width="20" height="20" class="icon" />
                    @lang("pages.map.map")
                </a>
            </li>
            <li class="sitemap__item">
                <a href="{{ route('tech.index') }}" class="sitemap__link">
                    <img src="/icons/wrench.svg" alt="Tech" width="20" height="20" class="icon" />
                    @lang("pages.map.tech")
                </a>
            </li>

            {{-- Admin --}}
            <li class="sitemap__item">
                <a href="{{ route('admin.index') }}" class="sitemap__link">
                    <img src="/icons/admin.svg" alt="Admin" width="20" height="20" class="icon" />
                    @lang("pages.map.admin")
                </a>
            </li>
        </ul>

    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
