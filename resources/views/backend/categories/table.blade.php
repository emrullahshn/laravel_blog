<table class="table table-bordered">
    <thead>
    <tr>
        <td width="80">Eylemler</td>
        <td>Kategori Adı</td>
        <td width="120">Makale Sayısı</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy',$category->id]]) !!}
                <a href="{{ route('categories.edit',$category->id)  }}"
                        class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @if($category->id != 'cms.default_category_id')
                    <button onclick="return confirm('Silmek istediğinizden emin misiniz?')" type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @else
                    <button disabled onclick="return confirm('Silmek istediğinizden emin misiniz?')" type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->posts()->count() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>