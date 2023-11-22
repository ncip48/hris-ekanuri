@extends('layouts.admin')
@section('page-title')
    {{__('Employee Contracts')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Employee Contracts')}}</li>
@endsection


@section('action-btn')
    <div class="float-end">
        <a href="#" data-size="lg" data-url="{{ route('employee-contract.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New Contract')}}" class="btn btn-sm btn-primary">
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
                                <th>{{__('Employee ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Department')}}</th>
                                <th>{{__('Sub Department')}}</th>
                                <th>{{__('Designation')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('End Date')}}</th>
                                <th>{{__('Contract File')}}</th>
                                <th width="200px">{{__('Action')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                           @foreach ($contracts as $contract)
                           @php
                               $startDdate = date('Y-m-d', strtotime($contract->start_date));
                               $endDate = date('Y-m-d', strtotime($contract->end_date));
                           @endphp
                                <tr>
                                    <td><a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($report->employee->employee_id))}}" class="btn btn-outline-primary">{{ \Auth::user()->employeeIdFormat($report->employee->employee_id) }}</a></td>
                                    <td>{{ $contract->employee->name }}</td>
                                    {{-- <td>{{ $contract->employee->email }}</td> --}}
                                    <td>{{ $contract->branch->name }}</td>
                                    <td>{{ $contract->department->name }}</td>
                                    <td>{{ $contract->subDepartment->name }}</td>
                                    <td>{{ $contract->designation->name }}</td>
                                    <td>{{ $startDdate }}</td>
                                    <td>{{ $endDate }}</td>
                                    <td>{{ $contract->contract_file }}</td>
                                    <td class="Action">
                                        @can('edit personal report')
                                        <div class="action-btn bg-primary ms-2">

                                            <a href="#"
                                            data-size="lg"
                                                data-url="{{ URL::to('personal-report/' . $report->id . '/edit') }}"
                                                data-ajax-popup="true" data-title="{{ __('Edit Personal Report') }}"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="tooltip" title="{{ __('Edit Personal Report') }}"
                                                data-original-title="{{ __('Edit Personal Report') }}">
                                                <i class="ti ti-pencil text-white"></i></a>
                                        </div>
                                        @endcan

                                        @can('delete personal report')
                                        <div class="action-btn bg-danger ms-2">
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['personal-report.destroy', $report->id],
                                                'id' => 'delete-form-' . $report->id,
                                            ]) !!}


                                            <a href="#"
                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                data-original-title="{{ __('Delete') }}"
                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                data-confirm-yes="document.getElementById('delete-form-{{ $report->id }}').submit();"><i
                                                    class="ti ti-trash text-white"></i></a>
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
