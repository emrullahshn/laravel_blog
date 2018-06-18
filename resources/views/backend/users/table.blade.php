<table class="table table-bordered">
    <thead>
    <tr>
        <td width="80">Eylemler</td>
        <td>Ad Soyad</td>
        <td>Email</td>
        <td>Rol</td>
    </tr>
    </thead>
    <tbody>
    <?php $currentUser = auth()->user()->id; ?>
    @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('users.edit',$user->id)  }}"
                        class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @if($user->id == config('cms.default_user_id') || $user->id == $currentUser)
                    <button disabled onclick="return confirm('Silmek istediğinizden emin misiniz?')" type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @else
                    <a href="{{ route('backend.users.confirm',$user->id) }}" onclick="return confirm('Silmek istediğinizden emin misiniz?')" type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                @endif

            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roles->first()->display_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>