<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    @include('admin.css')

    <style type="text/css">
        .font_size {
            font-size: 40px;
            padding-top: 10px;
            padding-bottom: 20px;
            color: black;
        }



        .th_color {
            background: #7FAD39;
        }



        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td {
            background: white;
            color: black;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {}
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper" style="background: rgb(181, 180, 180)">


                @if (session()->has('message'))
                    <div class="alert alert-success">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

                        {{ session()->get('message') }}

                    </div>
                @endif





                <h2 class="font_size">All Customers</h2>

                <div style="overflow: auto;">
                    <table class="center">

                        <tr class="th_color">
                            <th class="th_deg">Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Contact</th>
                            <th class="th_deg">Address</th>

                        </tr>

                        @foreach ($user as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>



                            </tr>
                        @endforeach

                    </table>
                </div>

            </div>

            @include('admin.footer')
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
