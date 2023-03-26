<div class="navbar-area" id="stickymenu">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="uploads/logo.png" alt="" />
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="index.html">
                    <img src="uploads/logo.png" alt="" />
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ route('home') }}" class="nav-link ">Home</a>
                        </li>
                        <li
                            class="nav-item {{ (Request::is('job-listing') ? 'active' : '' || Request::is('job/*')) ? 'active' : '' }}">
                            <a href="{{ route('job_listing') }}" class="nav-link ">
                                Find Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a href="companies.html" class="nav-link">Companies</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pricing') }}" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="faq.html" class="nav-link">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="blog.html" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.html" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
