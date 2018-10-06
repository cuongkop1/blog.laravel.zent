$(function() {
    var categoryTable = $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'category/list',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'thumbnail', name: 'thumbnail' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action' }
        ]
    });

    $(document).on('click', '.btn-danger', function(){
        swal({
            title: "Bạn có chắc muốn xóa?",
            text: "Bạn sẽ không thể khôi phục lại bản ghi này!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
        var categoryId = $(this).attr('categoryId');
        $.ajax({
            type: 'delete',
            url: 'category/' + categoryId,
            success: function(response){
                categoryTable.ajax.reload();
                toastr.success('Xóa thành công!');   
            }
        })
        }else {
            toastr.warning('Bạn đã hủy!');
        }
        });
    });

   $(document).on('click', '.btn-success', function(){
        $('#show').modal('show');
        var id = $(this).attr('categoryId');
        var img = 
        $.ajax({
            type: 'get',
            url: 'category/' + id,
            success: function(response){
                $('#show_name').text(response.name);
                $('#show_description').text(response.description);
                $('#show_thumbnail').attr('src',response.thumbnail);
            }
        })
    });

    $(document).on('click','.btn_edit', function(){
        var id = $(this).attr('categoryId');
        $.ajax({
            type: 'get',
            url: asset+"admin/category/"+id,
            success: function(response){
                $('#edit_category').modal('show');
                $('#edit_name').val(response.name);
                $('#edit_description').val(response.description);
                $('#edit_thumbnail').val(response.thumbnail);
                $('#update_category').attr('data-id', response.id); 
            }
        })
    });

    $('#update_category').click(function(e){
        e.preventDefault();
        var name = $('#edit_name').val();
        var description = $('#edit_description').val();
        var thumbnail = $('#edit_thumbnail').val();
        var id = $(this).attr('data-id');
        if ($.trim(name) == '' || $.trim(description) == '' || $.trim(thumbnail) == '') {
            toastr.error('Không được để trống !');
        }
        $.ajax({
            type: 'PUT',
            url: asset+'admin/category/'+id,
            data: {name: name, description:description, thumbnail:thumbnail},
            success: function(response){
                $('#edit_category').modal('hide');
                categoryTable.ajax.reload();
                toastr.success('Sửa thành công !');
            }
        })
    });

    $(document).on('click', '.btn-info', function(){
        $('#add_category').modal('show');
    });

    $('#submit_category').click(function(e){
        e.preventDefault();
        var name = $('#name').val();
        var description = $('#description').val();
        var thumbnail = $('#thumbnail').val();
        if ($.trim(name) == '' || $.trim(description) == '' || $.trim(thumbnail) == ''){
            toastr.error('Không được để trống !');
        }
        $.ajax({
            type: 'POST',
            url: 'category/store',
            data: {name: name, thumbnail: thumbnail, description: description},
            success: function(response){
                $('#add_category').modal('hide');
                categoryTable.ajax.reload();
                toastr.success('Thêm thành công!');   
            }
        })
    });


});