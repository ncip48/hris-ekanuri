{{ Form::model($ratingBehavior, ['route' => ['rating-behavior.update', $ratingBehavior->id], 'method' => 'PUT']) }}
<div class="modal-body">

    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('employee_id', __('Employee'), ['class' => 'form-label']) }}
                {{ Form::select('employee_id', $employee, null, ['class' => 'form-control select', 'placeholder' => __('Select Employee')]) }}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('behavior_id', __('Behavior'), ['class' => 'form-label']) }}
                {{ Form::select('behavior_id', $behavior, null, ['class' => 'form-control select', 'placeholder' => __('Select Behavior')]) }}
            </div>
        </div>
        {{-- <div class="col-12">
            <div class="form-group">
                {{ Form::label('department_id', __('Branch'), ['class' => 'form-label']) }}
                {{ Form::select('department_id', $department, null, ['class' => 'form-control select', 'placeholder' => __('Select Department')]) }}
            </div>
        </div> --}}
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('score', __('Score'), ['class' => 'form-label']) }}
                {{ Form::text('score', null, ['class' => 'form-control', 'placeholder' => __('Enter Score')]) }}
                @error('score')
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
