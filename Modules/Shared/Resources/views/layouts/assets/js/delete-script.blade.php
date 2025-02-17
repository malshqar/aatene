@props(['name', 'reload' => false,'closest'=>'tr'])

<script>
    let closest = "{{$closest}}";
    function confirmDestroy(uri, reference) {
        console.log(uri);
        Swal.fire({
            title: 'هل انت متاكد؟',
            text: "انت تريد حذف هذا العنصر!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'الغاء',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'حذف'
        }).then((result) => {
            if (result.isConfirmed) {
                destroy(uri, reference);
            }
        })
    }

    function destroy(uri, reference) {

        axios.delete(uri)
            .then(function (response) {
                // handle success
                console.log(response);
                if (reference.closest(closest)) {
                    reference.closest(closest).remove();
                }
                showMessage(response.data)
                setTimeout(() => {
                    @if($reload)
                        window.location.reload();
                    @endif
                }, 1500);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
                showMessage(error.response.data);
            })
            .then(function () {
                // always executed
            });
    }

    function showMessage(data) {
        Swal.fire({
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 1000
        })
    }
</script>