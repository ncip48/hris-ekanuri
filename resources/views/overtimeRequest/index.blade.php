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
                                    <th>{{ __('Date Of Filling') }}</th>
                                    <th>{{ __('Employee') }}</th>
                                    {{-- <th>{{ __('Note') }}</th> --}}
                                    <th>{{ __('Status') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($overtimes as $overtime)
                                    @php

                                        $createdDate = date('d M Y', strtotime($overtime->created_at));
                                        // dd($createdDate);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>

                                        <td>{{ $createdDate }}</td>
                                        <td>{{ $overtime->employee->name }}</td>

                                        {{-- <td>{{ $overtime->note }}</td> --}}
                                        <td>
                                            @if ($overtime->status == 'Pending')
                                                <div class="status_badge badge bg-warning p-2 px-3 rounded">
                                                    {{ $overtime->status }}
                                                </div>
                                            @elseif ($overtime->status == 'Approved')
                                                <div class="status_badge badge bg-success p-2 px-3 rounded">
                                                    {{ $overtime->status }}
                                                </div>
                                                {{-- @elseif ($overtime->status == 'Rejected') --}}
                                            @else
                                                <div class="status_badge badge bg-danger p-2 px-3 rounded">
                                                    {{ $overtime->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @can('show overtime request')
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="#" data-size="xl" data-ajax-popup="true"
                                                        data-title="{{ __('Overtime Request Details') }}"
                                                        data-url="{{ route('overtime-request.show', $overtime->id) }}"
                                                        class="mx-3 btn btn-sm  align-items-center">
                                                        <i class="ti ti-caret-right text-white"></i> </a>
                                                </div>
                                            @endcan

                                            {{-- @can('edit overtime request')
                                                <a href="#" data-size="xl"
                                                    data-url="{{ route('overtime-request.edit', $overtime->id) }}"
                                                    data-ajax-popup="true" data-title="{{ __('Edit Overtime Request') }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="ti ti-pencil-alt text-white"></i>
                                                </a>
                                            @endcan --}}
                                            @can('delete overtime request')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['overtime-request.destroy', $overtime->id],
                                                        'id' => 'delete-form-' . $overtime->id,
                                                    ]) !!}
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                        data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                        data-original-title="{{ __('Delete') }}"
                                                        data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-form-{{ $overtime->id }}').submit();">
                                                        <i class="ti ti-trash text-white"></i></a>

                                                    {!! Form::close() !!}
                                                </div>
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
