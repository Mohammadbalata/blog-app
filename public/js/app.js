function useAjax(url,methodType,action) {
    $.ajax({
            url:url,
            type:methodType,
            data:{
                _token: $('input[name=_token]').val(),
            },
            success: function (res){
                action;
            }
        })
}

function deleteArticle(id) {
    if (confirm('Are you sure you want to delete')) {
        useAjax(`articles/${id}`,'DELETE',$('#articleid'+id).remove())
    }
}

function deleteCategory(id) {
    if (confirm('Are you sure you want to delete')) {
        useAjax(`categories/${id}`,'DELETE',$('#categoryid'+id).remove())
    }
}
function deleteTag(id) {
    if (confirm('Are you sure you want to delete')) {
        useAjax(`tags/${id}`,'DELETE',$('#tagid'+id).remove())
    }
}