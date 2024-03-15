@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Reimbursement') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Reimbursement') }}</li>
@endsection


@section('action-btn')
    <div class="float-end">
        @can('create reimbursement')
            <a href="#" data-url="{{ route('reimbursement.create') }}" data-ajax-popup="true"
                data-title="{{ __('Create New Reimbursement') }}" data-bs-toggle="tooltip" title="{{ __('Create') }}"
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
                                    {{-- <th>{{ __('Branch') }}</th> --}}
                                    <th>{{ __('Employee') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('File Proof') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($reimbursements as $reimbursement)
                                    <tr>
                                        {{-- <td>{{ !empty($reimbursement->branch) ? $reimbursement->branch->name : '' }}</td> --}}
                                        <td>{{ !empty($reimbursement->employee) ? $reimbursement->employee->name : '' }}
                                        </td>
                                        <td>{{ $reimbursement->date }}</td>
                                        <td>{{ $reimbursement->description }}</td>
                                        <td>
                                            @if (!empty($reimbursement->file))
                                                <a href="{{ asset('public/uploads/reimbursement/' . $reimbursement->file) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                    {{ __('See') }}
                                                </a>
                                            @endif
                                        </td>

                                        <td class="Action">
                                            <span>
                                                @can('edit reimbursement')
                                                    <div class="action-btn bg-primary ms-2">

                                                        <a href="#"
                                                            data-url="{{ URL::to('reimbursement/' . $reimbursement->id . '/edit') }}"
                                                            data-ajax-popup="true" data-title="{{ __('Edit Reimbursement') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                            data-original-title="{{ __('Edit') }}">
                                                            <i class="ti ti-pencil text-white"></i></a>
                                                    </div>
                                                @endcan
                                                @can('delete reimbursement')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['reimbursement.destroy', $reimbursement->id],
                                                            'id' => 'delete-form-' . $reimbursement->id,
                                                        ]) !!}


                                                        <a href="#"
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                            data-original-title="{{ __('Delete') }}"
                                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                            data-confirm-yes="document.getElementById('delete-form-{{ $reimbursement->id }}').submit();"><i
                                                                class="ti ti-trash text-white"></i></a>
                                                        {!! Form::close() !!}
                                                    </div>
                                                @endcan
                                            </span>
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
