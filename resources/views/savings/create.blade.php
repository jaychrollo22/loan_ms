<div class="modal fade" id="newSaving" tabindex="-1" role="dialog" aria-labelledby="newSavinglabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newSavinglabel">New Savings</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method='POST' action='new-saving' onsubmit='show()' >
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class='col-md-12 form-group'>
                Title 
                <input type="text" name='name' class="form-control" required min="1">
              </div>
              <div class='col-md-12 form-group'>
                Amount  
                <input type="number" name='amount' step="0.01" class="form-control" required placeholder="Amount">
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