@extends('layouts.admin')
@section('page-title')
    {{ __('Employee Schedule') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Employee Schedule') }}</li>
@endsection


@section('action-btn')
    <div class="float-end">
        <a href="#" data-size="lg" data-url="{{ route('employee-schedule.create') }}" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="{{ __('Create New Schedule') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
        {{-- <a href="#" data-size="md"  data-bs-toggle="tooltip" title="{{__('Import')}}" data-url="{{ route('employee.file.import') }}" data-ajax-popup="true" data-title="{{__('Import employee CSV file')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="{{route('employee.export')}}" data-bs-toggle="tooltip" title="{{__('Export')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a> --}}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Employee ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Branch') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Shift') }}</th>
                                    {{-- <th>{{ __('Extra Time') }}</th> --}}
                                    <th width="200px">{{ __('Action') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                               $startDdate = date('Y-m-d', strtotime($contract->start_date));
                               $endDate = date('Y-m-d', strtotime($contract->end_date));
                           @endphp --}}

                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td><a href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($schedule->employee->employee_id)) }}"
                                                class="btn btn-outline-primary">{{ \Auth::user()->employeeIdFormat($schedule->employee->employee_id) }}</a>
                                        </td>
                                        <td>{{ $schedule->employee->name }}</td>
                                        <td>{{ $schedule->branch->name }}</td>
                                        <td>{{ $schedule->department->name }}</td>
                                        <td>{{ $schedule->date }}</td>
                                        <td>{{ $schedule->shift->name }}</td>
                                        {{-- <td>comming soon</td> --}}
                                        <td class="Action">
                                            @can('edit employee schedule')
                                                <div class="action-btn bg-primary ms-2">

                                                    <a href="#" data-size="lg"
                                                        data-url="{{ URL::to('employee-schedule/' . $schedule->id . '/edit') }}"
                                                        data-ajax-popup="true" data-title="{{ __('Edit Employee Scehdule') }}"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="tooltip" title="{{ __('Edit Employee Scehdule') }}"
                                                        data-original-title="{{ __('Edit Employee Scehdule') }}">
                                                        <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                            @endcan

                                            @can('delete employee schedule')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['employee-schedule.destroy', $schedule->id],
                                                        'id' => 'delete-form-' . $schedule->id,
                                                    ]) !!}


                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-toggle="tooltip"
                                                        data-original-title="{{ __('Delete') }}"
                                                        data-confirm="{{ __('Are You Sure?') . ' | ' . __('This Action Can Not Be Undone. Do You Want To Continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-form-{{ $schedule->id }}').submit();">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
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
    </div>
@endsection
