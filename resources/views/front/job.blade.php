@extends('front.layout.app')

{{-- @section('seo_title')
    {{ $other_page_item->job_listing_page_title }}
@endsection
@section('seo_meta_description')
    {{ $other_page_item->job_listing_page_meta_description }}
@endsection --}}

@section('main_content')

    <div class="page-top page-top-job-single">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 job job-single">
                    <div class="item d-flex justify-content-start">
                        <div class="logo">
                            <img src="{{ asset('uploads/' . $job_single->getCompany->logo) }}" alt="" />
                        </div>
                        <div class="text">
                            <h3>{{ $job_single->title }}, {{ $job_single->getCompany->company_name }}</h3>
                            <div class="detail-1 d-flex justify-content-start">
                                <div class="category">
                                    {{ $job_single->getJobCategory->name }}
                                </div>
                                <div class="location">
                                    {{ $job_single->getJobLocation->name }}
                                </div>
                            </div>
                            <div class="detail-2 d-flex justify-content-start">
                                <div class="date">
                                    {{ $job_single->created_at->diffForHumans() }}
                                </div>
                                <div class="budget">
                                    {{ $job_single->getJobSalaryRange->name }}
                                </div>
                                @if (date('Y-m-d') > $job_single->deadline)
                                    <div class="expired">
                                        Expired
                                    </div>
                                @endif
                            </div>
                            <div class="special d-flex justify-content-start">
                                @if ($job_single->is_featured == 1)
                                    <div class="featured">
                                        Featured
                                    </div>
                                @endif
                                <div class="type">
                                    {{ $job_single->getJobType->name }}
                                </div>
                                @if ($job_single->is_urgent == 1)
                                    <div class="urgent">
                                        Urgent
                                    </div>
                                @endif
                            </div>

                            @if (!Auth::guard('company')->check())
                                <div class="apply">
                                    @if (date('Y-m-d') <= $job_single->deadline)
                                        <a href="{{ route('candidate_apply', $job_single->id) }}"
                                            class="btn btn-primary">Apply Now</a>
                                        <a href="{{ route('candidate_bookmark_add', $job_single->id) }} }}"
                                            class="btn btn-primary save-job">
                                            Bookmark
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="job-result pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    @if ($job_single->description != null)
                        <div class="left-item">
                            <h2><i class="fas fa-file-invoice"></i> Description</h2>
                            <p>{!! $job_single->description !!}</p>
                        </div>
                    @endif

                    @if ($job_single->responsibility != null)
                        <div class="left-item">
                            <h2><i class="fas fa-file-invoice"></i> Job Responsibilities</h2>
                            {!! $job_single->responsibility !!}
                        </div>
                    @endif

                    @if ($job_single->skill != null)
                        <div class="left-item">
                            <h2><i class="fas fa-file-invoice"></i> Skills and Abilities</h2>
                            {!! $job_single->skill !!}
                        </div>
                    @endif

                    @if ($job_single->education != null)
                        <div class="left-item">
                            <h2><i class="fas fa-file-invoice"></i> Educational Qualification</h2>
                            {!! $job_single->education !!}
                        </div>
                    @endif

                    @if ($job_single->benefit != null)
                        <div class="left-item">
                            <h2><i class="fas fa-file-invoice"></i> Benefits</h2>
                            {!! $job_single->benefit !!}
                        </div>
                    @endif

                    @if (date('Y-m-d') <= $job_single->deadline)
                        <div class="left-item">
                            <div class="apply">
                                <a href="apply.html" class="btn btn-primary">Apply Now</a>
                            </div>
                        </div>
                    @endif

                    <div class="left-item">
                        <h2><i class="fas fa-file-invoice"></i> Related Jobs</h2>
                        <div class="job related-job pt-0 pb-0">
                            <div class="container">
                                <div class="row">

                                    @php $i=0; @endphp
                                    @foreach ($related_jobs as $item)
                                        @if ($item->id == $job_single->id)
                                            @continue
                                        @endif
                                        @php $i++; @endphp
                                        <div class="col-md-12">
                                            <div class="item d-flex justify-content-start">
                                                <div class="logo">
                                                    <img src="{{ asset('uploads/' . $item->getCompany->logo) }}"
                                                        alt="">
                                                </div>
                                                <div class="text">
                                                    <h3><a href="{{ route('job', $item->id) }}">{{ $item->title }},
                                                            {{ $item->getCompany->company_name }}</a></h3>
                                                    <div class="detail-1 d-flex justify-content-start">
                                                        <div class="category">
                                                            {{ $item->getJobCategory->name }}
                                                        </div>
                                                        <div class="location">
                                                            {{ $item->getJobLocation->name }}
                                                        </div>
                                                    </div>
                                                    <div class="detail-2 d-flex justify-content-start">
                                                        <div class="date">
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </div>
                                                        <div class="budget">
                                                            {{ $item->getJobSalaryRange->name }}
                                                        </div>
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
                                                    @if (Auth::guard('candidate')->check())
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
                                    @if ($i == 0)
                                        <div class="text-danger">No Result Found</div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="right-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Job Summary
                        </h2>
                        <div class="summary">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><b>Published On:</b></td>
                                        <td>{{ $job_single->created_at->format('d F, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Deadline:</b></td>
                                        <td>
                                            @php
                                                $dt = DateTime::createFromFormat('Y-m-d', $job_single->deadline);
                                            @endphp
                                            {{ $dt->format('d F, Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Vacancy:</b></td>
                                        <td>{{ $job_single->vacancy }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Category:</b></td>
                                        <td>{{ $job_single->getJobCategory->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Location:</b></td>
                                        <td>{{ $job_single->getJobLocation->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Type:</b></td>
                                        <td>{{ $job_single->getJobType->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Experience:</b></td>
                                        <td>{{ $job_single->getJobExperience->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Gender:</b></td>
                                        <td>{{ $job_single->getJobGender->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Salary Range:</b></td>
                                        <td>{{ $job_single->getJobSalaryRange->name }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="right-item">
                        <h2><i class="fas fa-file-invoice"></i> Enquery Form</h2>
                        <div class="enquery-form">
                            <form action="{{ route('job_enquery_send_email') }}" method="post">
                                @csrf
                                <input type="hidden" name="company_email" value="{{ $job_single->getCompany->email }}">
                                <input type="hidden" name="job_title" value="{{ $job_single->title }}">

                                <div class="mb-3">
                                    <input type="text" name="visitor_name" class="form-control" placeholder="Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="visitor_email" class="form-control"
                                        placeholder="Email Address">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="visitor_phone" class="form-control"
                                        placeholder="Phone Number">
                                </div>
                                <div class="mb-3">
                                    <textarea name="visitor_message" class="form-control h-150" rows="3" placeholder="Message"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if ($job_single->map_code != null)
                        <div class="right-item">
                            <h2><i class="fas fa-file-invoice"></i> Location Map</h2>
                            <div class="location-map">
                                {!! $job_single->map_code !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
