@extends('admin.layout.app')

@section('heading', 'Companies Detail')

@section('button')
    <div>
        <a href="{{ route('admin_companies') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
    </div>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th class="w_200">Logo</th>
                                    <td>
                                        <img src="{{ asset('uploads/' . $company_details->logo) }}" alt=""
                                            class="w_100">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w_200">Company Name</th>
                                    <td>{{ $company_details->company_name }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Person Name</th>
                                    <td>{{ $company_details->person_name }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Username</th>
                                    <td>{{ $company_details->username }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Email</th>
                                    <td>{{ $company_details->email }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Phone</th>
                                    <td>{{ $company_details->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Address</th>
                                    <td>{{ $company_details->address }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Industry</th>
                                    <td>{{ $company_details->getCompanyIndustry->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Location</th>
                                    <td>{{ $company_details->getCompanyLocation->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Size</th>
                                    <td>{{ $company_details->getCompanySize->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Founded On</th>
                                    <td>{{ $company_details->founded_on }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Website</th>
                                    <td>{{ $company_details->website }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Description</th>
                                    <td>{!! $company_details->description !!}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Opening Hours</th>
                                    <td>
                                        Monday: {{ $company_details->oh_mon }}<br>
                                        Tuesday: {{ $company_details->oh_tue }}<br>
                                        Wednesday: {{ $company_details->oh_wed }}<br>
                                        Thursday: {{ $company_details->oh_thu }}<br>
                                        Friday: {{ $company_details->oh_fri }}<br>
                                        Saturday: {{ $company_details->oh_sat }}<br>
                                        Sunday: {{ $company_details->oh_sun }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w_200">Facebook</th>
                                    <td>{{ $company_details->facebook }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Twitter</th>
                                    <td>{{ $company_details->twitter }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Linkedin</th>
                                    <td>{{ $company_details->linkedin }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Instagram</th>
                                    <td>{{ $company_details->instagram }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Google Map</th>
                                    <td>{!! $company_details->map_code !!}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Photos</th>
                                    <td>
                                        @foreach ($photos as $item)
                                            <img src="{{ asset('uploads/' . $item->photo) }}" alt=""
                                                class="w_300">
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
