@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.stats.page_name"))
@section("meta_desc", __("pages.stats.page_description"))
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")
    <script>
        window.chartData = {
            // Utilisateurs
            usersPerDay: {
                labels: @json($stats['usersPerDay']->pluck('day')),
                data: @json($stats['usersPerDay']->pluck('total')),
            },
            usersPerMonth: {
                labels: @json($stats['usersPerMonth']->pluck('month')),
                data: @json($stats['usersPerMonth']->pluck('total')),
            },

            // Messages
            messagesPerDay: {
                labels: @json($stats['messagesPerDay']->pluck('day')),
                data: @json($stats['messagesPerDay']->pluck('total')),
            },
            messagesPerMonth: {
                labels: @json($stats['messagesPerMonth']->pluck('month')),
                data: @json($stats['messagesPerMonth']->pluck('total')),
            },

            // Conversations
            conversationsPerDay: {
                labels: @json($stats['conversationsPerDay']->pluck('day')),
                data: @json($stats['conversationsPerDay']->pluck('total')),
            },
            conversationsPerMonth: {
                labels: @json($stats['conversationsPerMonth']->pluck('month')),
                data: @json($stats['conversationsPerMonth']->pluck('total')),
            },
        };
        window.chartLabels = {
            users_day: @json(__('stats.users_day')),
            messages_day: @json(__('stats.messages_day')),
            conversations_day: @json(__('stats.conversations_day')),

            users_month: @json(__('stats.users_month')),
            messages_month: @json(__('stats.messages_month')),
            conversations_month: @json(__('stats.conversations_month')),
        };
    </script>
    <!--- <script src="/js/app.js" defer></script> le defer est important ! --->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/js/stats/stats.js'])
@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>@lang("pages.stats.title")</h1>
    <section>
        <h2>@lang("pages.stats.big_nb")</h2>
        <p><strong>{{ $stats['nb_users'] }}</strong> @lang("pages.stats.nb_users")</p>
        <p><strong>{{ $stats['nb_conversations'] }}</strong> @lang("pages.stats.nb_conversations")</p>
        <p>@lang("pages.stats.and") <strong>{{ $stats['nb_messages'] }}</strong> @lang("pages.stats.nb_messages")</p>
        <p>@lang("pages.stats.also") <strong>{{ $stats['active_users'] }}</strong> @lang("pages.stats.users_online")</p>
    </section>

    <section>
        <h2>@lang("pages.stats.charts")</h2>
        <h3>@lang("pages.stats.per_days")</h3>
        <canvas id="combinedPerDayChart"></canvas>
        <h3>@lang("pages.stats.per_months")</h3>
        <canvas id="combinedPerMonthChart"></canvas>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
