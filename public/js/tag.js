$(function() {
    var tagTable = $('#tags-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'tag/list',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
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
        var id = $(this).attr('tagId');
        $.ajax({
            type: 'delete',
            url: 'tag/' + id,
            success: function(response){
                tagTable.ajax.reload();
                toastr.success('Xóa thành công!');   
            }
        })
        } else {
            toastr.warning('Bạn đã hủy!');
        }
        });
    });

   $(document).on('click', '.btn-success', function(){
        $('#show').modal('show');
        var id = $(this).attr('tagId');
        $.ajax({
            type: 'get',
            url: 'tag/' + id,
            success: function(response){
                $('#show_name').text(response.name);
                $('#show_slug').text(response.slug);
                $('#show_created_at').text(response.created_at);
                $('#show_updated_at').text(response.updated_at);
            }
        })
    });

    $(document).on('click','.btn_edit', function(){
        var id = $(this).attr('tagId');
        $.ajax({
            type: 'get',
            url: asset+"admin/tag/"+id,
            success: function(response){
                $('#edit_tag').modal('show');
                $('#edit_name').val(response.name);
                $('#edit_slug').val(response.slug);
                $('#update_tag').attr('data-id', response.id); 
            }
        })
    });

    $('#update_tag').click(function(e){
        e.preventDefault();
        var name = $('#edit_name').val();
        var slug = $('#edit_slug').val();
        var id = $(this).attr('data-id');
        if ($.trim(name) == '' || $.trim(slug) == '') {
            toastr.error('Không được để trống!');
        }
        $.ajax({
            type: 'PUT',
            url: asset+'admin/tag/'+id,
            data: {name: name, slug:slug},
            success: function(response){
                $('#edit_tag').modal('hide');
                toastr.success('Sửa thành công!');
                tagTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.btn-info', function(){
        $('#add_tag').modal('show');
    });

    $('#submit_tag').click(function(e){
        e.preventDefault();
        var name = $('#name').val();
        var slug = $('#slug').val();
        if ($.trim(name) == '' || $.trim(slug) == ''){
            toastr.error('Không được để trống!');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'tag/store',
            data: {name: name, slug: slug},
            success: function(response){
                $('#add_tag').modal('hide');
                tagTable.ajax.reload();
                toastr.success('Thêm mới thành công!');   
            }
        })
    });


});