@extends('layouts.app')

@section('paysheet')
    <div class="message drop-list">
        <span>
            قائمة السداد لهذا اليوم    2019-8-20
        </span>
        <ul>
            <li>
                <a href="#" onclick="$('.large-modal').modal('show');" data-toggle="modal" data-target=".large-modal" title=""><span><img src="http://placehold.it/40x40" alt="" /></span><i>محمد احمد الحسن</i> 140 ريال </a>
            </li>
            <li>
                <a href="#" onclick="$('.large-modal').modal('show');" data-toggle="modal" data-target=".large-modal" title=""><span><img src="http://placehold.it/40x40" alt="" /></span><i>محمد احمد الحسن</i> 140 ريال </a>
            </li>
            <li>
                <a href="#" onclick="$('.large-modal').modal('show');" data-toggle="modal" data-target=".large-modal" title=""><span><img src="http://placehold.it/40x40" alt="" /></span><i>محمد احمد الحسن</i> 140 ريال </a>
            </li>
            <li>
                <a href="#" onclick="$('.large-modal').modal('show');" data-toggle="modal" data-target=".large-modal" title=""><span><img src="http://placehold.it/40x40" alt="" /></span><i>محمد احمد الحسن</i> 140 ريال </a>
            </li>
        </ul>
        <a href="#" onclick="return false ;$('.paysheetlistModal').modal('show');" title="">إظهار الكل</a>
    </div>
@endsection



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
