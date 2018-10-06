CKEDITOR.replace( 'content' );
// CKEDITOR.replace( 'content1' );
$(function() {
    var postTable = $('#posts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'post/list',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'thumbnail', name: 'thumbnail' },
            { data: 'categories_description', name: 'description' },
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
        var postID = $(this).attr('postID');
        $.ajax({
            type: 'delete',
            url: 'post/' + postID,
            success: function(response){
                postTable.ajax.reload();
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
        var id = $(this).attr('postID');
        var img = 
        $.ajax({
            type: 'get',
            url: 'post/' + id,
            success: function(response){
                $('#show_title').text(response.title);
                $('#show_description').text(response.description);
                $('#show_thumbnail').attr('src',response.thumbnail);
                $('#show_content').html(response.content);
            }
        })
    });

    $(document).on('click','.btn_post_edit', function(){
        var id = $(this).attr('postId');
        $.ajax({
            type: 'get',
            url: asset+"admin/post/"+id,
            success: function(response){
                $('#edit_post').modal('show');
                $('#edit_title').val(response.title);
                $('#edit_description').val(response.description);
                $('#edit_thumbnail').val(response.thumbnail);
                // $('#edit_content').CKEDITOR.instances['content1'].setData(html);
                $('#edit_content').val(response.content);
                // $('#edit_slug').val(response.slug);
                $('#edit_category_id').val(response.category_id);
                $('#update_post').attr('data-id', response.id); 
            }
        })
    });

    $('#update_post').click(function(e){
        e.preventDefault();
        var title = $('#edit_title').val();
        var description = $('#edit_description').val();
        var thumbnail = $('#edit_thumbnail').val();
        var content = $('#edit_content').val();
        // var slug = $('#edit_slug').val();
        var category_id = $('#edit_category_id').val();
        var id = $(this).attr('data-id');
        if ($.trim(title) == '' || $.trim(description) == '' || $.trim(thumbnail) == '' ||
            $.trim(content) == '') {
            toastr.error('Không được để trống !');
        }
        $.ajax({
            type: 'PUT',
            url: asset+'admin/post/'+id,
            data: {title: title, category_id:category_id, description:description, thumbnail:thumbnail,
            content:content,slug:title},
            success: function(response){
                $('#edit_post').modal('hide');
                postTable.ajax.reload();
                toastr.success('Sửa thành công !');
            }
        })
    });

    $(document).on('click', '.btn-info', function(){
        $('#add_post').modal('show');
    });

    $('#submit_post').click(function(e){
        e.preventDefault();
        // console.log('dsfaldjfldsf');
        var newPost = new FormData();
        var file = document.getElementById('thumbnail').files; 
        newPost.append('thumbnail',file[0]);
        newPost.append('title',$('#title').val())         
        newPost.append('description',$('#description').val())         
        newPost.append('category_id',$('#category_id').val())         
        newPost.append('content',CKEDITOR.instances['content'].getData())         
        // var title = $('#title').val();
        // var description = $('#description').val();
        // var thumbnail = $('#thumbnail').val();
        // var content = CKEDITOR.instances['content'].getData();
        // var slug = $('#slug').val();
        // var category_id = $('#category_id').val();
        if ($.trim(title) == '' || $.trim(description) == '' || $.trim(thumbnail) == '' ||
            $.trim(content) == '') {
            toastr.error('Không được để trống !');
        }
        $.ajax({
            type: 'POST',
            url: 'http://blog.laravel.zent/admin/post/store',
            data: newPost,
            dataType:'json',
            async:false,
            processData: false,
            contentType: false,
            
            success: function(response){
                console.log('adfdsfds');
                $('#add_post').modal('hide');
                postTable.ajax.reload();
                toastr.success('Thêm thành công!');   
            }
        })
    });


});