<!DOCTYPE html>
<html lang="en">
<head>
    <title>Coding test</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('_landing/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('_landing/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('_landing/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('_landing/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('_landing/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('_landing/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('_landing/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('_landing/css/main.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            @if(count($books) > 0)
                <div class="table100">
                <table>
                    <thead>
                    <tr class="table100-head">
                        <th class="column1">Id</th>
                        <th class="column2">Name</th>
                        <th class="column3">Isbn</th>
                        <th class="column4">Authors</th>
                        <th class="column5">No of Pages</th>
                        <th class="column6">Publisher</th>
                        <th class="column6">Country</th>
                        <th class="column6">Release</th>
                        <th class="column6">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($books as $key => $book)
                            <td class="column1">{{$book->id}}</td>
                            <td class="column2">{{$book->name}}</td>
                            <td class="column3">{{$book->isbn}}</td>
                            <td class="column4" style="width: 100px!important;">
                                @foreach($authors[$key] as $key => $author)
                                        {{$author}} ,
                                @endforeach
                            </td>
                            <td class="column4">{{$book->no_of_pages}}</td>
                            <td class="column5">{{$book->publisher->name}}</td>
                            <td class="column6">{{$book->country->name}}</td>
                            <td class="column6">{{$book->$date}}</td>
                            <td class="column6">
                                <div class="row"><div class="col-sm-8">
                                        <a href="{{route('delete-book', ["id" => $book->id])}}">
                                            <button type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="#">
                                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#update-tab-{{$key}}">Update</button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>

                    </tbody>
                </table>
            </div>
            @else
                <div class="table100">
                    <div class="alert alert-info" style="margin-top: 10px; margin-left: 10px;">
                        No book in the table
                    </div>
                </div>
            @endif
        </div>
    </div>
    @foreach($books as $key => $book)
        <div id="update-tab-{{$key}}" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kindly Update This book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('update-book', ["id" => $book->id])}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="email" style="background-color: rebeccapurple !important;">
                        </div>
                        <div class="form-group">
                            <label for="isbn">Isbn:</label>
                            <input type="text" class="form-control" name="isbn" id="isbn" style="background-color: rebeccapurple !important;">
                        </div>
                        <div class="form-group">
                            <label for="author">Authors:</label>
                            <input type="text" class="form-control" name="author[]" id="author" style="background-color: rebeccapurple !important;">
                        </div>
                        <div class="form-group">
                            <label for="Country">Country:</label>
                            <input type="text" class="form-control" name="country" id="country" style="background-color: rebeccapurple !important;">
                        </div>
                        <div class="form-group">
                            <label for="No of pages">Number of Pages:</label>
                            <input type="number" class="form-control" name="number_of_pages" id="no-of_pages" style="background-color: rebeccapurple !important;">
                        </div>
                        <div class="form-group">
                            <label for="Publisher">Publisher:</label>
                            <input type="text" class="form-control" name="publisher" id="publisher" style="background-color: rebeccapurple !important;">
                        </div>
                        <div class="form-group">
                            <label for="release_date">release_date:</label>
                            <input type="date" class="form-control" name="release_date" id="release_date" style="background-color: rebeccapurple !important;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>




<!--===============================================================================================-->
<script src="{{asset('_landing/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('_landing/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('_landing/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('_landing/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('_landing/js/main.js')}}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">
    @if(session('failure'))
    toastr.error('{{session("failure")}}');
    @endif
    @if(session('success'))
    toastr.success('{{session("success")}}');
    @endif
</script>

</body>
</html>