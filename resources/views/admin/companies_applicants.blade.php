@extends('admin.layout.app')

@section('heading', 'Applicants for job: ' . $job_detail->title)

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
                                        <th>Status</th>
                                        <th>Detail</th>
                                        <th>CV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach ($applicants as $item)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->getCandidate->name }}</td>
                                            <td>{{ $item->getCandidate->email }}</td>
                                            <td>{{ $item->getCandidate->phone }}</td>
                                            <td>
                                                @if ($item->status == 'Applied')
                                                    @php $color="primary"; @endphp
                                                @elseif($item->status == 'Approved')
                                                    @php $color="success"; @endphp
                                                @elseif($item->status == 'Rejected')
                                                    @php $color="danger"; @endphp
                                                @endif
                                                <span class="badge bg-{{ $color }}">{{ $item->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_companies_applicant_resume', $item->candidate_id) }}"
                                                    class="badge bg-primary text-white" target="_blank">Detail</a>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $i }}">CV</a>

                                                <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cover
                                                                    Letter</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! nl2br($item->cover_letter) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
