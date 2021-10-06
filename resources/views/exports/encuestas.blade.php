<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Genero</th>
        <th>Hobby</th>
        <th>Dedicación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($encuestas as $encuesta)
        <tr>
            <td>{{ $encuesta->nombre }}</td>
            <td>{{ $encuesta->genero }}</td>
            <td>{{ $encuesta->hobby }}</td>
            <td>{{ $encuesta->dedicacion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
