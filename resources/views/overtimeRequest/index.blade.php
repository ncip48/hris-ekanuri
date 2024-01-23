@extends('layouts.admin')

@section('page-title')
    {{ __('Overtime Request') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Overtime Request') }}</li>
@endsection


@section('action-btn')
    <div class="float-end">
        @can('create overtime request')
            <a href="#" data-size="xl" data-url="{{ route('overtime-request.create') }}" data-ajax-popup="true"
                data-title="{{ __('Create Overtime Request') }}" data-bs-toggle="tooltip" title="{{ __('Create') }}"
                class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Note') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($overtimeRequests as $overtime)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- @auth('web')
                                            <td>{{ \App\Utility::getDateFormated($overtime->created_at) }}</td>
                                        @endauth --}}
                                        <td>{{ \App\Utility::getDateFormated($overtime->created_at) }}</td>
                                      
                                        <td>{{ $overtime->note }}</td>
                                        <td>
                                            @if ($overtime->status == 'Pending')
                                                <div class="status-badge color-2">
                                                    {{ $overtime->status }}
                                                </div>
                                            @elseif ($overtime->status == 'Approved')
                                                <div class="status-badge color-1">
                                                    {{ $overtime->status }}
                                                </div>
                                            @elseif ($overtime->status == 'Rejected')
                                                <div class="status-badge color-3">
                                                    {{ $overtime->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @can('edit overtime request')
                                                <a href="#" data-size="xl" data-url="{{ route('overtime-request.edit', $overtime->id) }}"
                                                    data-ajax-popup="true" data-title="{{ __('Edit Overtime Request') }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="ti-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @can('delete overtime request')
                                                <a href="#" class="btn btn-sm btn-danger delete-confirm"
                                                    data-url="{{ route('overtime-request.destroy', $overtime->id) }}">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            @endcan
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
@endsection
