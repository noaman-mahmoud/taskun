<div class="modal fade text-left" id="notify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160">{{awtTrans('ارسال اشعار')}}</h5>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{$route}}" method="POST" enctype="multipart/form-data" class="notify-form">
                    @csrf
                    <input type="hidden" name="id" class="notify_id">
                    <input type="hidden" name="notify" class="notify">
                    <input type="hidden" name="type" class="type">

                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label for="first-name-column">{{awtTrans('عنوان الاشعار بالعربية')}}</label>
                                <div class="controls">
                                    <input type="text" name="title_ar" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label for="first-name-column">{{awtTrans('عنوان الاشعار بالانجليزية')}}</label>
                                <div class="controls">
                                    <input type="text" name="title_en" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{awtTrans('الرسالة بالعربية')}}</label>
                                <div class="controls">
                                    <textarea name="message_ar" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{awtTrans('الرسالة بالانجليزية')}}</label>
                                <div class="controls">
                                    <textarea name="message_en" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary send-notify-button" >{{awtTrans('ارسال')}}</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{awtTrans('الفاء')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160">{{awtTrans('ارسال بريد الكتروني')}}</h5>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{$route}}" method="POST" enctype="multipart/form-data" class="notify-form">
                    @csrf
                    <input type="hidden" name="id" class="notify_id">
                    <input type="hidden" name="notify" class="email">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-column">{{awtTrans('النص الكتابي للايميل')}}</label>
                            <div class="controls">
                                <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary send-notify-button" >{{awtTrans('ارسال')}}</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{awtTrans('الفاء')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
