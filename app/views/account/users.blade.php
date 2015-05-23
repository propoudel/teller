<table>
    <tbody>
    <tr>
        <td>Created At</td>
        <td>Name</td>
        <td>Email</td>
    </tr>
    @foreach($users as $user)
    <tr>
        {{--<td>{{formatDate($user['created_at'])}}</td>--}}
        <td>{{ $user['created_at'] }}</td>
        <td>{{$user['username']}}</td>
        <td>{{$user['email']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>