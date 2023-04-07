<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/home') ? 'active' : '' }}">
                <a class="nav-link" href="index.html" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Dashboard">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/home-page') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Pages</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="active">
                        <a class="nav-link" href="{{ route('admin_home_page') }}">
                            <i class="fas fa-angle-right"></i>
                            Home
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">
                            <i class="fas fa-angle-right"></i>
                            Terms
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="nav-item dropdown {{ (((((Request::is('admin/job-category/*') ? 'active' : '' || Request::is('admin/job-gender/*')) ? 'active' : '' || Request::is('admin/job-experience/*')) ? 'active' : '' || Request::is('admin/job-location/*')) ? 'active' : '' || Request::is('admin/job-type/*')) ? 'active' : '' || Request::is('admin/job-salary-range/*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Job Section</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/job-category/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_category') }}">
                            <i class="fas fa-angle-right"></i>
                            Job Category
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/job-location/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_location') }}">
                            <i class="fas fa-angle-right"></i>
                            Job Location
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/job-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_type') }}">
                            <i class="fas fa-angle-right"></i>
                            Job Type
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/job-experience/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_experience') }}">
                            <i class="fas fa-angle-right"></i>
                            Job Experience
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/job-gender/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_gender') }}">
                            <i class="fas fa-angle-right"></i>
                            Job Gender
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/job-salary-range/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_salary_range') }}">
                            <i class="fas fa-angle-right"></i>
                            Job Salary Range
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="nav-item dropdown {{ (Request::is('admin/company-location/*') ? 'active' : '' || Request::is('admin/company-industry/*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Company Section</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/company-location/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_company_location') }}">
                            <i class="fas fa-angle-right"></i>
                            Location
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/company-industry/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_company_industry') }}">
                            <i class="fas fa-angle-right"></i>
                            Industry
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/company-size/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_company_size') }}">
                            <i class="fas fa-angle-right"></i>
                            Size
                        </a>
                    </li>
                </ul>
            </li>


            <li class="{{ Request::is('admin/why-choose/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_why_choose_item') }}">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Why Choose Items</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/package/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_package') }}">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Package</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/companies/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_companies') }}">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Company Profile</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/candidates') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_candidates') }}">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Candidate Profile</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
