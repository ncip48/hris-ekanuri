{{ Form::open(['url' => 'reimbursement', 'method' => 'post', 'files' => true]) }}
<div class="modal-body">
    <div class="row ">
        @if (\Auth::user()->isStaff())
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('employee_id', __('Employee'), ['class' => 'form-label']) }}
                    {{ Form::select('employee_id', $employee, null, ['class' => 'form-control select', 'placeholder' => __('Select Employee')]) }}
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('date', __('Date'), ['class' => 'form-label']) }}
                {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter Date')]) }}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
                @error('description')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('file', __('File'), ['class' => 'form-label']) }}
                {{-- {{ Form::file('file', null, ['class' => 'form-control', 'placeholder' => __('Attach File')]) }} --}}
                <input type="file" name="file" class="form-control">
                @error('file')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- <div class="col-12">
            <div class="form-group">
                {{ Form::label('department_id', __('Branch'), ['class' => 'form-label']) }}
                {{ Form::select('department_id', $department, null, ['class' => 'form-control select', 'placeholder' => __('Select Department')]) }}
            </div>
        </div> --}}
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
