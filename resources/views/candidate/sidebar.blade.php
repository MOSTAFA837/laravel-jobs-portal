<ul class="list-group list-group-flush">
    <li class="list-group-item {{ Request::is('candidate/dashboard') ? 'active' : '' }}">
        <a href="{{ route('candidate_dashboard') }}">Dashboard</a>
    </li>


    {{-- <li class="list-group-item {{ Request::is('candidate/applications') ? 'active' : '' }}">
        <a href="{{ route('candidate_applications') }}">Applied Jobs</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/bookmark-view') ? 'active' : '' }}">
        <a href="{{ route('candidate_bookmark_view') }}">Bookmarked Jobs</a>
    </li>


    <li class="list-group-item {{ Request::is('candidate/experience/view') ? 'active' : '' }}">
        <a href="{{ route('candidate_experience') }}">Work Experience</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/award/view') ? 'active' : '' }}">
        <a href="{{ route('candidate_award') }}">Awards</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/resume/view') ? 'active' : '' }}">
        <a href="{{ route('candidate_resume') }}">Resume Upload</a>
    </li>
    --}}

    <li class="list-group-item {{ Request::is('candidate/education/*') ? 'active' : '' }}">
        <a href="{{ route('candidate_education') }}">
            Education
        </a>
    </li>

    <li class="list-group-item {{ Request::is('candidate/skill/*') ? 'active' : '' }}">
        <a href="{{ route('candidate_skill') }}">
            Skills
        </a>
    </li>

    <li class="list-group-item {{ Request::is('candidate/edit-profile') ? 'active' : '' }}">
        <a href="{{ route('candidate_edit_profile') }}">
            Edit Profile
        </a>
    </li>

    <li class="list-group-item {{ Request::is('candidate/edit-password') ? 'active' : '' }}">
        <a href="{{ route('candidate_edit_password') }}">
            Edit Password
        </a>
    </li>

    <li class="list-group-item">
        <a href="{{ route('candidate_logout') }}">Logout</a>
    </li>
</ul>
