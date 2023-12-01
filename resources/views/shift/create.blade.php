{{ Form::open(['url' => 'shifting', 'method' => 'post', 'files' => true]) }}
<div class="modal-body">
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name')]) }}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('start_time', __('Start Time'), ['class' => 'form-label']) }}
                {{ Form::time('start_time', null, ['class' => 'form-control', 'placeholder' => __('Enter Start Time')]) }}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('end_time', __('End Time'), ['class' => 'form-label']) }}
                {{ Form::time('end_time', null, ['class' => 'form-control', 'placeholder' => __('Enter Time')]) }}
            </div>
        </div>        
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
