@extends('admin.layout.app')

@section('heading', 'Candidates')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Username</th>
                                        <th>Detail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>
                                                <a href="{{ route('admin_candidate_details', $item->id) }}"
                                                    class="badge bg-primary text-white w-100 mb-1">Detail</a>
                                                <a href="{{ route('admin_candidate_applied_jobs', $item->id) }}"
                                                    class="badge bg-primary text-white w-100 mb-1">Applied Jobs</a>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_candidate_delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onClick="return confirm('Are you sure?');">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
