@extends('Main')

@section('css')
    <link rel="stylesheet" href="/public/css/profile.css">
@endsection

@section('Posts')
    <div class="panel panel-default">
        <div class="panel-heading">  <h3 >Профиль пользователя</h3></div>
        <div class="panel-body">
            <div class="box box-info">
                <div class="box-body">
                    <div class="col-sm-6">
                        <div  align="center"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">
                            @if($user->id == Auth::id())
                             <input id="profile-image-upload" class="hidden" type="file">
                                <div>Нажмите для загрузки изображения</div>
                                        <!--Upload Image Js And Css-->
                            @endif
                        </div>

                        <br>
                        <!-- /input-group -->
                    </div>
                    <div class="col-sm-6">
                        <h4 style="color:#00b1b1;">{{ $user->name }} </h4></span>
                        <span><p>
                                <?php
                                    switch($user->role){
                                        case 0 : echo 'Пользователь';break;
                                        case 1 : echo 'Модератор';break;
                                        case 2 : echo 'Администратор';break;
                                    }
                                ?>
                            </p></span>
                    </div>
                    <div class="clearfix"></div>
                        <hr style="margin:5px 0 5px 0;">
                                <div class="col-sm-5 col-xs-6 tital " >Имя:</div><div class="col-sm-7 col-xs-6 ">{{ $user->name }}</div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital " >Дата регистрации</div><div class="col-sm-7">{{ $user->created_at }}</div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital " >Date Of Birth:</div><div class="col-sm-7">11 Jun 1998</div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital " >Place Of Birth:</div><div class="col-sm-7">Shirdi</div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital " >Nationality:</div><div class="col-sm-7">Indian</div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <!-- /.box-body -->
                    @if($user->id == Auth::id() || Auth::user()->role == 2)
                    <form action="{{ route('editUser', ['id' => $user->id]) }}" method="post">
                        <button type="submit" class="btn btn-sm btn-warning">Редактировать</button>
                        {{csrf_field()}}
                    </form>
                    @endif
                            </div>
                            <!-- /.box -->

                        </div>
                    </div>
                </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('#profile-image1').on('click', function() {
                $('#profile-image-upload').click();
            });
        });
    </script>
@endsection