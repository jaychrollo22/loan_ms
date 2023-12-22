<div class="modal fade" id="newLoanType" tabindex="-1" role="dialog" aria-labelledby="newLoanTypelabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newLoanTypelabel">New Loan Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method='POST' action='new-loan-type' onsubmit='show()' >
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class='col-md-12 form-group'>
              Loan Type  
              <input type="text" name='name' class="form-control" required placeholder="Loan Type">
            </div>
            <div class='col-md-12 form-group'>
              Description  
              <input type="text" name='description' class="form-control" required placeholder="Description">
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