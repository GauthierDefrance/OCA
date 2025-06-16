<footer>
    @yield("footer")
    <strong>OCA</strong> made by <strong>Gauthier Defrance</strong>
    <hr/>

    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="/">
                    <img src="/icons/house.svg" alt="House" width="24" height="24" class="icon"/>
                    @lang("partial.header.Home")
                </a></li>

            <li><a href="/about">
                    <img src="/icons/info.svg" alt="Info" width="24" height="24" class="icon"/>
                    @lang("partial.footer.about")
                </a></li>

            <li><a href="/contact">
                    <img src="/icons/phone.svg" alt="Phone" width="24" height="24" class="icon"/>
                    @lang("partial.footer.contact")
                </a></li>

            <li><a href="/articles">
                    <img src="/icons/article.svg" alt="Newspapers" width="24" height="24" class="icon"/>
                    @lang("partial.footer.articles")
                </a></li>

            <li><a href="/stats">
                    <img src="/icons/stats.svg" alt="Charts" width="24" height="24" class="icon"/>
                    @lang("partial.footer.stats")
                </a></li>
        </ul>
    </nav>
    <hr/>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="/map">
                    <img src="/icons/map.svg" alt="Map" width="24" height="24" class="icon"/>
                    @lang("partial.footer.webmap")
                </a></li>

            <li><a href="/tech">
                    <img src="/icons/wrench.svg" alt="WrenchAndScrews" width="24" height="24" class="icon"/>
                    @lang("partial.footer.techpage")
                </a></li>
        </ul>
    </nav>

    <hr/>

    <div class="group">
        <section class="colonne">
            <h2>@lang("partial.footer.findme")</h2>
            <nav class="nav-horizontale">
                <a href="https://github.com/GauthierDefrance" class="white"><img src="/icons/github.svg" alt="Github Logo" width="32" height="32" class="round"></a>
                <a href="https://www.youtube.com/@gauthierdefrance6143" class="red"><img src="/icons/youtube.svg" alt="Youtube Logo" width="32" height="32" class="round"></a>
            </nav>
        </section>
    </div>


    <p class="left">©OCA 2025 </p>
</footer>
