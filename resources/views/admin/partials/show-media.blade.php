<tr>
    <th>{{ __("cruds.$namespace.fields.$name") }}</th>
    <td>
        @foreach($model->getMedia($name) as $media)
            {!! sprintf('<img src="%s" />', $media->getFullUrl('thumb')) !!}
        @endforeach
    </td>
</tr>
