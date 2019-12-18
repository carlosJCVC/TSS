<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<main class="main">
    <div class="fade-in">
        <h4 style="text-align: center">Datos de la simulacion</h4>
        <table>
            <thead style="background-color: cadetblue">
                <tr>
                    <th>#</th>
                    <th>Demanda</th>
                    <th>Precio Venta</th>
                    <th>Precio Compra</th>
                    <th>Coste Compra</th>
                    <th>Coste 20</th>
                    <th>Beneficios 20</th>
                    <th>Coste 22</th>
                    <th>Beneficios 22</th>
                    <th>Coste 24</th>
                    <th>Beneficios 24</th>
                    <th>Coste 26</th>
                    <th>Beneficios 26</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->demand }}</td>
                    <td>{{ $item->sale_price }}</td>
                    <td>{{ $item->purchase_price }}</td>
                    <td>{{ $item->purchase_cost }}</td>
                    <td>{{ $item->excess_cost_20 }}</td>
                    <td>{{ $item->benefits_20 }}</td>
                    <td>{{ $item->excess_cost_22 }}</td>
                    <td>{{ $item->benefits_22 }}</td>
                    <td>{{ $item->excess_cost_24 }}</td>
                    <td>{{ $item->benefits_24 }}</td>
                    <td>{{ $item->excess_cost_26 }}</td>
                    <td>{{ $item->benefits_26 }}</td>
                </tr>
                @empty
                    Vacio
                @endforelse
            </tbody>
        </table>
    </div>
</main>

</body>
</html>