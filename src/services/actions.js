import api from "."

export function getViewsPerPeriod(period) {
    const baseUrl = `/views-per-page?period=${period}`
    return api.get(baseUrl)
}