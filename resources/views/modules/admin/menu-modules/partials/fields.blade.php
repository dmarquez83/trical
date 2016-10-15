<div class="form-group">
    {!! Form::label('type_user', 'Tipo') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-navicon"></i>
        </span>
        {!! Form::select('type_access',  array('Usuario' => 'Usuario', 'Grupo' => 'Grupo'), null , ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('id_type_user', 'Grupo/User Id') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-navicon"></i>
        </span>
        {!! Form::select('id_type_user',  null, null , ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('menu_modules_id', 'Pantalla') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-navicon"></i>
        </span>
        {!! Form::select('menu_modules_id', $menu_modules, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('route_id', 'Ruta') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-navicon"></i>
        </span>
        {!! Form::select('route_id', $routes, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('type_access', 'Tipo') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-navicon"></i>
        </span>
        {!! Form::select('type_access',  array('Pantalla' => 'Pantalla', 'Reporte' => 'Reporte'), null , ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('menu_item', 'Se incluye en el menú?') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-navicon"></i>
        </span>
        {!! Form::select('menu_item', array('Y' => 'Si', 'N' => 'No'), null , ['class' => 'form-control']) !!}
    </div>
</div>
