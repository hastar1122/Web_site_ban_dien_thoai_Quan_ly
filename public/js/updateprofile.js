$(document).ready(function(){
    // image preview
    $("#imageid").change(function(){
        let reader = new FileReader();

        reader.onload = (e) => {
            $("#image_preview_container").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    })

    //update
    $(".btn-update-profile").click(function () {
        var input = document.getElementById('imageid');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formdata = new FormData();
        formdata.append("name", $("#nameid").val());
        formdata.append("address", $("#addressid").val());
        formdata.append("email", $("#emailid").val());
        formdata.append("phone", $("#phoneid").val());
        if ($("#imageid").get(0).files[0])
            formdata.append("image", $("#imageid").get(0).files[0]);
        else
            formdata.append("image", $("#fakeimageid").val());
        formdata.append("fakeimage", $("#fakeimageid").val());
        for (const value of formdata.values()) {
        console.log(value);
        }
        formdata.append("_method", "PUT");
        var url = "{{route('Account.update', Auth::user()->UserID )}}";
        $.ajax({
            url: url,
            contentType: false,
            processData: false,
            cache :false,
            data: formdata,
            dataType: 'json',
            type: 'POST',

            success: function (data) {
                toastr.success("Updated Successfull");
                setTimeout(function () {
                    location.reload(true);
                }, 1000);
            },
            error: function (data) {
                console.log(url);
                toastr.error('Update Fail');
            }

        });
    });
})
