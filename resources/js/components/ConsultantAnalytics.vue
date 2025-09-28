<template>
  <div class="consultant-analytics">
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
        <h3 class="text-lg font-medium text-gray-900 mb-4">Performance Comercial</h3>

        <div class="h-96 flex items-center justify-center bg-gray-50 rounded-lg">
          <canvas ref="barChart" width="900" height="400" class="max-w-full max-h-full"></canvas>
        </div>
      </div>

      <div v-if="activeView === 'pizza'" class="p-6 relative">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Participação na Receita</h3>

        <div class="h-96 flex items-center justify-center bg-gray-50 rounded-lg">
          <canvas ref="pieChart" width="400" height="400" class="max-w-full max-h-full"></canvas>
        </div>
      </div>

      <!-- Table View -->
      <div v-if="activeView === 'relatorio'" class="p-6 relative">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Relatório Detalhado</h3>
        <div class="overflow-x-auto" v-if="!loading && tableData.length > 0">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Receita Líquida</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Custo Fixo</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Comissão</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Lucro</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <template v-for="(group, consultorName) in groupedTableData" :key="consultorName">
                <!-- Consultant Header -->
                <tr class="bg-gray-100">
                  <td colspan="6" class="px-6 py-3 text-sm font-semibold text-gray-900">
                    {{ consultorName }}
                  </td>
                </tr>
                <!-- Data Rows -->
                <tr v-for="row in group.rows" :key="row.id" class="hover:bg-gray-50 border-b border-gray-200">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ row.period }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900">{{ formatCurrency(row.receita) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600">{{ formatCurrency(row.custo) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600">{{ formatCurrency(row.comissao) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium" :class="row.lucro >= 0 ? 'text-blue-600' : 'text-red-600'">
                    {{ formatCurrency(row.lucro) }}
                  </td>
                </tr>
                <!-- Subtotal Row -->
                <tr class="bg-gray-50 font-semibold border-b-2 border-gray-300">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">SALDO</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900">{{ formatCurrency(group.totals.receita) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600">{{ formatCurrency(group.totals.custo) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600">{{ formatCurrency(group.totals.comissao) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold" :class="group.totals.lucro >= 0 ? 'text-blue-600' : 'text-red-600'">
                    {{ formatCurrency(group.totals.lucro) }}
                  </td>
                </tr>
              </template>
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
                ? 'Selecione um ou mais consultores para ver os dados.'
                : 'Nenhum dado encontrado para os consultores selecionados no período especificado.'
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
  receita?: number
  custo?: number
  comissao?: number
  lucro?: number
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
const groupedTableData = computed(() => {
  const grouped: Record<string, {
      rows: TableRow[],
      totals: {
          receita: number,
          custo: number,
          comissao: number,
          lucro: number
      }
  }> = {}

  props.tableData.forEach(row => {
    if (!grouped[row.name]) {
      grouped[row.name] = {
        rows: [],
        totals: { receita: 0, custo: 0, comissao: 0, lucro: 0 }
      }
    }

    grouped[row.name].rows.push(row)
    grouped[row.name].totals.receita += row.receita
    grouped[row.name].totals.custo += row.custo
    grouped[row.name].totals.comissao += row.comissao
    grouped[row.name].totals.lucro += row.lucro
  })

  Object.keys(grouped).forEach(consultantName => {
    grouped[consultantName].rows.sort((a, b) => {
      if (a.period_start && b.period_start) {
        return a.period_start.localeCompare(b.period_start)
      }
      return 0
    })
  })

  return grouped
})

// Methods
const formatCurrency = (value: number) => {
  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(Math.abs(value))
}

// Chart drawing functions
const drawBarChart = () => {
  const canvas = barChart.value
  if (!canvas) {
    return
  }

  const ctx = canvas.getContext('2d')
  if (!ctx) {
    return
  }

  // Clear canvas
  ctx.clearRect(0, 0, canvas.width, canvas.height)

  if (props.loading) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Carregando dados...', canvas.width / 2, canvas.height / 2)
    return
  }

  // Don't show data if no consultants are selected
  if (props.selections.length === 0) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.textBaseline = 'middle'
    ctx.fillText('Selecione consultores para ver o gráfico', canvas.width / 2, canvas.height / 2 - 10)
    ctx.font = '12px Arial'
    ctx.fillStyle = '#999'
    ctx.fillText('Use o painel de transferência à esquerda para selecionar consultores', canvas.width / 2, canvas.height / 2 + 15)
    return
  }

  // Use real chart data if available, otherwise show sample data
  const consultantData: Record<string, number[]> = {}
  let consultantNames: string[] = []
  let months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai']
  let averageFixedCost = 2000

  if (props.chartData && props.chartData.consultants && props.chartData.consultants.length > 0) {
    consultantNames = props.chartData.consultants.map((c: any) => c.name)

    props.chartData.consultants.forEach((consultant: any) => {
      const netRevenue = consultant.net_revenue || 0
      consultantData[consultant.name] = [Math.max(netRevenue, 100)]
    })

    averageFixedCost = props.chartData.average_fixed_cost || 2000

    months = ['Período Selecionado']
  }

  // Add average fixed cost line data
  consultantData['Custo Fixo Médio'] = months.map(() => averageFixedCost)

  const colors = {
    'Carlos Flávio': '#FF8C42',
    'Ana Paula': '#6B4E71',
    'Carlos Henrique': '#4A90E2',
    'Renato Marcus': '#7ED321',
    'Custo Fixo Médio': '#FF3B30' // Red for the line
  }

  // Chart dimensions
  const chartWidth = canvas.width - 180
  const chartHeight = canvas.height - 100
  const startX = 100
  const startY = 70
  const endX = startX + chartWidth
  const endY = startY + chartHeight

  // Calculate dynamic max value based on actual data
  let maxValue = 35000 // default
  if (props.chartData && props.chartData.consultants) {
    const revenues = props.chartData.consultants.map((c: any) => c.net_revenue || 0)
    const costs = props.chartData.consultants.map((c: any) => c.fixed_cost || 0)
    const allValues = [...revenues, ...costs, averageFixedCost]
    maxValue = Math.max(...allValues, 5000) * 1.2
  }

  // Draw background grid
  ctx.strokeStyle = '#f0f0f0'
  ctx.lineWidth = 1

  // Horizontal grid lines
  const stepY = chartHeight / 7
  for (let i = 0; i <= 7; i++) {
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
  for (let i = 0; i <= 7; i++) {
    const value = (maxValue / 7) * (7 - i)
    const y = startY + i * stepY + 4
    if (value === 0) {
      ctx.fillText('R$ 0', startX - 10, y)
    } else {
      ctx.fillText(`R$ ${(value / 1000).toFixed(0)}.000,00`, startX - 10, y)
    }
  }

  // Draw bars
  const consultants = consultantNames
  const barWidth = 35
  const barSpacing = 3
  const groupWidth = consultants.length * barWidth + (consultants.length - 1) * barSpacing
  const totalGroupsWidth = months.length * groupWidth
  const availableWidth = chartWidth - 40 // Leave some margin
  const groupSpacing = (availableWidth - totalGroupsWidth) / (months.length + 1)

  months.forEach((month, monthIndex) => {
    const groupStartX = startX + 20 + groupSpacing + monthIndex * (groupWidth + groupSpacing)

    consultants.forEach((consultant: string, consultantIndex: number) => {
      const value = consultantData[consultant][monthIndex]
      const barHeight = (value / maxValue) * chartHeight
      const x = groupStartX + consultantIndex * (barWidth + barSpacing)
      const y = endY - barHeight

      ctx.fillStyle = colors[consultant]
      ctx.fillRect(x, y, barWidth, barHeight)
    })

    // Draw month label
    ctx.fillStyle = '#666'
    ctx.font = '12px Arial'
    ctx.textAlign = 'center'
    const labelX = groupStartX + groupWidth / 2
    ctx.fillText(month, labelX, endY + 20)
  })

  // Draw red trend line (Custo Fixo Médio)
  ctx.strokeStyle = colors['Custo Fixo Médio']
  ctx.lineWidth = 3
  ctx.beginPath()

  months.forEach((month, monthIndex) => {
    const groupStartX = startX + 20 + groupSpacing + monthIndex * (groupWidth + groupSpacing)
    const lineX = groupStartX + groupWidth / 2
    const value = consultantData['Custo Fixo Médio'][monthIndex]
    const y = endY - (value / maxValue) * chartHeight

    if (monthIndex === 0) {
      ctx.moveTo(lineX, y)
    } else {
      ctx.lineTo(lineX, y)
    }
  })

  ctx.stroke()

  // Draw legend
  const legendStartX = endX + 30
  const legendStartY = startY + 30
  consultants.forEach((consultant, index) => {
    const legendY = legendStartY + index * 22

    // Legend color box
    ctx.fillStyle = colors[consultant]
    ctx.fillRect(legendStartX, legendY - 8, 12, 12)

    // Legend text
    ctx.fillStyle = '#333'
    ctx.font = '10px Arial'
    ctx.textAlign = 'left'
    const displayName = consultant.includes('Carlos') ? consultant.replace('Carlos ', 'C.') : consultant
    ctx.fillText(displayName, legendStartX + 18, legendY)
  })

  // Add red line legend
  ctx.strokeStyle = colors['Custo Fixo Médio']
  ctx.lineWidth = 3
  ctx.beginPath()
  ctx.moveTo(legendStartX, legendStartY + 4 * 22 - 3)
  ctx.lineTo(legendStartX + 12, legendStartY + 4 * 22 - 3)
  ctx.stroke()
  ctx.fillStyle = '#333'
  ctx.font = '10px Arial'
  ctx.fillText('Custo Fixo Médio', legendStartX + 18, legendStartY + 4 * 22)

  // Chart title
  ctx.fillStyle = '#333'
  ctx.font = 'bold 16px Arial'
  ctx.textAlign = 'center'
  ctx.fillText('Performance Comercial', canvas.width / 2, 30)
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

  // Don't show data if no consultants are selected
  if (props.selections.length === 0) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.textBaseline = 'middle'
    ctx.fillText('Selecione consultores para ver o gráfico', canvas.width / 2, canvas.height / 2 - 10)
    ctx.font = '12px Arial'
    ctx.fillStyle = '#999'
    ctx.fillText('Use o painel de transferência à esquerda para selecionar consultores', canvas.width / 2, canvas.height / 2 + 15)
    return
  }

  // Use pieChartData if available, otherwise use sample data
  let data
  let chartTitle = 'Participação na Receita'

  if (props.pieChartData && props.pieChartData.consultants && props.pieChartData.consultants.length > 0) {
    const consultants = props.pieChartData.consultants
    const colors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#FF8C42', '#6B4E71']

    // Check if we have any revenue data
    const totalRevenue = consultants.reduce((sum: any, c: any) => sum + (c.net_revenue || 0), 0)

    if (totalRevenue > 0) {
      // Use revenue data
      data = consultants.map((consultant: any, index: number) => ({
        label: consultant.name,
        value: consultant.net_revenue || 0,
        color: consultant.color || colors[index % colors.length]
      }))
      chartTitle = 'Participação na Receita'
    } else {
      // Fallback to fixed costs from the main chart data if available
      if (props.chartData && props.chartData.consultants) {
        data = props.chartData.consultants.map((consultant: any, index: number) => ({
          label: consultant.name,
          value: consultant.fixed_cost || 0,
          color: colors[index % colors.length]
        })).filter((item: any) => item.value > 0) // Only show consultants with costs
        chartTitle = 'Distribuição de Custos Fixos'
      } else {
        data = []
      }
    }
  } else if (props.pieChartData && props.pieChartData.chart_config) {
    // Alternative format from backend
    const chartConfig = props.pieChartData.chart_config
    const colors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#FF8C42', '#6B4E71']

    data = chartConfig.labels.map((label: string, index: number) => ({
      label: label,
      value: chartConfig.datasets[0].data[index] || 0,
      color: chartConfig.datasets[0].backgroundColor[index] || colors[index % colors.length]
    }))
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
    ctx.fillText('Selecione consultores com receita para ver o gráfico', centerX, centerY + 10)
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
.consultant-analytics {
  width: 100%;
}
</style>
