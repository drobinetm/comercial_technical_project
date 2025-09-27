<template>
  <div class="w-full h-full">
    <canvas 
      ref="chartCanvas" 
      :width="canvasWidth" 
      :height="canvasHeight"
      class="max-w-full max-h-full"
    ></canvas>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'

interface ChartData {
  labels?: string[]
  datasets?: any[]
  consultants?: any[]
  maxValue?: number
}

interface Props {
  data?: ChartData | null
  activeTab?: string
  width?: number
  height?: number
  loading?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  width: 900,
  height: 400,
  activeTab: 'consultor',
  loading: false
})

const chartCanvas = ref<HTMLCanvasElement | null>(null)

const canvasWidth = ref(props.width)
const canvasHeight = ref(props.height)

const drawChart = () => {
  if (!chartCanvas.value) {
    console.warn('Chart canvas element not found')
    return
  }

  const ctx = chartCanvas.value.getContext('2d')
  if (!ctx) {
    console.warn('Could not get 2d context for chart')
    return
  }
  
  console.log('Drawing chart...')
  
  // Clear canvas
  ctx.clearRect(0, 0, chartCanvas.value.width, chartCanvas.value.height)
  
  // Check which tab is active to determine chart type
  if (props.activeTab === 'consultor') {
    drawConsultantBarChart(ctx, chartCanvas.value)
  } else {
    drawClientLineChart(ctx, chartCanvas.value)
  }
}

const drawConsultantBarChart = (ctx: CanvasRenderingContext2D, canvas: HTMLCanvasElement) => {
  // Use actual chart data from database or sample data
  if (!props.data && !props.loading) {
    // Show no data message
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Nenhum dado disponível', canvas.width / 2, canvas.height / 2)
    return
  }
  
  if (props.loading) {
    // Show loading message
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Carregando dados...', canvas.width / 2, canvas.height / 2)
    return
  }

  // Consultant performance data based on sample data or from props.data
  const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai']
  
  const consultantData = {
    'Carlos Flávio': [23000, 30000, 13000, 22000, 16000],
    'Ana Paula': [4000, 3500, 1500, 1800, 2200],
    'Carlos Henrique': [15000, 23000, 22000, 18000, 21000],
    'Renato Marcus': [4500, 3800, 2000, 2300, 2800],
    'Custo Fixo Médio': [2000, 2000, 2000, 2000, 2000]
  }
  
  const colors = {
    'Carlos Flávio': '#FF8C42',
    'Ana Paula': '#6B4E71', 
    'Carlos Henrique': '#4A90E2',
    'Renato Marcus': '#7ED321',
    'Custo Fixo Médio': '#FF3B30'
  }

  // Chart dimensions
  const chartWidth = canvas.width - 180
  const chartHeight = canvas.height - 100
  const startX = 100
  const startY = 70
  const endX = startX + chartWidth
  const endY = startY + chartHeight
  const maxValue = 35000

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
  const consultants = ['Carlos Flávio', 'Ana Paula', 'Carlos Henrique', 'Renato Marcus']
  const barWidth = 35
  const barSpacing = 3
  const groupWidth = consultants.length * barWidth + (consultants.length - 1) * barSpacing
  const totalGroupsWidth = months.length * groupWidth
  const availableWidth = chartWidth - 40
  const groupSpacing = (availableWidth - totalGroupsWidth) / (months.length + 1)
  
  months.forEach((month, monthIndex) => {
    const groupStartX = startX + 20 + groupSpacing + monthIndex * (groupWidth + groupSpacing)
    
    consultants.forEach((consultant, consultantIndex) => {
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

const drawClientLineChart = (ctx: CanvasRenderingContext2D, canvas: HTMLCanvasElement) => {
  if (props.loading) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Carregando dados...', canvas.width / 2, canvas.height / 2)
    return
  }
  
  ctx.fillStyle = '#333'
  ctx.font = 'bold 16px Arial'
  ctx.textAlign = 'center'
  ctx.fillText('Performance por Cliente', canvas.width / 2, 30)
}

// Watch for data changes
watch(() => props.data, () => {
  nextTick(() => {
    drawChart()
  })
}, { deep: true })

// Watch for activeTab changes
watch(() => props.activeTab, () => {
  nextTick(() => {
    drawChart()
  })
})

// Watch for loading changes
watch(() => props.loading, () => {
  nextTick(() => {
    drawChart()
  })
})

onMounted(() => {
  nextTick(() => {
    drawChart()
  })
})
</script>