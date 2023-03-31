@extends('front.layout.app')

{{-- @section('seo_title')
    {{ $home_page_data->title }}
@endsection
@section('seo_meta_description')
    {{ $home_page_data->meta_description }}
@endsection --}}

@section('main_content')
    <div class="slider" style="background-image: url({{ asset('uploads/' . $home_page_data->background) }})">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="item">
                        <div class="text">
                            <h2>{{ $home_page_data->heading }}</h2>

                            <p>{!! $home_page_data->text !!}</p>
                        </div>

                        <div class="search-section">
                            <form action="{{ url('job-listing') }}" method="get">
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="{{ $home_page_data->job_title }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select name="location" class="form-select select2">
                                                    <option value="">
                                                        {{ $home_page_data->job_location }}
                                                    </option>

                                                    @foreach ($job_locations as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select name="category" class="form-select select2">
                                                    <option value="">
                                                        {{ $home_page_data->job_category }}
                                                    </option>

                                                    @foreach ($all_job_categories as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="hidden" name="type" value="">
                                            <input type="hidden" name="experience" value="">
                                            <input type="hidden" name="gender" value="">
                                            <input type="hidden" name="salary_range" value="">

                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                                {{ $home_page_data->search }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($home_page_data->job_category_status == 'show')
        <div class="job-category">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $home_page_data->job_category_heading }}</h2>
                            <p>
                                {{ $home_page_data->job_category_subheading }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($job_categories as $item)
                        {{-- @if ($item->get_jobs_count) --}}
                        <div class="col-md-4">
                            <div class="item">
                                <div class="icon">
                                    <i class="{{ $item->icon }}"></i>
                                </div>
                                <h3>{{ $item->name }}</h3>
                                <p>({{ $item->get_jobs_count }} Open Positions)</p>
                                <a href="{{ url('job-listing?category=' . $item->id) }}"></a>
                            </div>
                        </div>
                        {{-- @endif --}}
                    @endforeach
                </div>

                @if ($all_job_categories->count() > 6)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="all">
                                <a href="{{ route('job_categories') }}" class="btn btn-primary">See All Categories</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif


    {{-- <div class="why-choose" style="background-image: url(uploads/banner3.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h2>Why Choose Us</h2>
                        <p>
                            Our Methods to help you build your career in
                            future
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($why_choose_items as $item)
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $item->heading }}</h2>
                                <p>{!! nl2br($item->text) !!} </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}


    <div class="job">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h2>Featured Jobs</h2>
                        <p>Find the awesome jobs that matches your skill</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($featured_jobs as $item)
                    <div class="col-lg-6 col-md-12">
                        <div class="item d-flex justify-content-start">
                            <div class="logo">
                                <img src="{{ asset('uploads/' . $item->getCompany->logo) }}" alt="" />
                            </div>
                            <div class="text">
                                <h3>
                                    <a href="{{ route('job', $item->id) }}">{{ $item->title }},
                                        {{ $item->getCompany->company_name }}</a>
                                </h3>
                                <div class="detail-1 d-flex justify-content-start">
                                    <div class="category"> {{ $item->getJobCategory->name }}</div>
                                    <div class="location">{{ $item->getJobLocation->name }}</div>
                                </div>
                                <div class="detail-2 d-flex justify-content-start">
                                    <div class="date">{{ $item->created_at->diffForHumans() }}</div>
                                    <div class="budget">{{ $item->getJobSalaryRange->name }}</div>

                                    @if (date('Y-m-d') > $item->deadline)
                                        <div class="expired">
                                            Expired
                                        </div>
                                    @endif
                                </div>
                                <div class="special d-flex justify-content-start">
                                    @if ($item->is_featured == 1)
                                        <div class="featured">
                                            Featured
                                        </div>
                                    @endif

                                    <div class="type">
                                        {{ $item->getJobType->name }}
                                    </div>

                                    @if ($item->is_urgent == 1)
                                        <div class="urgent">
                                            Urgent
                                        </div>
                                    @endif
                                </div>

                                @if (Auth::guard('candidate')->check() && !Auth::guard('company')->check())
                                    @php
                                        $is_bookmarked = \App\Models\CandidateBookmark::where('candidate_id', Auth::guard('candidate')->user()->id)
                                            ->where('job_id', $item->id)
                                            ->count();
                                        
                                        if ($is_bookmarked) {
                                            $bookmark_status = 'active';
                                        } else {
                                            $bookmark_status = '';
                                        }
                                    @endphp

                                    <div class="bookmark">
                                        <a href="{{ route('candidate_bookmark_add', $item->id) }}">
                                            <i class="fas fa-bookmark {{ $bookmark_status }}"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($featured_jobs_count > 6)
                <div class="row">
                    <div class="col-md-12">
                        <div class="all">
                            <a href="{{ route('job_listing') }}" class="btn btn-primary">See All Jobs</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>



    {{-- <div class="testimonial" style="background-image: url(uploads/banner11.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="main-header">Our Happy Clients</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-carousel owl-carousel">
                        <div class="item">
                            <div class="photo">
                                <img src="uploads/t1.jpg" alt="" />
                            </div>
                            <div class="text">
                                <h4>Robert Krol</h4>
                                <p>CEO, ABC Company</p>
                            </div>
                            <div class="description">
                                <p>
                                    Lorem ipsum dolor sit amet, an labores
                                    explicari qui, eu nostrum copiosae
                                    argumentum has. Latine propriae quo no,
                                    unum ridens. Lorem ipsum dolor sit amet,
                                    an labores explicari qui, eu nostrum
                                    copiosae argumentum has. Latine propriae
                                    quo no, unum ridens.
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="photo">
                                <img src="uploads/t2.jpg" alt="" />
                            </div>
                            <div class="text">
                                <h4>Sal Harvey</h4>
                                <p>Director, DEF Company</p>
                            </div>
                            <div class="description">
                                <p>
                                    Lorem ipsum dolor sit amet, an labores
                                    explicari qui, eu nostrum copiosae
                                    argumentum has. Latine propriae quo no,
                                    unum ridens. Lorem ipsum dolor sit amet,
                                    an labores explicari qui, eu nostrum
                                    copiosae argumentum has. Latine propriae
                                    quo no, unum ridens.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h2>Latest News</h2>
                        <p>
                            Check our latest news from the following section
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="photo">
                            <img src="uploads/banner1.jpg" alt="" />
                        </div>
                        <div class="text">
                            <h2>
                                <a href="post.html">This is a sample blog post title</a>
                            </h2>
                            <div class="short-des">
                                <p>
                                    Lorem ipsum dolor sit amet, nibh saperet
                                    te pri, at nam diceret disputationi. Quo
                                    an consul impedit, usu possim evertitur
                                    dissentiet ei.
                                </p>
                            </div>
                            <div class="button">
                                <a href="post.html" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="photo">
                            <img src="uploads/banner2.jpg" alt="" />
                        </div>
                        <div class="text">
                            <h2>
                                <a href="post.html">This is a sample blog post title</a>
                            </h2>
                            <div class="short-des">
                                <p>
                                    Nec in rebum primis causae. Affert
                                    iisque ex pri, vis utinam vivendo
                                    definitionem ad, nostrum omnes que per
                                    et. Omnium antiopam.
                                </p>
                            </div>
                            <div class="button">
                                <a href="post.html" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="photo">
                            <img src="uploads/banner3.jpg" alt="" />
                        </div>
                        <div class="text">
                            <h2>
                                <a href="post.html">This is a sample blog post title</a>
                            </h2>
                            <div class="short-des">
                                <p>
                                    Id pri placerat voluptatum, vero dicunt
                                    dissentiunt eum et, adhuc iisque vis no.
                                    Eu suavitate conten tiones definitionem
                                    mel, ex vide.
                                </p>
                            </div>
                            <div class="button">
                                <a href="post.html" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
