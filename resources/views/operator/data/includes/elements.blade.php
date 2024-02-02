<div class="tab-pane fade" id="elements" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Change Password</h4>
            </div>
        </div>
        <div class="card-body">
                <div class="form-group">
                    <label for="cpass">Current Password:</label>
                    <a href="javascripe:void();" class="float-right">Forgot Password</a>
                    <input type="Password" class="form-control" id="cpass" value="">
                </div>
                <div class="form-group">
                    <label for="npass">New Password:</label>
                    <input type="Password" class="form-control" id="npass" value="">
                </div>
                <div class="form-group">
                    <label for="vpass">Verify Password:</label>
                    <input type="Password" class="form-control" id="vpass" value="">
                </div>
        </div>
    </div>
</div>

<script>
    let elements = [];
    function getAllElements()
    {
        let url = "{{route('elements.get.all')}}";
        fetch(url, {
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
    }
    getAllElements();
</script>
