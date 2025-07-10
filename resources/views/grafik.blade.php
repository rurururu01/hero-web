<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Stok - Hero Surplus</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }
        
        .chart-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .chart-title {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .chart-subtitle {
            color: #666;
            font-size: 1.1rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }
        
        .stat-card.minuman {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .chart-wrapper {
            position: relative;
            height: 400px;
            width: 100%;
            margin: 2rem 0;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
            margin-bottom: 2rem;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .detail-section {
            margin-top: 3rem;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }
        
        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .detail-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .detail-header.makanan {
            color: #ff6b35;
        }
        
        .detail-header.minuman {
            color: #8b5cf6;
        }
        
        .detail-list {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .item-name {
            font-weight: 500;
            color: #333;
        }
        
        .item-stock {
            font-weight: bold;
            padding: 4px 12px;
            border-radius: 20px;
            color: white;
            font-size: 0.9rem;
        }
        
        .item-stock.makanan {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
        }
        
        .item-stock.minuman {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
        }
        
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 2rem;
        }
    </style>
</head>

<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
        
        <!-- Back Button -->
        <a href="{{ route('daftardata') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data
        </a>

        <!-- Main Chart Container -->
        <div class="chart-container">
            <div class="chart-header">
                <h1 class="chart-title">
                    <i class="fas fa-chart-bar"></i>
                    Grafik Stok Surplus
                </h1>
                <p class="chart-subtitle">Total Stok Makanan vs Minuman</p>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ number_format($totalMakanan) }}</div>
                    <div class="stat-label">
                        <i class="fas fa-utensils"></i>
                        Total Stok Makanan
                    </div>
                </div>
                <div class="stat-card minuman">
                    <div class="stat-value">{{ number_format($totalMinuman) }}</div>
                    <div class="stat-label">
                        <i class="fas fa-coffee"></i>
                        Total Stok Minuman
                    </div>
                </div>
            </div>            <!-- Chart Canvas -->
            <div class="chart-wrapper">
                <canvas id="stockChart" 
                        data-makanan="{{ $totalMakanan ?? 0 }}" 
                        data-minuman="{{ $totalMinuman ?? 0 }}"></canvas>
            </div>
        </div>

        <!-- Detail Section -->
        <div class="detail-section">
            <div class="detail-grid">
                <!-- Detail Makanan -->
                <div class="detail-card">
                    <div class="detail-header makanan">
                        <i class="fas fa-utensils"></i>
                        Detail Stok Makanan
                    </div>
                    <div class="detail-list">
                        @if($detailMakanan->count() > 0)
                            @foreach($detailMakanan as $item)
                                <div class="detail-item">
                                    <span class="item-name">{{ $item->nama_barang }}</span>
                                    <span class="item-stock makanan">{{ number_format($item->stok) }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="no-data">
                                <i class="fas fa-inbox"></i><br>
                                Tidak ada data makanan
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Detail Minuman -->
                <div class="detail-card">
                    <div class="detail-header minuman">
                        <i class="fas fa-coffee"></i>
                        Detail Stok Minuman
                    </div>
                    <div class="detail-list">
                        @if($detailMinuman->count() > 0)
                            @foreach($detailMinuman as $item)
                                <div class="detail-item">
                                    <span class="item-name">{{ $item->nama_barang }}</span>
                                    <span class="item-stock minuman">{{ number_format($item->stok) }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="no-data">
                                <i class="fas fa-inbox"></i><br>
                                Tidak ada data minuman
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>    </div>

    <script>
        // Ambil data dari data attributes
        const chartCanvas = document.getElementById('stockChart');
        const totalMakanan = parseInt(chartCanvas.dataset.makanan) || 0;
        const totalMinuman = parseInt(chartCanvas.dataset.minuman) || 0;
        
        // Chart.js Configuration
        const ctx = chartCanvas.getContext('2d');
        
        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Makanan', 'Minuman'],
                datasets: [{
                    label: 'Total Stok',
                    data: [totalMakanan, totalMinuman],
                    backgroundColor: [
                        'linear-gradient(135deg, #ff6b35, #f7931e)',
                        'linear-gradient(135deg, #8b5cf6, #a855f7)'
                    ],
                    borderColor: [
                        '#ff6b35',
                        '#8b5cf6'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Total Stok: ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            },
                            color: '#666',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#666',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    bar: {
                        backgroundColor: function(context) {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            
                            if (!chartArea) {
                                return null;
                            }
                            
                            if (context.dataIndex === 0) {
                                // Makanan gradient
                                const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                                gradient.addColorStop(0, '#f7931e');
                                gradient.addColorStop(1, '#ff6b35');
                                return gradient;
                            } else {
                                // Minuman gradient
                                const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                                gradient.addColorStop(0, '#a855f7');
                                gradient.addColorStop(1, '#8b5cf6');
                                return gradient;
                            }
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Add hover effects
        stockChart.options.onHover = function(event, activeElements) {
            event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
        };
    </script>
</body>
</html>
