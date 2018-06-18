@if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
    @elseif(session('trash-message'))
        <?php list($message, $postID) = session('trash-message') ?>
            {!! Form::open(['method' => 'PUT','route' => ['blog.restore',$postID]]) !!}
        <div class="alert alert-danger">
            {{ $message }}
            <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-undo"></i> Geri Al</button>
        {!! Form::close() !!}
    </div>
@endif