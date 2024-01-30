{{Form::model($overtimeRequest,array('route' => array('overtime-request.changaction', $overtimeRequest->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Start Date') }}</th>
                                <th>{{ __('End Date') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Note') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($overtimeRequest as $item)
                                
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="submit" value="{{__('Approval')}}" class="btn btn-success" data-bs-dismiss="modal" name="status">
    <input type="submit" value="{{__('Reject')}}" class="btn btn-danger" name="status">
</div>
{{Form::close()}}
