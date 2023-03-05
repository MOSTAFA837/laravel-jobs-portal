@extends('front.layout.app')

{{-- @section('seo_title')
    {{ $job_category_page_item->title }}
@endsection
@section('seo_meta_description')
    {{ $job_category_page_item->meta_description }}
@endsection --}}

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Job Categories</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="job-category">
        <div class="container">
            <div class="row">
                @foreach ($job_categories as $item)
                    <div class="col-md-4">
                        <div class="item">
                            <div class="icon">
                                <i class="{{ $item->icon }}"></i>
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p>(5 Open Positions)</p>
                            {{-- <a href="{{ url('job-listing?category=' . $item->id) }}"></a> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
