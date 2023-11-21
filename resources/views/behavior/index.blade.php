@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Behavior') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Behavior') }}</li>
@endsection


@section('action-btn')
    <div class="float-end">
        @can('create class')
            <a href="#" data-url="{{ route('behavior.create') }}" data-ajax-popup="true"
                data-title="{{ __('Create New Behavior') }}" data-bs-toggle="tooltip" title="{{ __('Create') }}"
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
                                    <th>{{ __('Behavior') }}</th>
                                    {{-- <th>{{ __('Branch') }}</th> --}}
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($behaviors as $behavior)
                                    <tr>
                                        <td>{{ $behavior->name }}</td>
                                        {{-- <td>{{ !empty($behavior->branch) ? $behavior->branch->name : '' }}</td> --}}

                                        <td class="Action">
                                            <span>
                                                @can('edit behavior')
                                                    <div class="action-btn bg-primary ms-2">

                                                        <a href="#"
                                                            data-url="{{ URL::to('behavior/' . $behavior->id . '/edit') }}"
                                                            data-ajax-popup="true" data-title="{{ __('Edit Behavior') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                            data-original-title="{{ __('Edit') }}">
                                                            <i class="ti ti-pencil text-white"></i></a>
                                                    </div>
                                                @endcan
                                                @can('delete behavior')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['behavior.destroy', $behavior->id],
                                                            'id' => 'delete-form-' . $behavior->id,
                                                        ]) !!}


                                                        <a href="#"
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                            data-original-title="{{ __('Delete') }}"
                                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                            data-confirm-yes="document.getElementById('delete-form-{{ $behavior->id }}').submit();"><i
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
