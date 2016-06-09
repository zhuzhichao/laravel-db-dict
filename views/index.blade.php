<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel DB dict</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via table:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            padding: 25px;
        }

        h1 {
            font-size: 1.5em;
            margin-top: 0;
        }

        .stack {
            font-size: 0.85em;
        }

        .date {
            min-width: 75px;
        }

        .text {
            word-break: break-all;
        }

        a.llv-active {
            z-index: 2;
            background-color: #f5f5f5;
            border-color: #777;
        }
        #table-dict {
            font-size: 12px;
        }

        #table-dict .description {
            padding: 0;
        }

        .description input {
            padding-left: 5px;
            padding-right: 5px;
            width: 100%;
            height: 100%;
            border: none;
        }

        #table-dict .table-description {
            padding: 0;
        }

        .table-description input {
            padding-left: 5px;
            padding-right: 5px;
            width: 300px;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h1><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Laravel DB Dict</h1>
            <p class="text-muted"><i>by zhuzhichao</i></p>
            <div class="list-group">
                @foreach($tables as $table)
                    <a href="?table_id={{ $table->id }}"
                       class="list-group-item {{ $current_table->id == $table->id ? 'llv-active' : '' }}"
                       title="{{ $table->description }}"
                    >
                        {{$table->name}}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="col-sm-9 col-md-10 table-container">
            @if ($columns === null)
                <div>
                    Log file >50M, please download it.
                </div>
            @else
                <div>
                    <h2>{{ $current_table->name }}
                        <small class="table-description">
                            <input data-table_id="{{ $current_table->id }}"
                                   placeholder="添加描述"
                                   value="{{ $current_table->description }}">
                            <button class="pull-right btn btn-info" id="sync-db"><i
                                        class="glyphicon glyphicon-refresh"></i> 同步
                            </button>
                        </small>
                    </h2>
                </div>
                <hr>
                <table id="table-dict" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>字段名</th>
                        <th>类型</th>
                        <th>默认值</th>
                        <th>索引</th>
                        <th>是否为空</th>
                        <th>其他</th>
                        <th>字段备注</th>
                        <th>描述</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($columns as $column)
                        <tr>
                            <td>{{ $column->name }}</td>
                            <td>{{ $column->type }}</td>
                            <td>{{ $column->default }}</td>
                            <td>{{ $column->key }}</td>
                            <td>{!! $column->is_nullable !!}</td>
                            <td>{{ $column->extra }}</td>
                            <td>{{ $column->comment }}</td>
                            <td class="description">
                                <input type="text" data-column_id="{{ $column->id }}"
                                       placeholder="点击添加描述"
                                       value="{{ $column->description }}">
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif
            <div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.min.js"></script>
<script>
    $(document).ready(function () {
        var $table = $('#table-dict');
        $table.DataTable({
            "ordering"    : false,
            "aLengthMenu" : [25, 50, 100]
        });

        $table.on('change', '.description input', function () {
            $.post('{{ route('db-dict::index') }}/column/' + $(this).data('column_id'), {
                _method     : 'PUT',
                _token      : '{{ csrf_token() }}',
                description : $(this).val()
            }, function (result) {
                console.log(result);
            });
        });

        $(document).on('change', '.table-description input', function () {
            $.post('{{ route('db-dict::index') }}/table/' + $(this).data('table_id'), {
                _method     : 'PUT',
                _token      : '{{ csrf_token() }}',
                description : $(this).val()
            }, function (result) {
                console.log(result);
            });
        });

        $(document).on('keyup', '.table-description input, .description input', function (event) {
            if (event.keyCode == 13) {
                $(this).blur();
            }
        });

        $('#sync-db').click(function () {
            $.post('{{ route('db-dict::db-dict-sync') }}', {
                _token      : '{{ csrf_token() }}',
                description : $(this).val()
            }, function (result) {
                location.reload();
            });
        });

//        var bar = new ProgressBar.Line('.list-group-item', {easing: 'easeInOut'});
//        bar.animate(1);
    });
</script>
</body>
</html>