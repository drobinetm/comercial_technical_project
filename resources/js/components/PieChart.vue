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
import { ref, onMounted, watch, nextTick } from 'vue'

interface PieChartData {
  labels?: string[]
  datasets?: any[]
}

interface Props {
  data?: PieChartData | null
  width?: number
  height?: number
  loading?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  width: 400,
  height: 400,
  loading: false
})

const chartCanvas = ref<HTMLCanvasElement | null>(null)

const canvasWidth = ref(props.width)
const canvasHeight = ref(props.height)

const drawPieChart = () => {
  const canvas = chartCanvas.value
  if (!canvas) return

  const ctx = canvas.getContext('2d')
  if (!ctx) return
  
  ctx.clearRect(0, 0, canvas.width, canvas.height)

  if (props.loading) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Carregando dados...', canvas.width / 2, canvas.height / 2)
    return
  }

  if (!props.data) {
    ctx.fillStyle = '#666'
    ctx.font = '16px Arial'
    ctx.textAlign = 'center'
    ctx.fillText('Nenhum dado disponível', canvas.width / 2, canvas.height / 2)
    return
  }

  // Sample pie chart data
  const data = [
    { label: 'Toyota', value: 30, color: '#FF6B6B' },
    { label: 'Traffic', value: 25, color: '#4ECDC4' },
    { label: 'Unicoba', value: 20, color: '#45B7D1' },
    { label: 'WebMotors', value: 15, color: '#96CEB4' },
    { label: 'TIM', value: 10, color: '#FFEAA7' }
  ]

  const centerX = canvas.width / 2
  const centerY = canvas.height / 2
  const radius = 120

  let currentAngle = -Math.PI / 2

  data.forEach(segment => {
    const sliceAngle = (segment.value / 100) * 2 * Math.PI

    // Draw slice
    ctx.beginPath()
    ctx.moveTo(centerX, centerY)
    ctx.arc(centerX, centerY, radius, currentAngle, currentAngle + sliceAngle)
    ctx.closePath()
    ctx.fillStyle = segment.color
    ctx.fill()

    // Draw label
    const labelAngle = currentAngle + sliceAngle / 2
    const labelX = centerX + Math.cos(labelAngle) * (radius + 30)
    const labelY = centerY + Math.sin(labelAngle) * (radius + 30)

    ctx.fillStyle = '#333'
    ctx.font = '12px Arial'
    ctx.textAlign = 'center'
    ctx.fillText(`${segment.label} ${segment.value}%`, labelX, labelY)

    currentAngle += sliceAngle
  })
}

// Watch for data changes
watch(() => props.data, () => {
  nextTick(() => {
    drawPieChart()
  })
}, { deep: true })

// Watch for loading changes
watch(() => props.loading, () => {
  nextTick(() => {
    drawPieChart()
  })
})

onMounted(() => {
  nextTick(() => {
    drawPieChart()
  })
})
</script>