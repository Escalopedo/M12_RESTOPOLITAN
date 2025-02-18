@foreach($users as $user)
    <tr id="user-{{ $user->id }}">
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name ?? 'No asignado' }}</td>
        <td>{{ $user->password }}</td>
        <td>
            <button class="btn btn-primary edit-user" data-id="{{ $user->id }}">Editar</button>
            <button class="btn btn-danger delete-user" data-id="{{ $user->id }}">Eliminar</button>
        </td>
    </tr>
@endforeach