@extends('templates.templateAdmin') 
@section('title', 'relatórios')
@section('content')


<div class="dashboard">
    <div class="buttons">
        <div class="btn btn-outline-primary" data-report="pizzas">
            Pizzas mais vendidas
        </div>
        <div class="btn btn-outline-primary" data-report="clients">
            Clientes mais ativos
        </div>
        <div class="btn btn-outline-primary" data-report="pizzas">
            Regiões Ativas
        </div>
    </div>
    
    
    <div class="report-container" >
        <div id="report-container">
                
                
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        const reportType = this.getAttribute('data-report');
        fetch(`/admin/reports/${reportType}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('report-container').innerHTML = html;
            });
    });
});
</script>
@endsection




