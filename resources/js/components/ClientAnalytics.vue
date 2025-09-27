<template>
  <div class="client-analytics">
    <!-- Content Area -->
    <div class="bg-white rounded-lg shadow relative">
      <!-- Loading Overlay -->
      <div v-if="loading" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10 rounded-lg">
        <div class="flex items-center space-x-2">
          <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
          <span class="text-gray-600">Carregando dados...</span>
        </div>
      </div>

      <!-- Chart Views -->
      <div v-if="activeView === 'grafico'" class="p-6 relative">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Performance Comercial por Cliente</h3>

        <div class="h-96 flex items-center justify-center bg-gray-50 rounded-lg">
          <canvas ref="barChart" width="900" height="400" class="max-w-full max-h-full"></canvas>
        </div>
      </div>

      <div v-if="activeView === 'pizza'" class="p-6 relative">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Participação na Receita por Cliente</h3>

        <div class="h-96 flex items-center justify-center bg-gray-50 rounded-lg">
          <canvas ref="pieChart" width="400" height="400" class="max-w-full max-h-full"></canvas>
        </div>
      </div>

      <!-- Table View -->
      <div v-if="activeView === 'relatorio'" class="p-6 relative">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Relatório Detalhado</h3>
        <div class="overflow-x-auto" v-if="!loading && tableData.length > 0">
          <!-- Pivot Table: Periods as Rows, Selected Clients as Columns -->
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50">Período</th>
                <th v-for="clientName in pivotTableData.clientNames" :key="clientName"
                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[120px]">
                  {{ clientName }}
                </th>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider font-semibold bg-blue-50">TOTAL</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <!-- Data Rows -->
              <tr v-for="periodData in pivotTableData.periods" :key="periodData.period" class="hover:bg-gray-50 border-b border-gray-200">
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-medium sticky left-0 bg-white border-r">
                  {{ periodData.period }}
                </td>
                <td v-for="clientName in pivotTableData.clientNames" :key="clientName"
                    class="px-4 py-4 whitespace-nowrap text-sm text-right text-gray-900">
                  {{ formatCurrency(periodData.clients[clientName] || 0) }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-right font-semibold text-blue-600 bg-blue-50">
                  {{ formatCurrency(periodData.total) }}
                </td>
              </tr>
              <!-- TOTAL Row -->
              <tr class="bg-gray-100 font-semibold border-t-2 border-gray-300">
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-bold sticky left-0 bg-gray-100 border-r">
                  TOTAL
                </td>
                <td v-for="clientName in pivotTableData.clientNames" :key="clientName"
                    class="px-4 py-4 whitespace-nowrap text-sm text-right font-semibold text-gray-900">
                  {{ formatCurrency(pivotTableData.clientTotals[clientName] || 0) }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-right font-bold text-blue-600 bg-blue-100">
                  {{ formatCurrency(pivotTableData.grandTotal) }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Empty State -->
        <div v-else-if="!loading && tableData.length === 0" class="text-center py-12">
          <div class="text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum dado encontrado</h3>
            <p class="mt-1 text-sm text-gray-500">
              {{ selections.length === 0
                ? 'Selecione um ou mais clientes para ver os dados.'
                : 'Nenhum dado encontrado para os clientes selecionados no período especificado.'
              }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch, nextTick, onMounted } from 'vue'

interface TableRow {
  id: string
  name: string
  period: string
  period_start?: string
  period_end?: string
  net_revenue: number
  consultant_costs: number
  profit: number
  profit_margin?: number
  roi?: number
}

interface Props {
  activeView: string
  selections: string[]
  loading: boolean
  tableData: TableRow[]
  chartData: any
  pieChartData: any
  dashboardStats: any
}

const props = defineProps<Props>()
const barChart = ref<HTMLCanvasElement | null>(null)
const pieChart = ref<HTMLCanvasElement | null>(null)
const pivotTableData = computed(() => {
  if (!props.tableData || props.tableData.length === 0) {
    return {
      clientNames: [],
      periods: [],
      clientTotals: {},
      grandTotal: 0
    }
  }

  // Get unique client names (columns)
  const clientNames = Array.from(new Set(props.tableData.map(row => row.name))).sort()

  // Group data by period (rows)
  const periodMap: Record<string, { period: string, period_start: string, clients: Record<string, number>, total: number }> = {}

  props.tableData.forEach(row => {
    if (!periodMap[row.period]) {
      periodMap[row.period] = {
        period: row.period,
        period_start: row.period_start || '',
        clients: {},
        total: 0
      }
    }

    // Use net_revenue for the pivot table (main revenue metric)
    const value = row.net_revenue || 0
    periodMap[row.period].clients[row.name] = value
    periodMap[row.period].total += value
  })

  // Sort periods by period_start date
  const periods = Object.values(periodMap).sort((a, b) => {
    return a.period_start.localeCompare(b.period_start)
  })

  // Calculate client totals (column sums)
  const clientTotals: Record<string, number> = {}
  clientNames.forEach(clientName => {
    clientTotals[clientName] = periods.reduce((sum, period) => {
      return sum + (period.clients[clientName] || 0)
    }, 0)
  })

  // Calculate grand total
  const grandTotal = Object.values(clientTotals).reduce((sum, total) => sum + total, 0)

  return {
    clientNames,
    periods,
    clientTotals,
    grandTotal
  }
})

const formatCurrency = (value: number) => {
  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(Math.abs(value))
}

const drawBarChart = () => {
  const canvas = barChart.value
  if (!canvas) {
    return
  }

  const ctx = canvas.getContext('2d')
  if (!ctx) {
    return
  }

  ctx.clearRect(0, 0, canvas.width, canvas.height)

  if (props.loading) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Carregando dados...', canvas.width / 2, canvas.height / 2)
    return
  }

  if (props.selections.length === 0) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.textBaseline = 'middle'
    ctx.fillText('Selecione clientes para ver o gráfico', canvas.width / 2, canvas.height / 2 - 10)
    ctx.font = '12px Arial'
    ctx.fillStyle = '#999'
    ctx.fillText('Use o painel de transferência à esquerda para selecionar clientes', canvas.width / 2, canvas.height / 2 + 15)
    return
  }

  let clientNames: string[] = []
  let clientData: Record<string, number[]> = {}
  let months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai']
  let averageConsultantCosts = 2000

  if (props.chartData && props.chartData.clients && props.chartData.clients.length > 0) {
    clientNames = props.chartData.clients.map((c: any) => c.name)

    props.chartData.clients.forEach((client: any) => {
      const netRevenue = client.net_revenue || 0
      const consultantCosts = client.consultant_costs || 0

      // Show both revenue and costs
      clientData[client.name] = [Math.max(netRevenue, 100)] // At least 100 for visibility
      clientData[`${client.name} - Custos`] = [consultantCosts]
    })

    averageConsultantCosts = props.chartData.average_consultant_costs || 2000

    months = ['Período Selecionado']
  } else {
    clientNames = ['Toyota', 'Traffic', 'Unicoba', 'WebMotors', 'TIM']
    clientData = {
      'Toyota': [35000, 40000, 28000, 42000, 38000],
      'Traffic': [25000, 30000, 22000, 28000, 26000],
      'Unicoba': [15000, 18000, 12000, 20000, 17000],
      'WebMotors': [12000, 15000, 10000, 16000, 14000],
      'TIM': [8000, 10000, 7000, 11000, 9000]
    }
    months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai']
  }

  clientData['Custo Médio de Consultoria'] = months.map(() => averageConsultantCosts)

  const colors = {
    'Toyota': '#10B981',
    'Traffic': '#3B82F6',
    'Unicoba': '#F59E0B',
    'WebMotors': '#EF4444',
    'TIM': '#8B5CF6',
    'Custo Médio de Consultoria': '#DC2626' // Red for the line
  }

  // Chart dimensions
  const chartWidth = canvas.width - 180
  const chartHeight = canvas.height - 100
  const startX = 100
  const startY = 70
  const endX = startX + chartWidth
  const endY = startY + chartHeight

  // Calculate dynamic max value based on actual data
  let chartMaxValue = 45000 // default
  if (props.chartData && props.chartData.clients) {
    const revenues = props.chartData.clients.map((c: any) => c.net_revenue || 0)
    const costs = props.chartData.clients.map((c: any) => c.consultant_costs || 0)
    const allValues = [...revenues, ...costs, averageConsultantCosts]
    chartMaxValue = Math.max(...allValues, 5000) * 1.2
  }

  // Draw background grid
  ctx.strokeStyle = '#f0f0f0'
  ctx.lineWidth = 1

  // Horizontal grid lines
  const stepY = chartHeight / 9
  for (let i = 0; i <= 9; i++) {
    const y = startY + i * stepY
    ctx.beginPath()
    ctx.moveTo(startX, y)
    ctx.lineTo(endX, y)
    ctx.stroke()
  }

  // Draw axes
  ctx.strokeStyle = '#333'
  ctx.lineWidth = 2
  ctx.beginPath()
  ctx.moveTo(startX, startY)
  ctx.lineTo(startX, endY)
  ctx.lineTo(endX, endY)
  ctx.stroke()

  // Draw Y-axis labels
  ctx.fillStyle = '#666'
  ctx.font = '11px Arial'
  ctx.textAlign = 'right'
  for (let i = 0; i <= 9; i++) {
    const value = (chartMaxValue / 9) * (9 - i)
    const y = startY + i * stepY + 4
    if (value === 0) {
      ctx.fillText('R$ 0', startX - 10, y)
    } else {
      ctx.fillText(`R$ ${(value / 1000).toFixed(0)}.000,00`, startX - 10, y)
    }
  }

  // Draw X-axis labels
  months.forEach((month, index) => {
    const x = startX + (index + 1) * (chartWidth / (months.length + 1))
    ctx.fillStyle = '#666'
    ctx.font = '12px Arial'
    ctx.textAlign = 'center'
    ctx.fillText(month, x, endY + 20)
  })

  // Draw client lines
  clientNames.forEach((client: string) => {
    const data = clientData[client] || []
    const color = colors[client] || '#10B981'

    ctx.strokeStyle = color
    ctx.lineWidth = 3
    ctx.beginPath()

    data.forEach((value, index) => {
      const x = startX + (index + 1) * (chartWidth / (months.length + 1))
      const y = endY - (value / chartMaxValue) * chartHeight

      if (index === 0) {
        ctx.moveTo(x, y)
      } else {
        ctx.lineTo(x, y)
      }

      // Draw data points
      ctx.fillStyle = color
      ctx.beginPath()
      ctx.arc(x, y, 4, 0, 2 * Math.PI)
      ctx.fill()
    })

    ctx.stroke()
  })

  // Draw average line if exists
  if (clientData['Custo Médio de Consultoria']) {
    ctx.strokeStyle = colors['Custo Médio de Consultoria']
    ctx.lineWidth = 3
    ctx.setLineDash([5, 5]) // Dashed line
    ctx.beginPath()

    clientData['Custo Médio de Consultoria'].forEach((value, index) => {
      const x = startX + (index + 1) * (chartWidth / (months.length + 1))
      const y = endY - (value / chartMaxValue) * chartHeight

      if (index === 0) {
        ctx.moveTo(x, y)
      } else {
        ctx.lineTo(x, y)
      }
    })

    ctx.stroke()
    ctx.setLineDash([]) // Reset line dash
  }

  // Draw legend
  const legendStartX = endX + 30
  const legendStartY = startY + 30
  clientNames.forEach((client: any, index: number) => {
    const legendY = legendStartY + index * 22

    // Legend line
    ctx.strokeStyle = colors[client] || '#10B981'
    ctx.lineWidth = 3
    ctx.beginPath()
    ctx.moveTo(legendStartX, legendY - 3)
    ctx.lineTo(legendStartX + 20, legendY - 3)
    ctx.stroke()

    // Legend point
    ctx.fillStyle = colors[client] || '#10B981'
    ctx.beginPath()
    ctx.arc(legendStartX + 10, legendY - 3, 4, 0, 2 * Math.PI)
    ctx.fill()

    // Legend text
    ctx.fillStyle = '#333'
    ctx.font = '11px Arial'
    ctx.textAlign = 'left'
    ctx.fillText(client, legendStartX + 30, legendY)
  })

  // Add average line legend
  if (clientData['Custo Médio de Consultoria']) {
    const legendY = legendStartY + clientNames.length * 22
    ctx.strokeStyle = colors['Custo Médio de Consultoria']
    ctx.lineWidth = 3
    ctx.setLineDash([5, 5])
    ctx.beginPath()
    ctx.moveTo(legendStartX, legendY - 3)
    ctx.lineTo(legendStartX + 20, legendY - 3)
    ctx.stroke()
    ctx.setLineDash([])

    ctx.fillStyle = '#333'
    ctx.font = '10px Arial'
    ctx.fillText('Custo Médio', legendStartX + 30, legendY)
  }

  // Chart title
  ctx.fillStyle = '#333'
  ctx.font = 'bold 16px Arial'
  ctx.textAlign = 'center'
  ctx.fillText('Performance por Cliente', canvas.width / 2, 30)
  ctx.font = '12px Arial'
  ctx.fillStyle = '#666'
  ctx.fillText('Janeiro de 2007 a Maio de 2007', canvas.width / 2, 50)
}

const drawPieChart = () => {
  const canvas = pieChart.value
  if (!canvas) {
    return
  }

  const ctx = canvas.getContext('2d')
  if (!ctx) {
    return
  }

  ctx.clearRect(0, 0, canvas.width, canvas.height)

  if (props.loading) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Carregando dados...', canvas.width / 2, canvas.height / 2)
    return
  }

  if (props.selections.length === 0) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.textBaseline = 'middle'
    ctx.fillText('Selecione clientes para ver o gráfico', canvas.width / 2, canvas.height / 2 - 10)
    ctx.font = '12px Arial'
    ctx.fillStyle = '#999'
    ctx.fillText('Use o painel de transferência à esquerda para selecionar clientes', canvas.width / 2, canvas.height / 2 + 15)
    return
  }

  let data
  let chartTitle = 'Participação na Receita por Cliente'

  if (props.pieChartData && props.pieChartData.clients && props.pieChartData.clients.length > 0) {
    const clients = props.pieChartData.clients
    const colors = ['#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6', '#F97316', '#06B6D4', '#84CC16']

    const totalRevenue = clients.reduce((sum: any, c: any) => sum + (c.net_revenue || 0), 0)

    if (totalRevenue > 0) {
      data = clients.map((client: any, index: number) => ({
        label: client.name,
        value: client.net_revenue || 0,
        color: client.color || colors[index % colors.length]
      }))
      chartTitle = 'Participação na Receita por Cliente'
    } else {
      if (props.chartData && props.chartData.clients) {
        data = props.chartData.clients.map((client: any, index: number) => ({
          label: client.name,
          value: client.consultant_costs || 0,
          color: colors[index % colors.length]
        })).filter((item: any) => item.value > 0)
        chartTitle = 'Distribuição de Custos de Consultoria'
      } else {
        data = []
      }
    }
  } else if (props.pieChartData && props.pieChartData.chart_config) {
    const chartConfig = props.pieChartData.chart_config
    const colors = ['#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6', '#F97316', '#06B6D4', '#84CC16']

    data = chartConfig.labels.map((label: string, index: number) => ({
      label: label,
      value: chartConfig.datasets[0].data[index] || 0,
      color: chartConfig.datasets[0].backgroundColor[index] || colors[index % colors.length]
    }))
  } else {
    data = [
      { label: 'Toyota', value: 30, color: '#10B981' },
      { label: 'Traffic', value: 25, color: '#3B82F6' },
      { label: 'Unicoba', value: 20, color: '#F59E0B' },
      { label: 'WebMotors', value: 15, color: '#EF4444' },
      { label: 'TIM', value: 10, color: '#8B5CF6' }
    ]
  }

  const centerX = canvas.width / 2
  const centerY = canvas.height / 2
  const radius = Math.min(canvas.width, canvas.height) * 0.25 // Responsive radius

  // Calculate total for percentage calculation
  const total = data.reduce((sum: any, item: any) => sum + item.value, 0)

  // Handle case when all values are zero or no meaningful data
  if (total === 0 || !data.some((item: any) => item.value > 0)) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.textBaseline = 'middle'
    ctx.fillText('Nenhum dado de receita disponível', centerX, centerY - 10)
    ctx.font = '12px Arial'
    ctx.fillStyle = '#999'
    ctx.fillText('Selecione clientes com receita para ver o gráfico', centerX, centerY + 10)
    return
  }

  let currentAngle = -Math.PI / 2

  data.forEach((segment: any) => {
    const percentage = (segment.value / total) * 100
    const sliceAngle = (segment.value / total) * 2 * Math.PI

    // Draw slice
    ctx.beginPath()
    ctx.moveTo(centerX, centerY)
    ctx.arc(centerX, centerY, radius, currentAngle, currentAngle + sliceAngle)
    ctx.closePath()
    ctx.fillStyle = segment.color
    ctx.fill()

    // Draw slice border
    ctx.strokeStyle = '#fff'
    ctx.lineWidth = 2
    ctx.stroke()

    // Draw label only if slice is big enough
    if (percentage > 5) {
      const labelAngle = currentAngle + sliceAngle / 2
      const labelRadius = radius + 35
      const labelX = centerX + Math.cos(labelAngle) * labelRadius
      const labelY = centerY + Math.sin(labelAngle) * labelRadius

      ctx.fillStyle = '#333'
      ctx.font = 'bold 11px Arial'
      ctx.textAlign = 'center'
      ctx.textBaseline = 'middle'
      ctx.fillText(`${segment.label}`, labelX, labelY - 6)
      ctx.font = '10px Arial'
      ctx.fillText(`${percentage.toFixed(1)}%`, labelX, labelY + 6)
    }

    currentAngle += sliceAngle
  })

  // Draw chart title
  ctx.fillStyle = '#333'
  ctx.font = 'bold 16px Arial'
  ctx.textAlign = 'center'
  ctx.textBaseline = 'top'
  ctx.fillText(chartTitle, canvas.width / 2, 20)
}

watch(() => props.activeView, (newView) => {
  nextTick(() => {
    setTimeout(() => {
      if (newView === 'grafico') {
        drawBarChart()
      } else if (newView === 'pizza') {
        drawPieChart()
      }
    }, 100)
  })
})
watch(() => props.chartData, () => {
  nextTick(() => {
    setTimeout(() => {
      if (props.activeView === 'grafico') {
        drawBarChart()
      }
    }, 100)
  })
})
watch(() => props.pieChartData, () => {
  nextTick(() => {
    setTimeout(() => {
      if (props.activeView === 'pizza') {
        drawPieChart()
      }
    }, 100)
  })
})

// Initial chart rendering
onMounted(() => {
  nextTick(() => {
    setTimeout(() => {
      if (props.activeView === 'grafico') {
        drawBarChart()
      } else if (props.activeView === 'pizza') {
        drawPieChart()
      }
    }, 200)
  })
})
</script>

<style scoped>
.client-analytics {
  width: 100%;
}
</style>
