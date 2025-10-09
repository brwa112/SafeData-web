import { ref, computed, watch, onMounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

export function useFontSettings() {
    const fontScale = ref('medium') // Default fallback
    const fontWeight = ref('normal') // Default fallback
    const isLoading = ref(false)

    // Available font scale options
    const fontScales = [
        { id: 1, name: 'Extra Small', slug: 'extra-small', value: 'xs' },
        { id: 2, name: 'Small', slug: 'small', value: 'small' },
        { id: 3, name: 'Medium', slug: 'medium', value: 'medium' },
        { id: 4, name: 'Large', slug: 'large', value: 'large' },
        { id: 5, name: 'Extra Large', slug: 'extra-large', value: 'xl' },
        { id: 6, name: '2X Large', slug: '2x-large', value: '2xl' },
        { id: 7, name: '3X Large', slug: '3x-large', value: '3xl' },
    ]

    // Available font weight options
    const fontWeights = [
        { id: 1, name: 'Thin', slug: 'thin', value: '100' },
        { id: 2, name: 'Extra Light', slug: 'extra-light', value: '200' },
        { id: 3, name: 'Light', slug: 'light', value: '300' },
        { id: 4, name: 'Normal', slug: 'normal', value: '400' },
        { id: 5, name: 'Medium', slug: 'medium', value: '500' },
        { id: 6, name: 'Semi Bold', slug: 'semi-bold', value: '600' },
        { id: 7, name: 'Bold', slug: 'bold', value: '700' },
        { id: 8, name: 'Extra Bold', slug: 'extra-bold', value: '800' },
        { id: 9, name: 'Black', slug: 'black', value: '900' },
    ]

    // Computed properties
    const currentScale = computed(() =>
        fontScales.find(s => s.value === fontScale.value)
    )
    const scaleOptions = computed(() => fontScales)
    const currentWeight = computed(() =>
        fontWeights.find(w => w.value === fontWeight.value)
    )
    const weightOptions = computed(() => fontWeights)

    // Apply font scale and weight to document
    const applyFontSettings = (scale, weight) => {
        document.documentElement.setAttribute('data-font-scale', scale)
        document.documentElement.setAttribute('data-font-weight', weight)
    }

    // Save font preference to backend
    const saveFontPreference = async (scale, weight) => {
        try {
            isLoading.value = true
        } catch (error) {
            console.error('Failed to save font preference:', error)
        } finally {
            isLoading.value = false
        }
    }

    // Update font scale
    const setFontScale = async (scaleValue) => {
        const scale = typeof scaleValue === 'object' ? scaleValue.value : scaleValue
        if (fontScales.some(s => s.value === scale)) {
            fontScale.value = scale
            applyFontSettings(scale, fontWeight.value)
            localStorage.setItem('fontScale', scale)
            await saveFontPreference(scale, fontWeight.value)
        }
    }

    // Update font weight
    const setFontWeight = async (weightValue) => {
        const weight = typeof weightValue === 'object' ? weightValue.value : weightValue
        if (fontWeights.some(w => w.value === weight)) {
            fontWeight.value = weight
            applyFontSettings(fontScale.value, weight)
            localStorage.setItem('fontWeight', weight)
            await saveFontPreference(fontScale.value, weight)
        }
    }

    // Load font preference
    const loadFontPreference = () => {
        const userSetting = usePage().props.auth?.user?.settings
        const userScale = userSetting?.font_scale
        const userWeight = userSetting?.font_weight
        const localScale = localStorage.getItem('fontScale')
        const localWeight = localStorage.getItem('fontWeight')

        // Priority: localStorage > user settings > defaults
        const scalePref = localScale || userScale || 'medium'
        const weightPref = localWeight || userWeight || '400'

        fontScale.value = scalePref
        fontWeight.value = weightPref

        // Apply immediately
        applyFontSettings(scalePref, weightPref)
    }

    watch(fontScale, (newScale) => {
        applyFontSettings(newScale, fontWeight.value)
    })

    watch(fontWeight, (newWeight) => {
        applyFontSettings(fontScale.value, newWeight)
    })

    onMounted(() => {
        loadFontPreference()
        applyFontSettings(fontScale.value, fontWeight.value)
    })

    return {
        fontScale,
        fontWeight,
        currentScale,
        scaleOptions,
        currentWeight,
        weightOptions,
        isLoading,
        setFontScale,
        setFontWeight,
        loadFontPreference
    }
}