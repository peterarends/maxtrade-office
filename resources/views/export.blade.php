<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 10px;
        }

        body {
            width: 185mm;
        }

        body,
        input {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            line-height: 150%;
        }

        p {
            margin: 0 0 6px;
            clear: both;
        }

        table,
        td,
        th {
            border-collapse: collapse;
            border: 1px solid #000;
        }

        input {
            padding: 0;
        }

        input[type="text"] {
            border-top: 0 none #000;
            border-left: 0 none #000;
            border-right: 0 none #000;
            border-bottom: 1px dotted #000;
        }

        ._7pt {
            font-size: 7pt;
        }

        ._8pt {
            font-size: 8pt;
        }

        ._9pt {
            font-size: 9pt;
        }

        ._10pt {
            font-size: 10pt;
        }

        .b {
            font-weight: bold;
        }

        .i {
            font-style: italic;
        }

        .c {
            text-align: center;
        }

        .r {
            text-align: right;
        }

        ._100p {
            width: 100%;
        }

        ._185mm {
            width: 185mm;
        }

        ._30mm {
            width: 30mm;
        }

        ._20mm {
            width: 20mm;
        }

        .yellow {
            background-color: #ff9;
        }

        .yellow_body {
            background-color: #ff9;
            border: 1px solid #000;
            padding-left: 5px;
            padding-right: 5px
        }

        .grey {
            background-color: #DCDCDC;
        }

        .white {
            background-color: #FFF;
            border: 1px solid #000;
            padding-left: 5px;
            padding-right: 5px
        }

        .tidy {
            margin-bottom: 0 !important;
        }

        .tidy2 {
            line-height: 120% !important;
        }

        .float {
            float: right;
        }

        .bgn {
            content: ' лв.';
        }

        .break {
            page-break-after: always;
        }

        @media print {
            .hidden {
                display: none;
            }

            body {
                margin: 0 !important;
            }
        }
    </style>

    <script type="text/javascript">
        window.onload = function() {
				
				var now = new Date();
				var d = now.getDate();
				var m = now.getMonth();
				var y = now.getFullYear();
				
				if (d.toString().length == 1) {
					d = '0' + d;
				}
				if (m.toString().length == 1) {
					m = '0' + m;
				}
				
				var dt = d + '.' + m + '.' + y + ' г.';
			};
			
    </script>
</head>

<body>
    <p class="hidden r">
        <button onclick="window.print();">Print</button>
    </p>
    <p>
        <span>Start: {{$start}}</span>
        <span class="float">End: {{$stop}}</span>
    </p>
    <hr>
    <p>
        <span class="b _10pt">{{$title}}: </span>
        <span>{{$body}}</span>
    </p>
    <hr>
    @foreach ($tasks as $task)
    @php
    if ($task->status){
    $status_bg = "yellow";
    $body_bg = "yellow_body";
    $checked_end = "";
    $checked_active = "checked";
    }else{
    $status_bg = "grey";
    $body_bg = "white";
    $checked_end = "checked";
    $checked_active = "";
    }
    @endphp
    <table class="_100p">
        <tbody>
            <tr>
                <td style="width: 45mm" class="_8pt b c {{$status_bg}}">{{$task->title}}</td>
                <td class="_7pt {{$body_bg}}">
                    <p class="tidy2">
                        <span class="b">Completed <input type="radio" {{$checked_end}}> Active <input type="radio"
                                {{$checked_active}}></span><br>
                        {!! $task->body !!}
                    </p>
                    @if (!empty($task->decision))
                    <p class="tidy2">
                        <span class="b">Decision</span> {!! $task->decision !!}
                    </p>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <div style="padding-bottom:3px;"></div>
    @endforeach
</body>

</html>