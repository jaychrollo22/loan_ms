<div class="modal fade" id="pay-{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="paylabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paylabel">Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method='POST' action='store-payment/{{$loan->id}}' onsubmit='show()' enctype="multipart/form-data" >
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class='col-md-12 form-group'>
                Input Payment 
                <input id="input-{{$loan->id}}" type="number" name='payment' class="form-control" required min="1">
              </div>
            </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>

