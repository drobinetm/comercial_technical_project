<template>
  <div class="border border-gray-300 rounded-lg bg-white">
    <div class="flex">
      <!-- Available List -->
      <div class="flex-1 p-3">
        <h4 class="text-sm font-medium text-gray-700 mb-2">
          {{ availableLabel }}
        </h4>
        <div class="border border-gray-200 rounded h-32 overflow-y-auto bg-gray-50">
          <div
            v-for="item in availableOptions"
            :key="item.id"
            @click="toggleAvailableSelection(item.id)"
            :class="[
              'px-2 py-1 text-sm cursor-pointer hover:bg-blue-50',
              availableSelections.includes(item.id) ? 'bg-blue-100' : ''
            ]"
          >
            {{ item.name }}
          </div>
        </div>
      </div>

      <!-- Transfer Buttons -->
      <div class="flex flex-col justify-center px-2 py-0 space-y-2">
        <button
          @click="moveToSelected"
          :disabled="availableSelections.length === 0"
          class="px-2 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
          :title="moveToSelectedTitle"
        >
          →
        </button>
        <button
          @click="moveToAvailable"
          :disabled="selectedSelections.length === 0"
          class="px-2 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
          :title="moveToAvailableTitle"
        >
          ←
        </button>
      </div>

      <!-- Selected List -->
      <div class="flex-1 p-3">
        <h4 class="text-sm font-medium text-gray-700 mb-2">
          {{ selectedLabel }}
        </h4>
        <div class="border border-gray-200 rounded h-32 overflow-y-auto bg-gray-50">
          <div
            v-for="item in selectedOptions"
            :key="item.id"
            @click="toggleSelectedSelection(item.id)"
            :class="[
              'px-2 py-1 text-sm cursor-pointer hover:bg-red-50',
              selectedSelections.includes(item.id) ? 'bg-red-100' : ''
            ]"
          >
            {{ item.name }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'

interface Option {
  id: string | number
  name: string
}

interface Props {
  options: Option[]
  selectedIds: (string | number)[]
  availableLabel?: string
  selectedLabel?: string
  moveToSelectedTitle?: string
  moveToAvailableTitle?: string
}

const props = withDefaults(defineProps<Props>(), {
  availableLabel: 'Available Items',
  selectedLabel: 'Selected Items',
  moveToSelectedTitle: 'Move to selected',
  moveToAvailableTitle: 'Move to available'
})

const emit = defineEmits<{
  'update:selectedIds': [value: (string | number)[]]
}>()

// Local selections for highlighting items to transfer
const availableSelections = ref<(string | number)[]>([])
const selectedSelections = ref<(string | number)[]>([])

// Computed properties for available and selected options
const availableOptions = computed(() => 
  props.options.filter(option => !props.selectedIds.includes(option.id))
)

const selectedOptions = computed(() => 
  props.options.filter(option => props.selectedIds.includes(option.id))
)

// Methods for handling selections
const toggleAvailableSelection = (id: string | number) => {
  const index = availableSelections.value.indexOf(id)
  if (index > -1) {
    availableSelections.value.splice(index, 1)
  } else {
    availableSelections.value.push(id)
  }
}

const toggleSelectedSelection = (id: string | number) => {
  const index = selectedSelections.value.indexOf(id)
  if (index > -1) {
    selectedSelections.value.splice(index, 1)
  } else {
    selectedSelections.value.push(id)
  }
}

const moveToSelected = () => {
  const newSelectedIds = [...props.selectedIds, ...availableSelections.value]
  emit('update:selectedIds', newSelectedIds)
  availableSelections.value = []
}

const moveToAvailable = () => {
  const newSelectedIds = props.selectedIds.filter(
    id => !selectedSelections.value.includes(id)
  )
  emit('update:selectedIds', newSelectedIds)
  selectedSelections.value = []
}
</script>

<style scoped>
/* Custom scrollbar for dropdowns */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style>