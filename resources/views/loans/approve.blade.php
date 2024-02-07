<div class="modal fade" id="approve-{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="approveLoan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveLoan">Are you sure you want to Approve this Loan?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method='POST' action={{ url('approve-loan/' . $loan->id) }} onsubmit="btnApprove.disabled = true; return true;" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="badge badge-success mt-1">Approved</h4>
                        </div>
                        <input type="hidden" name="payment_start" value="{{$payment_start_date}}">
                        <input type="hidden" name="saving" value="{{$saving}}">


                        <div class="col-md-12 form-group">
                            Release Date
                            <input type="date" name="release_date" class="form-control" value="">
                        </div>

                        <div class='col-md-12 form-group'>
                            Remarks
                            <textarea class="form-control" name="approval_remarks" id="" cols="30" rows="5" placeholder="Input Approval Remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btnApproved" class="btn btn-success">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>
