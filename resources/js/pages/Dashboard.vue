<template>
  <Head title="Sistema de Análisis Comercial" />
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex items-center">
            <h1 class="text-xl font-semibold text-gray-900">Sistema de Análisis Comercial</h1>
          </div>
          <div class="text-sm text-gray-500">Agence</div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <!-- Navigation Tabs -->
      <div class="mb-6">
        <nav class="flex space-x-8">
          <button
            v-for="tab in tabs"
            :key="tab.id"
            @click="activeTab = tab.id"
            :class="[
              'py-2 px-1 border-b-2 font-medium text-sm',
              activeTab === tab.id
                ? 'border-blue-500 text-blue-600'
                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
            ]"
          >
            {{ tab.name }}
          </button>
        </nav>
      </div>

      <!-- Filters Section -->
      <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
          <!-- Date Filters Combined -->
          <div class="col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">Filtros de Fecha</label>
            <div class="space-y-3">
              <!-- Date Range -->
              <div>
                <label class="block text-xs text-gray-600 mb-1">Período</label>
                <div class="space-y-2">
                  <input
                    v-model="filters.startDate"
                    type="date"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                  <input
                    v-model="filters.endDate"
                    type="date"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>
              </div>

              <!-- Quick Filters -->
              <div>
                <label class="block text-xs text-gray-600 mb-1">Filtros Rápidos</label>
                <div class="grid grid-cols-2 gap-2">
                  <button
                    v-for="quickFilter in quickDateFilters"
                    :key="quickFilter.id"
                    @click="applyQuickFilter(quickFilter.id)"
                    class="px-2 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
                  >
                    {{ quickFilter.name }}
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- consultants/Clients Transfer Component -->
          <div class="col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">
              {{ activeTab === 'consultor' ? 'Consultores' : 'Clientes' }}
            </label>
            <TransferList
              v-if="activeTab === 'consultor'"
              :options="consultants"
              v-model:selectedIds="selections.primary"
              available-label="Consultores Disponibles"
              selected-label="Consultores Seleccionados"
              move-to-selected-title="Mover a seleccionados"
              move-to-available-title="Mover a disponibles"
              @update:selectedIds="handleConsultantSelectionChange"
            />
            <TransferList
              v-else
              :options="clients"
              v-model:selectedIds="selections.primary"
              available-label="Clientes Disponibles"
              selected-label="Clientes Seleccionados"
              move-to-selected-title="Mover a seleccionados"
              move-to-available-title="Mover a disponibles"
              @update:selectedIds="handleClientSelectionChange"
            />
          </div>

        </div>
      </div>

      <!-- View Toggle Buttons -->
      <div class="flex justify-end mb-6">
        <div class="flex bg-gray-100 rounded-lg p-1">
          <button
            v-for="view in views"
            :key="view.id"
            @click="activeView = view.id"
            :class="[
              'px-4 py-2 rounded-md text-sm font-medium transition-colors',
              activeView === view.id
                ? 'bg-white text-gray-900 shadow-sm'
                : 'text-gray-600 hover:text-gray-900'
            ]"
          >
            {{ view.name }}
          </button>
        </div>
      </div>

      <!-- Analytics Components -->
      <ConsultantAnalytics
        v-if="activeTab === 'consultor'"
        :active-view="activeView"
        :selections="selections.primary"
        :loading="loading"
        :table-data="tableData"
        :chart-data="chartData"
        :pie-chart-data="pieChartData"
        :dashboard-stats="dashboardStats"
      />

      <ClientAnalytics
        v-else
        :active-view="activeView"
        :selections="selections.primary"
        :loading="loading"
        :table-data="tableData"
        :chart-data="chartData"
        :pie-chart-data="pieChartData"
        :dashboard-stats="dashboardStats"
      />
    </main>
  </div>
</template>

<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue'
import TransferList from '@/components/TransferList.vue'
import ConsultantAnalytics from '@/components/ConsultantAnalytics.vue'
import ClientAnalytics from '@/components/ClientAnalytics.vue'

interface Props {
  consultants: Option[];
  clients: Option[];
  initialData: {
    tableData: TableRow[];
    chartData: any;
    pieChartData: any;
    dashboardStats: any;
  };
}

const props = defineProps<Props>();

interface Option {
  id: string
  name: string
  email?: string
  type?: string
}

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
  net_revenue?: number
  consultant_costs?: number
  profit?: number
  profit_margin?: number
  roi?: number
}

// Reactive data
const activeTab = ref('consultor')
const activeView = ref('relatorio')
const loading = ref(false)
const filters = ref({
  startDate: '2007-01-01',
  endDate: '2007-02-28'
})
const selections = ref({
  primary: [] as string[]
})

