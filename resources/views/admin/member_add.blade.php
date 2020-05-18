@extends('base.base')
@section('base')
    <!-- 内容区域 -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">请填写會員信息</h4>
                            {{--<p class="card-description">--}}
                            {{--Basic form elements--}}
                            {{--</p>--}}
                            <form class="forms-sample" id="form">
                                <div class="form-group">
                                    <label >* 姓名</label>
                                    <input type="text"  class="form-control required" name="name" placeholder="姓名">
                                </div>
                                <div class="form-group">
                                    <label >* 綽號</label>
                                    <input type="text"  class="form-control required" name="nickname" placeholder="綽號">
                                </div>
                                <div class="form-group">
                                    <label >* 帳號</label>
                                    <input type="text"  class="form-control required" name="account" placeholder="帳號">
                                </div>
                                <div class="form-group">
                                    <label >* 密碼</label>
                                    <input type="text"  class="form-control required" name="password" placeholder="密碼"">
                                </div>
                                <div class="form-group">
                                    <label >郵件</label>
                                    <input type="text"  class="form-control " name="email" placeholder="郵件"">
                                </div>
                                <div class="form-group">
                                    <label >手機</label>
                                    <input type="text"  class="form-control " name="phone" placeholder="手機"">
                                </div>
                                <div class="form-group" id="image" >
                                    <label>上傳圖片</label>
                                    <input type="file" class="file-upload-default img-file" data-path="member">
                                    <input type="hidden" class="image-path value-input" name="avatar">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" onclick="upload($(this))" type="button">上传</button>
                                        </span>
                                    </div>
                                    <div class="img-yl">
                                    </div>
                                </div>
                                <button type="button" onclick="commit()" class="btn btn-sm btn-gradient-primary btn-icon-text">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    提交
                                </button>
                                <button type="button" onclick="cancel()" class="btn btn-sm btn-gradient-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i>
                                    取消
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('change','#type',function(){
            if($(this).val() == 'string'){
                $('#string').show().find('input').attr('name','config_value');
                $('#text').hide().find('textarea').removeAttr('name');
                $('#image').hide().find('.value-input').removeAttr('name');
            }else if($(this).val() == 'text'){
                $('#text').show().find('textarea').attr('name','config_value');
                $('#string').hide().find('input').removeAttr('name');
                $('#image').hide().find('.value-input').removeAttr('name');
            }else if($(this).val() == 'image'){
                $('#string').hide().find('input').removeAttr('name');
                $('#text').hide().find('textarea').removeAttr('name');
                $('#image').show().find('.value-input').attr('name','config_value');
            }
        })
        var editor = new wangEditor('editor');
        // 上传图片（举例）
        editor.config.uploadImgUrl = "/admin/wangeditor/upload";
        // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
        editor.config.hideLinkImg = false;
        editor.create();
        function commit(){
            if(!checkForm()){
                return false;
            }
            var data = $("#form").serializeObject();
            myRequest("/admin/member/add","post",data,function(res){
                layer.msg(res.msg)
                setTimeout(function(){
                    parent.location.reload();
                },1500)
            });
        }
        function cancel() {
            parent.location.reload();
        }
    </script>
@endsection