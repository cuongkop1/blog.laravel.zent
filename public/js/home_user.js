$(function() {
    var userTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'user/list',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
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
        var user_id = $(this).attr('userId');
        $.ajax({
            type: 'delete',
            url: 'user/' + user_id,
            success: function(response){
                userTable.ajax.reload();
                toastr.success('Xóa thành công!');
            }
        })
        // swal("Xóa thành công!", {
        //     icon: "success",
            
        // });
      } else {
        toastr.warning('Bạn đã hủy!');
      }
    });
    	
    });

   $(document).on('click', '.btn-success', function(){
        $('#show').modal('show');
        var id = $(this).attr('userId');
        $.ajax({
            type: 'get',
            url: 'user/' + id,
            success: function(response){
                $('#show_name').text(response.name);
                $('#show_email').text(response.email);
                $('#show_updated_at').text(response.updated_at);
                $('#show_created_at').text(response.created_at);
            }
        })
    });

    $(document).on('click', '.btn_edit', function(){
        var id = $(this).attr('userId');
        $.ajax({
            type: 'get',
            url: asset+"admin/user/"+id,
            success: function(response){
                $('#edit').modal('show');
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);
                $('#sub_update').attr('data-id', response.id); 
            }
        })
    });

    $('#sub_update').click(function(e){
        e.preventDefault();
        var name = $('#edit_name').val();
        var email = $('#edit_email').val();
        var id = $(this).attr('data-id');
        if ($.trim(name) == '' || $.trim(email) == '') {
            toastr.error('Không được để trống!');
        }
        $.ajax({
            type: 'PUT',
            url: asset+'admin/user/'+id,
            data: {name: name, email: email},
            success: function(response){
                $('#edit').modal('hide');
                userTable.ajax.reload();
                toastr.success('Sửa thành công!');
            }
        })
    });

    $('#submit').click(function(e){
        e.preventDefault();
        var name = $('#name').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var txt = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        if ($.trim(name) == '' || $.trim(email) == '' || $.trim(username) == '' || $.trim(password) == '')
        {
            toastr.error('Không được để trống!');
        }
        if ($.trim(password) != $.trim(confirm_password)) {
            toastr.warning('Mật khẩu không trùng khớp');
        }else if(!txt.test(email)){
            toastr.warning('Bạn chưa nhập đúng định dạng email');
        }else{
            $.ajax({
            type: 'POST',
            url: 'user/store',
            data: {name: name, email: email, username: username, password:password},
            success: function(response){
                $('#add').modal('hide');
                userTable.ajax.reload();
                toastr.success('Thêm mới thành công!');
            }
        });
        }
        
    });

    $(document).on('click', '.btn-info', function(){
        $('#add').modal('show');
    });



});