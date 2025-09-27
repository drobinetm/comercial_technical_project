export interface Consultant {
  id: string
  name: string
  email?: string
  type?: number
  co_usuario: string
  no_usuario: string
  no_email?: string
  co_tipo_usuario?: number
}

export interface Client {
  id: string
  name: string
  email?: string
  contact?: string
  company?: string
}

export interface ConsultantReport {
  id: string
  name: string
  net_revenue: number
  fixed_cost: number
  commission: number
  profit: number
  profit_margin: number
  performance_ratio: number
}

export interface ConsultantChartData {
  consultants: Array<{
    id: string
    name: string
    net_revenue: number
    fixed_cost: number
  }>
  average_fixed_cost: number
  max_axis_value: number
  chart_config: {
    labels: string[]
    datasets: Array<{
      label: string
      data: number[]
      backgroundColor: string
      borderColor: string
      borderWidth: number
    }>
  }
  average_line: {
    value: number
    label: string
  }
}

export interface ConsultantPieChartData {
  consultants: Array<{
    id: string
    name: string
    net_revenue: number
    percentage: number
    color: string
  }>
  chart_config: {
    labels: string[]
    datasets: Array<{
      data: number[]
      backgroundColor: string[]
      borderColor: string[]
      borderWidth: number
    }>
  }
  total_revenue: number
}

export interface ConsultantStats {
  total_consultants: number
  total_net_revenue: number
  total_fixed_cost: number
  total_commission: number
  total_profit: number
  avg_revenue_per_consultant: number
  avg_fixed_cost_per_consultant: number
  average_profit: number
  profit_margin_percentage: number
  efficiency_ratio: number
  period: {
    from: string | null
    to: string | null
  }
}

export interface DashboardFilters {
  consultant_ids: string[]
  client_ids: string[]
  date_from: string | null
  date_to: string | null
}

export interface ApiResponse<T> {
  success: boolean
  data: T
  filters?: DashboardFilters
  message?: string
}

export interface DashboardData {
  consultants: Consultant[]
  report: ConsultantReport[]
  chart: ConsultantChartData
  pieChart: ConsultantPieChartData
  stats: ConsultantStats
}

export interface QuickDateFilter {
  id: string
  name: string
}

export interface ViewTab {
  id: 'report' | 'chart' | 'pie'
  name: string
}

export interface AnalyticsTab {
  id: 'consultant' | 'client'
  name: string
}

// Chart.js specific types
export interface ChartDataset {
  label?: string
  data: number[]
  backgroundColor?: string | string[]
  borderColor?: string | string[]
  borderWidth?: number
}

export interface ChartConfiguration {
  type: 'bar' | 'pie' | 'line'
  data: {
    labels: string[]
    datasets: ChartDataset[]
  }
  options?: any
}

// Transfer component types (for consultant selection)
export interface TransferOption {
  id: string
  name: string
  selected?: boolean
}

export interface TransferSelections {
  available: string[]
  selected: string[]
}