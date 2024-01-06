<div class="modal fade" id="disapprove-{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="disapproveLoan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disapproveLoan">Are you sure you want to Disapprove this Loan?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method='POST' action={{ url('disapprove-loan/' . $loan->id) }} onsubmit="btnDisapprove.disabled = true; return true;" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="badge badge-danger mt-1">Disapproved</h4>
                        </div>
                        <input type="hidden" name="status" value="Disapproved">
                        <div class='col-md-12 form-group'>
                            Remarks:
                            <textarea class="form-control" name="approval_remarks" id="" cols="30" rows="5" placeholder="Input Approval Remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btnDisapprove" class="btn btn-danger">Disapprove</button>
                </div>
            </form>
        </div>
    </div>
</div>
