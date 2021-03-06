@extends('partials.home.app')
@section('name')
    Grupos
@endsection
@section('title')
    Listado
@endsection
@section('configure')
@endsection
@section('sidebar')
       <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="">
                <div class="row">
                    <div class="col-md-12">

                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-users"></i>Grupos

                                        <a href="{{ route('admin.groups.create') }}" class="btn btn-default btn-sm btn-circle">
                                            <i class="fa fa-plus"></i> Nuevo </a>


                                </div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                @include('modules.admin.groups.partials.table')
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->

    {!! Form::open(['route' => ['admin.groups.destroy', ':USER_ID'], 'method' => 'DELETE','id' =>'form-delete']) !!}
    {!! Form::close() !!}

@endsection

@section('scripts_interno')
    {!! Html::script('assets/js/admin/delete.js') !!}
@endsection