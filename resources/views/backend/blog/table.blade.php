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
    @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['blog.destroy',$post->id]]) !!}
                @if(check_user_permissions(request(),"Blog@edit",$post->id))
                    <a href="{{ route('blog.edit',$post->id)  }}"
                            class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                @else
                    <a href="#" disabled
                            class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                @endif
                @if(check_user_permissions(request(),"Blog@destroy",$post->id))
                    <button type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @else
                    <button type="submit" disabled
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td> {{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true) }}"> {{ $post->dateFormatted() }} </abbr>
                {!! $post->publicationLabel() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>