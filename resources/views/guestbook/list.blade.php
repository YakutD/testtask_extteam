<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Guest book') }}</div>
                <div class="card-body">
                    @if (session('status') && !empty($is_admin))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                     @endif
                    <div class="panel panel-default">
                        <div class="panel-body table-responsive">
                        @if(!empty($entries['data']))
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Message</th>
                                        @if(!empty($is_admin))
                                            <th scope="col">Approved</th>
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entries['data'] as $entry)
                                        <tr>
                                            <td>{{$entry['name']}}</td>
                                            <td>{{$entry['message']}}</td>
                                            @if(!empty($is_admin))
                                                <td>{{($entry['approved'] == 1) ? 'Yes' : 'No'}}</td>
                                                <td>
                                                    <a href="{{route('edit entry',$entry['id'])}}" target="_blank">
                                                        Edit
                                                    </a>
                                                    /
                                                    <a class="del"  href="{{route('delete entry', $entry['id'])}}">
                                                        Delete
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>  
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $links !!}
                            </div> 
                        @else
                            There are no entries.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>