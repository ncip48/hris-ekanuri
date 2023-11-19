{{ Form::model($class, ['route' => ['class.update', $class->id], 'method' => 'PUT']) }}
<div class="modal-body">

    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('level_id', __('Level')) }}
                {{ Form::select('level_id', $level, null, ['class' => 'form-control select', 'placeholder' => __('Select Level')]) }}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Name')) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Class Name')]) }}
                @error('name')
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