// Data from props and reactive state
const consultants = ref<Option[]>(props.consultants || [])
const clients = ref<Option[]>(props.clients || [])
const tableData = ref<TableRow[]>(props.initialData.tableData || [])
const chartData = ref<any>(props.initialData.chartData || null)
const pieChartData = ref<any>(props.initialData.pieChartData || null)
const dashboardStats = ref<any>(props.initialData.dashboardStats || null)

// Static data
const tabs = [
  { id: 'consultor', name: 'Por Consultor' },
  { id: 'cliente', name: 'Por Cliente' }
]
const views = [
  { id: 'relatorio', name: 'Relatório' },
  { id: 'grafico', name: 'Gráfico' },
  { id: 'pizza', name: 'Pizza' }
]
const quickDateFilters = [
  { id: 'thisMonth', name: 'Este Mês' },
  { id: 'lastMonth', name: 'Mês Anterior' },
  { id: 'quarter', name: 'Trimestre' },
  { id: 'year', name: 'Este Año' }
]

// Inertia Methods
const fetchDashboardData = (isClient: boolean = false) => {
  if (loading.value) return

  const params: Record<string, any> = {
    date_from: filters.value.startDate,
    date_to: filters.value.endDate
  }

  if (isClient) {
    params.client_ids = selections.value.primary
  } else {
    params.consultant_ids = selections.value.primary
  }

  loading.value = true

  const routeName = isClient ? '/dashboard/client-data' : '/dashboard/consultant-data'

  router.visit(routeName, {
    data: params,
    preserveState: true,
    preserveScroll: true,
    onSuccess: (page) => {
      loading.value = false

      const newData = page.props.initialData
      if (newData) {
        tableData.value = newData.tableData || []
        chartData.value = newData.chartData || null
        pieChartData.value = newData.pieChartData || null
        dashboardStats.value = newData.dashboardStats || null
      }
    },
    onError: () => {
      loading.value = false
      alert(isClient
        ? 'Erro ao carregar dados do cliente. Verifique sua conexão e tente novamente.'
        : 'Erro ao carregar dados do consultor. Verifique sua conexão e tente novamente.')
    }
  })
}

// Handle consultant selection changes
const handleConsultantSelectionChange = (selectedIds: (string | number)[]) => {
  selections.value.primary = selectedIds as string[]
  if (selectedIds.length === 0) {
    tableData.value = []
    chartData.value = null
    pieChartData.value = null
    dashboardStats.value = null
  } else {
    fetchDashboardData(false)
  }
}

// Handle client selection changes
const handleClientSelectionChange = (selectedIds: (string | number)[]) => {
  selections.value.primary = selectedIds as string[]
  if (selectedIds.length === 0) {
    tableData.value = []
    chartData.value = null
    pieChartData.value = null
    dashboardStats.value = null
  } else {
    fetchDashboardData(true)
  }
}

const applyQuickFilter = (filterId: string) => {
  const today = new Date()
  const year = today.getFullYear()
  const month = today.getMonth()

  switch (filterId) {
    case 'thisMonth':
      filters.value.startDate = new Date(year, month, 1).toISOString().split('T')[0]
      filters.value.endDate = new Date(year, month + 1, 0).toISOString().split('T')[0]
      break
    case 'lastMonth':
      filters.value.startDate = new Date(year, month - 1, 1).toISOString().split('T')[0]
      filters.value.endDate = new Date(year, month, 0).toISOString().split('T')[0]
      break
    case 'quarter':
      const quarterStart = Math.floor(month / 3) * 3
      filters.value.startDate = new Date(year, quarterStart, 1).toISOString().split('T')[0]
      filters.value.endDate = new Date(year, quarterStart + 3, 0).toISOString().split('T')[0]
      break
    case 'year':
      filters.value.startDate = new Date(year, 0, 1).toISOString().split('T')[0]
      filters.value.endDate = new Date(year, 11, 31).toISOString().split('T')[0]
      break
  }
  // Refresh data when filters change
  if (selections.value.primary.length > 0) {
    fetchDashboardData(activeTab.value === 'cliente')
  }
}

watch([() => filters.value.startDate, () => filters.value.endDate], () => {
  if (selections.value.primary.length > 0) {
    fetchDashboardData(activeTab.value === 'cliente')
  }
}, { deep: true })
watch(activeTab, (newTab) => {
  console.log('Tab changed to:', newTab)

  selections.value.primary = []
  tableData.value = []
  chartData.value = null
  pieChartData.value = null
  dashboardStats.value = null
})

// Lifecycle hooks - data is now passed as props, no need to fetch
onMounted(() => {
  console.log('Dashboard mounted with props:', {
    consultants: consultants.value.length,
    clients: clients.value.length,
    initialData: !!props.initialData
  })
})
</script>

<style scoped>
/* Custom scrollbar for dropdowns */
.overflow-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.overflow-auto::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.overflow-auto::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style>
