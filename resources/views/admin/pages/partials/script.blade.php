<script>
    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "300",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
    }
    @if($errors->any())
        @foreach ($errors->all() as $error)
            giveMessage('error','{{ $error }}')
        @endforeach
    @endif
    @if(session('success'))
        giveMessage('success','{{ session("success") }}')
    @endif
    function giveMessage(type,msg){
        toastr[type](msg);
    }
    function deleteCat(route) {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                            url: route,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            type: 'delete',
                            success: function(result) {
                                giveMessage(result.type,result.text)
                                if (result.type == 'success') {
                                    $(`#row${result.id}`).remove();
                                }
                            }
                        });
            }
            })
        }
        function slugify(str){
                str = str.replace(/^\s+|\s+$/g, ''); // trim
                str = str.toLowerCase();

                // remove accents, swap ñ for n, etc
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to   = "aaaaeeeeiiiioooouuuunc------";
                for (var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes
                return str;
        }

</script>
