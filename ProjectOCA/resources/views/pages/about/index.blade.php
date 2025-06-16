@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
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
    <h1>About This Project</h1>
    <section>
        <h2>What I Learned</h2>
        <p>
            During the development of this project, I deepened my knowledge in several areas including the Laravel framework,
            PostgreSQL databases, and WebSockets using Reverb. Additionally, I improved my skills in PHP and JavaScript,
            which allowed me to build a fully functional and interactive web application.
        </p>

        <h2>Project Features</h2>
        <p>This website includes the following key features:</p>
        <ul>
            <li>User registration and login system, allowing users to create accounts and securely access the site.</li>
            <li>Ability for users to update their username and password directly on the site.</li>
            <li>A multi-language system that is easy to extend to support additional languages.</li>
            <li>A system to create and manage discussion groups, where users can communicate in real-time.</li>
            <li>Real-time messaging within groups, powered by WebSockets, enabling automatic message updates without page refreshes.</li>
            <li>Real-time updates for group invitations, so users are notified instantly when invited to a group.</li>
            <li>System messages within groups that notify members of important events such as users joining, leaving, being invited, or being removed from the group.</li>
            <li>A dynamic statistics page that displays live data about site usage and activity.</li>
            <li>An articles page with content that updates dynamically as new articles are published.</li>
            <li>A secure admin panel that allows administrators to ban, unban, delete users, and create new articles.</li>
            <li>Additional features like automatic cleanup of unused data in memory — for example, removing messages and groups when no members remain.</li>
            <li>An enhanced account creation process including two-factor authentication via a confirmation code sent by email.</li>
        </ul>

        <h2>Conclusion</h2>
        <p>
            This project has been an enriching experience, combining multiple technologies and concepts to build a complex,
            real-time web application with strong user management and administration features. It reflects not only what
            I have learned but also my passion for creating useful and interactive web solutions.
        </p>

        <h3>Source & Inspiration</h3>
        <p>
            Inspired and based on the official Laravel documentation and community packages related to WebSockets and
            multi-language support.
        </p>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
