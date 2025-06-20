@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.about.title"))
@section("meta_desc", __("pages.about.meta_desc"))
@section("meta_author", __("pages.about.meta_author"))

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
    <h1>@lang('pages.about.main_title')</h1>
    <section>
        <h2>@lang('pages.about.what_i_learned_title')</h2>
        <p>@lang('pages.about.what_i_learned_text')</p>

        <h2>@lang('pages.about.project_features_title')</h2>
        <p>@lang('pages.about.project_features_intro')</p>
        <ul>
            <li>@lang('pages.about.feature_registration_login')</li>
            <li>@lang('pages.about.feature_update_account')</li>
            <li>@lang('pages.about.feature_multilanguage')</li>
            <li>@lang('pages.about.feature_discussion_groups')</li>
            <li>@lang('pages.about.feature_realtime_messaging')</li>
            <li>@lang('pages.about.feature_realtime_group_invites')</li>
            <li>@lang('pages.about.feature_system_messages')</li>
            <li>@lang('pages.about.feature_dynamic_statistics')</li>
            <li>@lang('pages.about.feature_dynamic_articles')</li>
            <li>@lang('pages.about.feature_admin_panel')</li>
            <li>@lang('pages.about.feature_data_cleanup')</li>
            <li>@lang('pages.about.feature_two_factor_auth')</li>
        </ul>

        <h2>@lang('pages.about.conclusion_title')</h2>
        <p>@lang('pages.about.conclusion_text')</p>

        <h3>@lang('pages.about.source_inspiration_title')</h3>
        <p>@lang('pages.about.source_inspiration_text')</p>
    </section>
@endsection
<!-- End Main -->

<!-- Footer -->
@section("footer")
@endsection
<!-- End Footer -->
