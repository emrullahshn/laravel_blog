<table class="table table-bordered">
    <thead>
    <tr>
        <td width="80">Eylemler</td>
        <td>Başlık</td>
        <td width="120">Yazar</td>
        <td width="150">Kategori</td>
        <td width="160">Tarih</td>
    </tr>
    </thead>
    <tbody>
    <?php $request = request(); ?>
    @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['style' => 'display:inline-block;','method' => 'PUT', 'route' => ['blog.restore',$post->id]]) !!}
                @if(check_user_permissions($request, "Blog@restore",$post->id))
                    <button type="submit" title="Kurtar" class="btn btn-xs btn-default">
                        <i class="fa fa-refresh"></i>
                    </button>
                @else
                    <button type="submit" title="Kurtar" onclick="return false;" class="btn btn-xs btn-default disabled">
                        <i class="fa fa-refresh"></i>
                    </button>
                @endif
                {!! Form::close() !!}
                {!! Form::open(['style' => 'display:inline-block;','method' => 'DELETE', 'route' => ['blog.force-destroy',$post->id]]) !!}
                @if(check_user_permissions($request, "Blog@forceDestroy",$post->id))
                <button title="Kalıcı Olarak Sil"
                        onclick="return confirm('Makaleyi kalıcı olarak silmek istediğinizden emin misiniz?')"
                        type="submit"
                        class="btn btn-xs btn-danger">
                    <i class="fa fa-times"></i>
                </button>
                @else
                <button title="Kalıcı Olarak Sil"
                        onclick="return false;"
                        type="submit"
                        class="btn btn-xs btn-danger disabled">
                    <i class="fa fa-times"></i>
                </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td> {{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true) }}"> {{ $post->dateFormatted() }} </abbr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>