@extends('templates.templateAdmin') 
@section('title', 'relatórios')
@section('content')


<div class="dashboard">
    <div class="buttons">
        <div class="btn btn-outline-primary">
            <span>Pizzas mais vendidas</span>
        </div>
    </div>
    
    
    <div class="report-container" id="report-container">
        <div class="card">
            <div class="card-inside">
                <div class="info">
                    Marguerita
                </div>
                <i class="bi bi-activity icon"></i>
            </div>
        </div>
        {{-- @include('admin.reports.pizzas') --}}
    </div>
</div>


@endsection


