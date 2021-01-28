<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $name }}</title>
    <style>
        @font-face {
            font-family: "DejaVu Sans";
            font-style: normal;
            font-weight: 400;
            src: url("front/fonts/arialuni.ttf");
            /* IE9 Compat Modes */
            src:
                local("DejaVu Sans"),
                local("DejaVu Sans"),
                url("front/fonts/arialuni.ttf") format("truetype");
        }
        body {
            font-family: "DejaVu Sans";
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>{{ $name }}</h1>
    <table>
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($routeData as $data)
            <tr>
                <th>
                    {{ $data->number }}
                </th>
                <td>
                    <a href="{{ $data->page_link }}" target="_blank">{{ $data->name }}</a>
                </td>
                <td>
                    <a href="{{ $data->page_link }}">
                        <img src="data:image/svg+xml;base64,{{ $data->image }}" alt="" >
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
