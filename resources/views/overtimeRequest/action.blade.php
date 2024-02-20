{{-- {{ Form::model($overtimes, ['url' => 'overtime-request/changeaction', 'method' => 'PUT']) }} --}}
{{ Form::model($overtimes, ['route' => ['overtime-request.changeaction', $overtimes->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <p class="fw-bold">Employee Profile</p>
            {!! Form::hidden('overtime_id', $overtimes->id) !!}
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    {{ Form::text('name', $overtimes->employee->name, ['class' => 'form-control', 'placeholder' => __('Enter Your Name'), 'readonly' => 'readonly']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::text('name', $overtimes->branch->name, ['class' => 'form-control', 'placeholder' => __('Enter Your Name'), 'readonly' => 'readonly']) }}
            </div>
        </div>
        <hr>
        <div class="col-12">
            <p class="fw-bold">Detail Overtime</p>
            {{-- <div class="card">
                <div class="card-body table-border-style"> --}}
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        {{-- <th>{{ __('No') }}</th> --}}
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('End Date') }}</th>
                        <th>{{ __('Duration') }}</th>
                        <th>{{ __('Note') }}</th>
                    </thead>
                    <tbody>
                        {{-- @foreach ($overtimes as $overtime) --}}
                        @php
                            $number = 1;
                        @endphp

                        <tr>
                            {{-- <td>{{ $number++ }}</td> --}}
                            <td>{{ $overtimes->start_date }}</td>
                            <td>{{ $overtimes->end_date }}</td>
                            <td>{{ $overtimes->duration }}</td>
                            <td>{{ $overtimes->note }}</td>
                        </tr>

                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            {{-- </div>
            </div> --}}
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="submit" value="{{ __('Approval') }}" class="btn btn-success" name="status" value="Approval">
        {{ __('Approval') }}
    </button>
    <button type="submit" value="{{ __('Reject') }}" class="btn btn-danger" name="status" value="Reject">
        {{ __('Reject') }}
    </button>
</div>
{{ Form::close() }}
