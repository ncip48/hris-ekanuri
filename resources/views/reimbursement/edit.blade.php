{{ Form::model($reimbursement, ['route' => ['reimbursement.update', $reimbursement->id], 'method' => 'PUT', 'files' => true]) }}
<div class="modal-body">

    <div class="row ">
        @if (!auth()->user()->isStaff())
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
                <label for="file" class="form-label text-danger">*leave empty if you don't want to change the
                    file</label>
                @error('file')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
