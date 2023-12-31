{{ Form::model($behavior, ['route' => ['behavior.update', $behavior->id], 'method' => 'PUT']) }}
<div class="modal-body">

    <div class="row ">
        {{-- <div class="col-12">
            <div class="form-group">
                {{ Form::label('branch_id', __('Branch')) }}
                {{ Form::select('branch_id', $branch, null, ['class' => 'form-control select', 'placeholder' => __('Select Branch')]) }}
            </div>
        </div> --}}
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
