<!-- Delete Database Modal  -->
<div class="modal fade" id="clusterBackDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="clusterDeleteForm" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="clusterBackDropModalTitle">Cluster Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <span><b>Are you sure you want to delete the cluster?</b></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>
<!-- Delete Database Modal  -->