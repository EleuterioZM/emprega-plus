@extends('layouts.app')
@section('title', 'Dashboard - Emprega+')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Painéis de Estatísticas -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Candidatos</h5>
                        <h1 class="card-text">1,234</h1>
                        <div class="card-footer">
                            <small class="text-muted">Atualizado há 1 hora</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Vagas Publicadas</h5>
                        <h1 class="card-text">567</h1>
                        <div class="card-footer">
                            <small class="text-muted">Atualizado há 2 horas</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Candidaturas</h5>
                        <h1 class="card-text">345</h1>
                        <div class="card-footer">
                            <small class="text-muted">Atualizado há 30 minutos</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Gráfico de Candidaturas -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gráfico de Candidaturas</h5>
                        <canvas id="candidatureChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            var ctx = document.getElementById('candidatureChart').getContext('2d');
                            var candidatureChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                                    datasets: [{
                                        label: 'Candidaturas',
                                        data: [15, 25, 10, 30, 18, 22],
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>

            <!-- Tabela de Últimos Candidatos -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Últimos Candidatos</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Perfil</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>João da Silva</td>
                                    <td><a href="#">Ver Perfil</a></td>
                                    <td><span class="badge bg-success">Ativo</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Maria Oliveira</td>
                                    <td><a href="#">Ver Perfil</a></td>
                                    <td><span class="badge bg-warning">Em Espera</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Carlos Santos</td>
                                    <td><a href="#">Ver Perfil</a></td>
                                    <td><span class="badge bg-danger">Rejeitado</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Tabela de Últimas Vagas -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Últimas Vagas Publicadas</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vaga</th>
                                    <th>Empresa</th>
                                    <th>Status</th>
                                    <th>Data de Publicação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Desenvolvedor Front-End</td>
                                    <td>Tech Solutions</td>
                                    <td><span class="badge bg-success">Aberta</span></td>
                                    <td>05/12/2024</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Analista de Sistemas</td>
                                    <td>Innovative IT</td>
                                    <td><span class="badge bg-secondary">Fechada</span></td>
                                    <td>04/12/2024</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Designer Gráfico</td>
                                    <td>Creative Studio</td>
                                    <td><span class="badge bg-warning">Em Andamento</span></td>
                                    <td>03/12/2024</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
