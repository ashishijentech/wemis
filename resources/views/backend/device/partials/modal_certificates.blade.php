    <div class="modal fade" id="certificates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Certificates</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('download.PDF') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <select name="type" class="form-select-sm form-select">
                                <option value="customer_copy">Customer Copy</option>
                                <option value="department_copy">Department Copy</option>
                            </select>
                        </div>
                        <input type="text" name="deviceId" id="deviceId" style="display: none">
                        <div class="mb-2">
                            <label for="" class="form-label">Leatter Head</label>
                            <select name="letterHead" class="form-select-sm form-select">
                                <option value="allow">Allow</option>
                                <option value="deny">Deny</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Certificate</label>
                            <select name="certificate" class="form-select-sm form-select">
                                <option value="installation">Installation</option>
                                <option value="warranty">Warranty</option>
                                <option value="fitment">Fitment</option>
                            </select>
                        </div>
                        <div style="text-align: right">
                            <button class="btn" style="background-color: #260950;color:#fff">Download</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
