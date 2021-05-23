$(document).ready(function() {
    // Initialise the table
    $("#datatable").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function(table, row) {
            console.log('hshs')
            var rows = table.tBodies[0].rows;
            var arr = [];
            for (var i = 0; i < rows.length; i++) {
                let id = rows[i].id.replace(/^row+/i, '');
                arr.push(id);
            }
            var label = $('#datatable').attr('label');
            console.log(label)
            $.ajax({
                    type: "POST",
                    url: "{{ route('order.change') }}",
                    data: { 'arr': arr, '_token':'{{ csrf_token() }}', 'model': $('#datatable').attr('label') },
                    success: function(response){
                        giveMessage(response.type,response.message)
                    },
                    error: function(error){
                        giveMessage('error',error)
                    }
                });
        }
    });
});
